<?php

namespace ProgramPlanner\Http\Controllers;

use Illuminate\Http\Request;

use ProgramPlanner\Http\Requests;
use ProgramPlanner\Http\Requests\CourseRequest;
use ProgramPlanner\Models\Department;
use ProgramPlanner\Models\Course;
use ProgramPlanner\Models\Career;

use ProgramPlanner\Enums\Level;
use ProgramPlanner\Enums\Credit;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->setTitle("Courses");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = Course::with('department')->orderBy('course_number')->get();
        return view('courses.index', array('model' => $courses));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexJson()
    {
        $courses = Course::with('department')->get();
        return response()->json([
            "data" => $courses,
            "success" => true,
            "message" => ""
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $levels = Level::toList();
        $credits = Credit::toList();
        $departments = Department::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        // List of courses used for pre-requisites and co-requisites
        $courseList = Course::get()->lists('full_name', 'id');
        return view('courses.create',
            [  'departments' => $departments,
                'levels' => $levels,
                'credits' => $credits,
                'courseList' => $courseList,
                'careerList' => $careerList
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return Response
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->pre_requisites()->attach($request->input('pre_requisite_list'));
        $course->co_requisites()->attach($request->input('co_requisite_list'));
        $course->careers()->attach($request->input('career_list'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $course = Course::with(['pre_requisites', 'co_requisites','careers'])->findOrFail($id);
        return view('courses.show', array('model' => $course));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $levels = Level::toList();
        $credits = Credit::toList();
        $departments = Department::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        // List of courses used for pre-requisites and co-requisites
        $courseList = Course::where('id','!=',$course->id)->get()->lists('full_name', 'id');

        return view('courses.edit',
                        [   'model' => $course,
                            'departments' => $departments,
                            'levels' => $levels,
                            'credits' => $credits,
                            'courseList' => $courseList,
                            'careerList' => $careerList,
                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param CourseRequest $request
     * @return Response
     */
    public function update($id, CourseRequest $request)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());

        if($request->input('co_requisite_list') == null) {
            $course->co_requisites()->detach($course->co_requisite_list);
        } else {
            $course->co_requisites()->sync($request->input('co_requisite_list'));
        }

        if($request->input('pre_requisite_list') == null) {
            $course->pre_requisites()->detach($course->pre_requisite_list);
        } else {
            $course->pre_requisites()->sync($request->input('pre_requisite_list'));
        }

        if($request->input('career_list') == null) {
            $course->careers()->detach($course->career_list);
        } else {
            $course->careers()->sync($request->input('career_list'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if($course->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Course deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Course could not be deleted!');
        };
    }
}

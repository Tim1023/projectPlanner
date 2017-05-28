<?php

namespace ProgramPlanner\Http\Controllers;

use ProgramPlanner\Http\Requests\ProgramRequest;
use ProgramPlanner\Models\Department;
use ProgramPlanner\Models\Program;
use ProgramPlanner\Models\Semester;
use ProgramPlanner\Models\Course;
use ProgramPlanner\Models\Career;
use ProgramPlanner\Enums\Level;
use ProgramPlanner\Enums\Credit;


class ProgramController extends Controller
{
    public function __construct()
    {
        $this->setTitle("Programs");
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $programs = Program::with('department')->get();
        return view('programs.index', array('model' => $programs));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departments = Department::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        return view('programs.create', compact('departments', 'careerList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProgramRequest $request
     * @return Response
     */
    public function store(ProgramRequest $request)
    {
        $program = Program::create($request->all());
        $program->careers()->attach($request->input('career_list'));
        return redirect()->back()->with('responseSuccess', 'Success! Program created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $program = Program::with(['program_semesters.courses', 'careers'])->findOrFail($id);

        return view('programs.show', array('model' => $program));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $program = Program::with('program_semesters.courses')->findOrFail($id);
        $departments = Department::lists('name', 'id');
        $semesterList = Semester::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        $levels = Level::toList();
        $credits = Credit::toList();
        // List of courses used for pre-requisites and co-requisites
        // using get as full_name_with_credits is an virtual attribute
        $courseList = Course::get()->lists('full_name_with_credits', 'id');

        return view('programs.edit',
            ['model' => $program,
                'departments' => $departments,
                'semesterList' => $semesterList,
                'courseList' => $courseList,
                'careerList' => $careerList,
                'levels' => $levels,
                'credits' => $credits,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param ProgramRequest $request
     * @return Response
     */
    public function update($id, ProgramRequest $request)
    {
        $program = Program::findOrFail($id);
        $program->update($request->all());

        if($request->input('career_list') == null) {
            $program->careers()->detach($program->career_list);
        } else {
            $program->careers()->sync($request->input('career_list'));
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
        $program = Program::findOrFail($id);
        if($program->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Program deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Program could not be deleted!');
        };
    }

    public function addCompulsoryCourse($id, $courseId)
    {
        $program = Program::findOrFail($id);
        $course = Course::findOrFail($courseId);

        // if course exists in compulsory courses for this program return an error
        if($program->compulsory_courses()->lists('course_id')->contains($courseId)){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' is already compulsory!'
                ]);
        }

        // else attach course and return succes message
        $program->compulsory_courses()->attach([$courseId]);

        return response()
            ->json([
                'data' => $course->toJson(),
                'success' => true,
                'message' => $course->name . ' marked compulsory!'
            ]);
    }

    public function removeCompulsoryCourse($id, $courseId)
    {
        $program = Program::findOrFail($id);
        $course = Course::findOrFail($courseId);

        //if course does not exists in the list of compulsory courses for this program return error
        if(!$program->compulsory_courses()->lists('course_id')->contains($courseId)){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' is not a compulsory course!'
                ]);
        }


        // else remove this course form being compuslory
        $program->compulsory_courses()->detach([$courseId]);
        return response()
            ->json([
                'data' => $course,
                'success' => true,
                'message' => $course->name . ' marked not compulsory!'
            ]);
    }

    public function getCompulsoryCourses($id){
        $program = Program::findOrFail($id);
        $courses = $program->compulsory_courses()->lists('course_id');
        return response()->json(['data' => $courses, 'success' => true, 'message' => '']);
    }
}

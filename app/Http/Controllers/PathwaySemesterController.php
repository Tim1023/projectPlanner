<?php

namespace ProgramPlanner\Http\Controllers;

use ProgramPlanner\Http\Requests;
use ProgramPlanner\Http\Requests\PathwaySemesterRequest;
use Illuminate\Http\Request;

use ProgramPlanner\Models\PathwaySemester;
use ProgramPlanner\Models\Course;

class PathwaySemesterController extends Controller
{

    /**
     * PathwaySemesterController constructor.
     */
    public function __construct()
    {
        $this->setTitle("Pathway Semesters");
    }

    /**
     * Display a listing of the resource.
     *
     * @param $pathwayId
     * @return Response
     */
    public function index($pathwayId)
    {
/*        $pathway_semesters = PathwaySemester::where('pathway_id', $pathwayId)->get();
        return view('pathway_semesters.index', array('model' => $pathway_semesters));*/
        throwException(new \Exception('Not Implemented!'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $pathwayId
     * @return Response
     */
    public function create($pathwayId)
    {
        return view('pathway_semesters._create', ['pathwayId' => $pathwayId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $pathwayId
     * @param PathwaySemesterRequest $request
     * @return Response
     */
    public function store($pathwayId, PathwaySemesterRequest $request)
    {
        $request->merge(['pathway_id' => $pathwayId]);
        PathwaySemester::create($request->all())
                    ->courses()
                    ->attach($request->input('pathway_semester_course_list'));
        return redirect()->back()->with('responseSuccess', 'Success! Pathway Semester created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pathwayId
     * @param  int  $pathwaySemesterId
     * @return Response
     */
    public function show($pathwayId, $pathwaySemesterId)
    {
/*        $pathway = Pathway::find($pathwayId);
        $pathway_semester = PathwaySemester::find($pathwaySemesterId);
        return view('pathway_semesters.show', array('pathway' => $pathway, 'model' => $pathway_semester));*/
        throwException(new \Exception('Not Implemented!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pathwayId
     * @param  int  $pathwaySemesterId
     * @return Response
     */
    public function edit($pathwayId, $pathwaySemesterId)
    {
        $pathway_semester = PathwaySemester::where('pathway_id', $pathwayId)->where('id', $pathwaySemesterId)->get();
        return view('pathway_semesters._edit', array('model' => $pathway_semester));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $pathwayId
     * @param  int  $pathwaySemesterId
     * @param PathwaySemesterRequest $request
     * @return Response
     */
    public function update($pathwayId, $pathwaySemesterId, PathwaySemesterRequest $request)
    {
        $pathway_semester = PathwaySemester::where('pathway_id', $pathwayId)
                                ->where('id', $pathwaySemesterId)
                                ->firstOrFail();
        $inputs = [
            'semester_id' => $request->get('semester_id'),
            'name' => $request->get('name'),
            'order_number' => $request->get('order_number')
        ];
        if($pathway_semester->update($inputs)){
            if($request->input('pathway_semester_course_list') == null) {
                $pathway_semester->courses()->detach($pathway_semester->course_list);
            } else {
                $pathway_semester->courses()->sync($request->input('pathway_semester_course_list'));
            }

            return redirect()->back()->with('responseSuccess', 'Success! Pathway Semester updated!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pathwayId
     * @param  int  $pathwaySemesterId
     * @return Response
     */
    public function destroy($pathwayId, $pathwaySemesterId)
    {
        $pathway_semester = PathwaySemester::where('pathway_id', $pathwayId)->where('id', $pathwaySemesterId)->get();
        if($pathway_semester->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Pathway Semester deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Pathway Semester could not be deleted!');
        };
    }

    public function addCourse($id, Request $request)
    {
        $pathwaySemester = PathwaySemester::findOrFail($id);
        $course = Course::findOrFail($request["course_id"]);

        if($pathwaySemester->courses()->lists('course_id')->contains($request["course_id"])){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' is already part of semester!'
                ]);
        }

        $pathwaySemester->courses()->attach([$request["course_id"]]);

        return response()
            ->json([
                'data' => $course->toJson(),
                'success' => true,
                'message' => $course->name . ' added to semester!'
            ]);
    }

    public function removeCourse($id, Request $request)
    {
        $pathwaySemester = PathwaySemester::findOrFail($id);
        $course = Course::findOrFail($request["course_id"]);

        //if course does not exits return error
        if(!$pathwaySemester->courses()->lists('course_id')->contains($request["course_id"])){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' not found in semester!'
                ]);
        }

        $pathwaySemester->courses()->detach([$request["course_id"]]);
        return response()
            ->json([
                'data' => $course,
                'success' => true,
                'message' => $course->name . ' removed from semester!'
            ]);
    }

}

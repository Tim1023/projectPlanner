<?php

namespace ProgramPlanner\Http\Controllers;

use Illuminate\Http\Request;
use ProgramPlanner\Http\Requests;
use ProgramPlanner\Http\Requests\ProgramSemesterRequest;

use ProgramPlanner\Models\ProgramSemester;
use ProgramPlanner\Models\Course;
class ProgramSemesterController extends Controller
{

    /**
     * ProgramSemesterController constructor.
     */
    public function __construct()
    {
        $this->setTitle("Program Semesters");
    }

    /**
     * Display a listing of the resource.
     *
     * @param $programId
     * @return Response
     */
    public function index($programId)
    {
/*        $program_semesters = ProgramSemester::where('program_id', $programId)->get();
        return view('program_semesters.index', array('model' => $program_semesters));*/
        throwException(new \Exception('Not Implemented!'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $programId
     * @return Response
     */
    public function create($programId)
    {
        return view('program_semesters._create', ['programId' => $programId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $programId
     * @param ProgramSemesterRequest $request
     * @return Response
     */
    public function store($programId, ProgramSemesterRequest $request)
    {
        $request->merge(['program_id' => $programId]);
        ProgramSemester::create($request->all())
                    ->courses()
                    ->attach($request->input('program_semester_course_list'));
        return redirect()->back()->with('responseSuccess', 'Success! Program Semester created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $programId
     * @param  int  $programSemesterId
     * @return Response
     */
    public function show($programId, $programSemesterId)
    {
/*        $program = Program::find($programId);
        $program_semester = ProgramSemester::find($programSemesterId);
        return view('program_semesters.show', array('program' => $program, 'model' => $program_semester));*/
        throwException(new \Exception('Not Implemented!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $programId
     * @param  int  $programSemesterId
     * @return Response
     */
    public function edit($programId, $programSemesterId)
    {
        $program_semester = ProgramSemester::where('program_id', $programId)->where('id', $programSemesterId)->get();
        return view('program_semesters._edit', array('model' => $program_semester));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $programId
     * @param  int  $programSemesterId
     * @param ProgramSemesterRequest $request
     * @return Response
     */
    public function update($programId, $programSemesterId, ProgramSemesterRequest $request)
    {
        $program_semester = ProgramSemester::where('program_id', $programId)
                                ->where('id', $programSemesterId)
                                ->firstOrFail();
        $inputs = [
            'semester_id' => $request->get('semester_id'),
            'name' => $request->get('name'),
            'order_number' => $request->get('order_number')
        ];
        if($program_semester->update($inputs)){
            if($request->input('program_semester_course_list') == null) {
                $program_semester->courses()->detach($program_semester->course_list);
            } else {
                $program_semester->courses()->sync($request->input('program_semester_course_list'));
            }

            return redirect()->back()->with('responseSuccess', 'Success! Program Semester updated!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $programId
     * @param  int  $programSemesterId
     * @return Response
     */
    public function destroy($programId, $programSemesterId)
    {
        $program_semester = ProgramSemester::where('program_id', $programId)->where('id', $programSemesterId);
        if($program_semester->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Program Semester deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Program Semester could not be deleted!');
        };
    }


    public function addCourse($id, Request $request)
    {
        $programSemester = ProgramSemester::findOrFail($id);
        $course = Course::findOrFail($request["course_id"]);

        if($programSemester->courses()->lists('course_id')->contains($request["course_id"])){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' is already part of semester!'
                ]);
        }

        $programSemester->courses()->attach([$request["course_id"]]);

        return response()
            ->json([
                'data' => $course->toJson(),
                'success' => true,
                'message' => $course->name . ' added to semester!'
            ]);
    }

    public function removeCourse($id, Request $request)
    {
        $programSemester = ProgramSemester::findOrFail($id);
        $course = Course::findOrFail($request["course_id"]);

        //if course does not exits return error
        if(!$programSemester->courses()->lists('course_id')->contains($request["course_id"])){
            return response()
                ->json([
                    'data' => $course->toJson(),
                    'error' => true,
                    'message' => $course->name . ' not found in semester!'
                ]);
        }

        $programSemester->courses()->detach([$request["course_id"]]);
        return response()
            ->json([
                'data' => $course,
                'success' => true,
                'message' => $course->name . ' removed from semester!'
            ]);
    }

}

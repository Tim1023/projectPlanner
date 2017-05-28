<?php
namespace ProgramPlanner\Http\Controllers;

use ProgramPlanner\Http\Requests\PathwayRequest;
use ProgramPlanner\Models\Program;
use ProgramPlanner\Models\Pathway;
use ProgramPlanner\Models\Semester;
use ProgramPlanner\Models\Course;
use ProgramPlanner\Models\Career;

class PathwayController extends Controller
{
    public function __construct()
    {
        $this->setTitle("Pathways");
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pathways = Pathway::with('program')->get();
        return view('pathways.index', array('model' => $pathways));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $programs = Program::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        return view('pathways.create', compact('programs', 'careerList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PathwayRequest $request
     * @return Response
     */
    public function store(PathwayRequest $request)
    {
        $pathway = Pathway::create($request->all());
        $pathway->careers()->attach($request->input('career_list'));
        $pathway->initializePathway();
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
        $pathway = Pathway::with(['pathway_semesters.courses', 'careers'])->findOrFail($id);
        return view('pathways.show', array('model' => $pathway));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $pathway = Pathway::with('pathway_semesters.courses')->findOrFail($id);
        $programs = Program::lists('name', 'id');
        $semesterList = Semester::lists('name', 'id');
        $careerList = Career::lists('name', 'id');
        // List of courses used for pre-requisites and co-requisites
        $courseList = Course::get()->lists('full_name_with_credits', 'id');
        return view('pathways.edit',
            ['model' => $pathway,
                'programs' => $programs,
                'semesterList' => $semesterList,
                'courseList' => $courseList,
                'careerList' => $careerList
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param PathwayRequest $request
     * @return Response
     */
    public function update($id, PathwayRequest $request)
    {
        $pathway = Pathway::findOrFail($id);


        $pathway->update($request->all());

        if($request->input('career_list') == null) {
            $pathway->careers()->detach($pathway->career_list);
        } else {
            $pathway->careers()->sync($request->input('career_list'));
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
        $pathway = Pathway::findOrFail($id);
        if($pathway->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Pathway deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Pathway could not be deleted!');
        };
    }
}

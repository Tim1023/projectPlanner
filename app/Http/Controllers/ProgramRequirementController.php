<?php

namespace ProgramPlanner\Http\Controllers;

use ProgramPlanner\Http\Requests;
use ProgramPlanner\Http\Requests\ProgramRequirementRequest;

use ProgramPlanner\Models\ProgramRequirement;
class ProgramRequirementController extends Controller
{

    /**
     * ProgramRequirementController constructor.
     */
    public function __construct()
    {
        $this->setTitle("Program Requirements");
    }

    /**
     * Display a listing of the resource.
     *
     * @param $programId
     * @return Response
     */
    public function index($programId)
    {
/*        $program_requirements = ProgramRequirement::where('program_id', $programId)->get();
        return view('program_requirements.index', array('model' => $program_requirements));*/
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
        return view('program_requirements._create', ['programId' => $programId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $programId
     * @param ProgramRequirementRequest $request
     * @return Response
     */
    public function store($programId, ProgramRequirementRequest $request)
    {
        $request->merge(['program_id' => $programId]);
        ProgramRequirement::create($request->all());
        return redirect()->back()->with('responseSuccess', 'Success! Program Requirement created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $programId
     * @param  int  $programRequirementId
     * @return Response
     */
    public function show($programId, $programRequirementId)
    {
/*        $program = Program::find($programId);
        $program_requirement = ProgramRequirement::find($programRequirementId);
        return view('program_requirements.show', array('program' => $program, 'model' => $program_requirement));*/
        throwException(new \Exception('Not Implemented!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $programId
     * @param  int  $programRequirementId
     * @return Response
     */
    public function edit($programId, $programRequirementId)
    {
        $program_requirement = ProgramRequirement::where('program_id', $programId)->where('id', $programRequirementId)->get();
        return view('program_requirements._edit', array('model' => $program_requirement));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $programId
     * @param  int  $programRequirementId
     * @param ProgramRequirementRequest $request
     * @return Response
     */
    public function update($programId, $programRequirementId, ProgramRequirementRequest $request)
    {
        $program_requirement = ProgramRequirement::where('program_id', $programId)
                                ->where('id', $programRequirementId)
                                ->firstOrFail();
        $inputs = [
            'level' => $request->get('level'),
            'minimum_credits' => $request->get('minimum_credits'),
            'maximum_credits' => $request->get('maximum_credits'),
            'allowed' => $request->get('allowed')
        ];

        $program_requirement->update($inputs);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $programId
     * @param  int  $programRequirementId
     * @return Response
     */
    public function destroy($programId, $programRequirementId)
    {
        $program_requirement = ProgramRequirement::where('program_id', $programId)->where('id', $programRequirementId);
        if($program_requirement->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Program Requirement deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Program Requirement could not be deleted!');
        };
    }
}

<?php

namespace ProgramPlanner\Http\Controllers;

use Illuminate\Http\Request;

use ProgramPlanner\Http\Requests;
use ProgramPlanner\Http\Requests\DepartmentRequest;
use ProgramPlanner\Models\Department;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->setTitle("Departments");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', array('model' => $departments));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return Response
     */
    public function store(DepartmentRequest $request)
    {
        if (Department::create($request->all())) {
            return redirect()->back()->with('responseSuccess', 'Success! Department created!');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        return view('departments.show', array('department' => $department));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', array('department' => $department));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param DepartmentRequest $request
     * @return Response
     */
    public function update($id, DepartmentRequest $request)
    {
        $department = Department::findOrFail($id);

        if ($department->update($request->all())) {
            return redirect()->back()->with('responseSuccess', 'Success! Department updated!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        if ($department->delete()) {
            return redirect()->back()->with('responseSuccess', 'Success! Department deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Department could not be deleted!');
        };
    }
}

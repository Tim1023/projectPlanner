<?php

namespace ProgramPlanner\Http\Controllers;

use Illuminate\Http\Request;

use ProgramPlanner\Http\Requests;
use ProgramPlanner\Models\Career;
use ProgramPlanner\Http\Requests\CareerRequest;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->setTitle("Careers");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $careers = Career::get();
        return view('careers.index', array('model' => $careers));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CareerRequest $request
     * @return Response
     */
    public function store(CareerRequest $request)
    {
        if(Career::create($request->all())){
            return redirect()->back()->with('responseSuccess', 'Success! Career created!');
        }

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
        $career = Career::find($id);
        return view('careers.show', array('model' => $career));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $career = Career::findOrFail($id);
        return view('careers.edit', array('model' => $career));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CareerRequest $request
     * @return Response
     */
    public function update($id, CareerRequest $request)
    {
        $career = Career::findOrFail($id);

        if($career->update($request->all())){
            return redirect()->back()->with('responseSuccess', 'Success! Career updated!');
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
        $career = Career::findOrFail($id);
        if($career->delete()){
            return redirect()->back()->with('responseSuccess', 'Success! Career deleted successfully!');
        } else {
            return redirect()->back()->with('responseError', 'Error! Career could not be deleted!');
        };
    }
}

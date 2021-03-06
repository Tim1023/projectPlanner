<?php

namespace ProgramPlanner\Http\Controllers;

use ProgramPlanner\Http\Requests;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        $this->setTitle("Dashboard");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
}

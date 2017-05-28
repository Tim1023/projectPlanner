<?php

namespace ProgramPlanner\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $title;

    public function __construct(){

    }

    public function setTitle($title){
        $data = array("pageTitle" => $title ? "Program Planner | " . $title : "Program Planner");
        view()->share($data);
    }
}

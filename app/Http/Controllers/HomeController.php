<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::join('templates', 'projects.template_id', '=', 'templates.id')
        ->select("projects.*", "templates.screenshot_url", "templates.category")
        ->where("projects.user_id", "=", Auth::user()->id)->get();
        // $templates = Templates::all();

        //return $projects;
        if(count($projects) > 0){
            return view('home', compact('projects'));
        }else{
            return view('create_project');
        }
    }
}

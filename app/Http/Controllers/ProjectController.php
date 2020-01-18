<?php

namespace App\Http\Controllers;

use DB;
use Str;
use Auth;
use Request;
use Session;
use Redirect;
use Response;
use App\Table;
use Filesystem;
use App\Project;
use PhpCodeEditor;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public $project_name;
    public $output;
    protected $editor;
    public $project_version = "5.6.*";
    public $base_dir = "C:\laragon\www\\";
    public $php_dir = "C:\laragon\bin\php\php-5.6.16\php";

    public function __construct() {
        $this->middleware('auth');
        $this->editor = new Filesystem();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_project_in_db()
    {
        set_time_limit(0);

        $input = Request::all();
        
        $project = new Project;
        $project->name = strtolower(str_replace(" ", "_", $input["project_name"])) . "__" . Str::random(5);
        $project->user_id = Auth::user()->id;
        $project->template_id = 1;

        $projects = Project::join('templates', 'projects.template_id', '=', 'templates.id')
        ->select("projects.*", "templates.screenshot_url", "templates.category")
        ->where("projects.user_id", "=", Auth::user()->id)
        ->where("projects.name", "=", $input["project_name"])->get();

        if(count($projects) > 0){
            return Response::json(array('success' => false, 'message' => "Duplicate project found: ".$input["project_name"].". Please use another name."), 200);
        }

        if(!$project->save()){
            return Response::json(array('success' => false, 'message' => $input["project_name"]." could not be created in our database. Notify us at info@marabele.com if the problem persists for you. WE GOT YOUR BACK!"), 200);
        }

        return Response::json(array('success' => true, 'project_id' => $project->id, 'message' => $input["project_name"]." has been created."), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        set_time_limit(0);
        $input = Request::all();

        $this->project_name = strtolower(str_replace(" ", "_", $input["project_name"]));
        // Change this to rename already existing project !!!!!!!!!!!!!!!!!!!!!!!!!

        // if(isset($input["by"])) {
        //     $output = $this->editor->create_project(array('base_dir' => $this->base_dir, "project_name" => $this->project_name, "project_version" => $this->project_version));            
        // } else {
        //     $output = array();
        //     $path = $this->base_dir.env("PROJECT_NAME", "krie")."\\storage\\originals\\original-5.6.21";
        //     $target =  $this->base_dir.$input["project_name"];
        //     $this->editor->copyDirectory($path, $target);
        // }
        $output = "Created";

        return Response::json(array('success' => true, 'message' => $this->project_name." files have been created.", 'output' => json_encode($output)), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_project($id)
    {
        $project = Project::join('templates', 'projects.template_id', '=', 'templates.id')
        ->select("projects.*", "templates.screenshot_url", "templates.category")
        ->where("projects.user_id", "=", Auth::user()->id)
        ->where("projects.id", "=", $id)->first();
        $tables = Table::where("project_id", "=", $id)->get();
        return view('view_project', compact("project", "tables"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete one project 
        $Project = Project::find($id);

        if ($Project) {
            $Project->delete();

            // delete related tables
            $tables = Table::where(array('project_id' => $id))->get();
            for ($i=0; $i < count($tables); $i++) { 
                $tables[$i]->delete();
            }
        }

        // redirect
        Session::flash('message', 'Successfully deleted the project and related tables!');
        return Redirect::to('home');
    }
}

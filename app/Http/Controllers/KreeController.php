<?php

/**
 * Kree - A PHP Framework For Web Artisans
 *
 * @package  Laravel/Kree
 * @author   Kwasi Kgwete <kabelokwasi@gmail.com>
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Projects;
use App\Templates;
use Filesystem;
use Response;
use DB;
use Auth;
use Request;

class KreeController extends Controller
{
    public $project_name;
    public $data;
    public $tables;
    public $ref_relationships = array();
    public $output;
    protected $editor;
    public $project_version = "5.6.*";
    public $base_dir = "C:\laragon\www\\";
    public $php_dir = "C:\laragon\bin\php\php-5.6.16\php";

    public function __construct() {
        $this->editor = new Filesystem();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function auto_crud()
    {
        $databases = DB::connection("mysql")->select("SHOW DATABASES");
        $db_list = [];
        $i = 0;
        foreach ($databases as $key => $database) {
            $db_list[$database->{"Database"}] = $database->{"Database"};
            $i++;
        }

        $projects = scandir($this->base_dir);

        return view('dashboard.auto_crud', compact('projects', 'db_list'));
    }
    /**
     * Run the kree algorithm according to inputs.
     *
     * @return Response
     */
    public function new_project()
    {
        $templates = Templates::all();
        return view('create_project', compact('templates'));
    }

    /**
     * Run the kree algorithm according to inputs.
     *
     * @return Response
     */
    public function demo_new_project()
    {
        $input = Request::all();
        return $input;
        $templates = Templates::all();
        return view('dashboard.new_build', compact('templates', 'input'));
    }

    /**
     * Run the kree algorithm according to inputs.
     *
     * @return Response
     */
    public function kree_action()
    {
        set_time_limit(0);

        $this->output = array();

        $input = Request::all();

        $this->db_name = $input["database"];

        $db_data = $this->get_db_data($this->db_name);

        $base_dir = $this->base_dir;

        $this->project_name = $input["project"];

        $this->tables = $input["tables"];

        $this->tables = explode(",", $this->tables);

        if(isset($input["action"]) AND $input["action"] != "Choose Action"){
            if($input["action"] == "Kree All"){
                $this->create_migrations();
                $this->create_models();
                $this->create_controllers();
                $this->create_auth_views();
                $this->create_routes();
                $this->create_dependencies();
                $this->create_auth();
            }elseif ($input["action"] == "Kree Migrations") {
                $this->create_migrations();
            }elseif ($input["action"] == "Kree Models") {
                $this->create_models();
            }elseif ($input["action"] == "Kree Controllers") {
                $this->create_controllers();
            }elseif ($input["action"] == "Kree Views") {
                $this->create_views();
            }elseif ($input["action"] == "Kree Routes") {
                $this->create_routes();
            }elseif ($input["action"] == "Kree Dependencies") {
                $this->create_dependencies();
            }elseif ($input["action"] == "Kree Auth") {
                $this->create_auth();
            }
        }        

        $output = $this->output;
        return view('kree_action', compact('output'));
    }

    /**
     * Run the kree algorithm according to inputs.
     *
     * @return Response
     */
    public function get_table_filter()
    {
        $input = Request::all();

        $db_name = $input["db_name"];

        $db_data = $this->get_db_data($db_name);

        return view('dashboard.table_filter', compact('db_data'));
    }  

    /**
     * Run the kree algorithm according to inputs.
     *
     * @return Response
     */
    public function kree()
    {
        $input = Request::all();

        $db_name = $input["db_name"];

        $data = $this->get_db_data($db_name);

        $base_dir = $this->base_dir;

        $this->project_name = $input["project_name"];

        return view('kree', compact('data', 'db_name', 'base_dir'));
    }    

    /**
     * Select the project dir and CRUD/KREE files.
     *
     * @return Response
     */
    public function get_db_data($db_name)
    {
       $tables = DB::connection("mysql2")->select("SHOW TABLES from ".$db_name."");
        $data = array();
        $i = 0;
        //For Each table in the selected db
        foreach ($tables as $key => $table) {
            //Select table attributes and comments
            $columns = DB::connection("mysql2")->select("SHOW COLUMNS FROM ".$table->{"Tables_in_".$db_name}." FROM ".$db_name);

            //This section select the Foreign key details for $table
            $fk_details = DB::connection("mysql2")->
            select("SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE REFERENCED_TABLE_SCHEMA = '".$db_name."' AND REFERENCED_TABLE_NAME = '".$table->{"Tables_in_".$db_name}."'");            

            $data[$i]['name'] = $table->{"Tables_in_".$db_name};
            $data[$i]['columns'] = $columns;
            $data[$i]['fk_details'] = $fk_details;

            $i++;
        }
        return $data;
    }

    /**
     * Select the project dir and CRUD/KREE files.
     *
     * @return Response
     */
    public function choose_project()
    {
        //set_time_limit(0);

        $input = Request::all();

        $this->project_name = $input["project_name"];

        if($this->project_name == "Choose Project"){
            return "Please select a Project";
        }

        $this->tables = $input["tables"];
        $this->db_name = $input["db_name"];

        $this->tables = explode(",", $this->tables);

        if(isset($input["action"]) AND $input["action"] != "Choose Action"){
            if($input["action"] == "Kree All"){
                $this->create_migrations();
                $this->create_models();
                $this->create_controllers();
                $this->create_views();
            }elseif ($input["action"] == "Kree Migrations") {
                $this->create_migrations();
            }elseif ($input["action"] == "Kree Models") {
                $this->create_models();
            }elseif ($input["action"] == "Kree Controllers") {
                $this->create_controllers();
            }elseif ($input["action"] == "Kree Views") {
                $this->create_views();
            }elseif ($input["action"] == "Kree Routes") {
                $this->create_routes();
            }elseif ($input["action"] == "Kree Dependencies") {
                $this->create_dependencies();
            }elseif ($input["action"] == "Kree Auth") {
                $this->create_auth();
            }
        }
        return "";
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_project()
    {

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////AUTHENTICATION KREEATOR////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_auth(){
        /**
         *  add the html builder to the laravel project
        */

        $this->create_auth_views();

    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_auth_views(){

        $file_dir = $this->base_dir.$this->project_name."\\resources\\views\\auth\\";

        //Make auth directory
        $this->editor->makeDirectory($file_dir);        
        
        /**
         *  creating register view , which may include register form
        */               
        $filename = "register.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

        /**
         *  write to register and add html and form builder
        */ 
        include '../KreeViews/auth/register.kree.php';  

        $write_request = array(
            'file_url' => $file_dir.$filename,
            'new_content' => $new_content,
            'remove_lines' => [],
            'line_number' => 0,
            'write_options' => 'replace'
        );                
        $this->editor->write($write_request);


        /**
         *  creating login view , which may include register form
        */               
        $filename = "login.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

        /**
         *  write to login and add html and form builder
        */ 
        include '../KreeViews/auth/login.kree.php';  

        $write_request = array(
            'file_url' => $file_dir.$filename,
            'new_content' => $new_content,
            'remove_lines' => [],
            'line_number' => 0,
            'write_options' => 'replace'
        );                
        $this->editor->write($write_request);

        /**
         *  creating password view , which may include register form
        */               
        $filename = "password.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

        /**
         *  write to password and add html and form builder
        */ 
        include '../KreeViews/auth/password.kree.php';  

        $write_request = array(
            'file_url' => $file_dir.$filename,
            'new_content' => $new_content,
            'remove_lines' => [],
            'line_number' => 0,
            'write_options' => 'replace'
        );                
        $this->editor->write($write_request);

        /**
         *  creating reset view , which may include register form
        */               
        $filename = "reset.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

        /**
         *  write to reset and add html and form builder
        */ 
        include '../KreeViews/auth/reset.kree.php';  

        $write_request = array(
            'file_url' => $file_dir.$filename,
            'new_content' => $new_content,
            'remove_lines' => [],
            'line_number' => 0,
            'write_options' => 'replace'
        );                
        $this->editor->write($write_request);        

        array_push($this->output, "Auth Creation Complete!");        
    }    


    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////DEPENDENCY KREEATOR////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_dependencies(){
        /**
         *  add the html builder to the laravel project
        */
        array_push($this->output, "Adding the html builder to the laravel project");
        $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "composer_html"));

        $this->edit_dependencies();
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function edit_dependencies($request){
        /**
         *  write to config/app.php and add html and form builder
        */ 
        $new_content = [
            "\t\t'Form'      => Illuminate\Html\FormFacade::class, \n",
            "\t\t'Html'      => Illuminate\Html\HtmlFacade::class,\n"
        ];        

        $update_request = array(
            'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
            'function_name' => "index",
            'new_content' => $new_content,
            'update_type' => "replace",
            'table' => $table
        );                

        $this->editor->update_array($update_request);
    }    

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////ROUTE KREEATOR//////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * For chosen project, loop through all tables.
     * Create a controller file for each table.
     * Foreach column insert it into Mass Assigned Array.
     *
     * @return Response
     */
    public function create_routes()
    {
        $file_dir = $this->base_dir.$this->project_name."\\app\\Http\\";

        $filename = "routes.php";
        
        $result = $this->editor->exists($file_dir.$filename);
        if(!$result){ //if file does not exist, create it
            array_push($this->output, "*Creating Route File");
            $this->editor->createFile($file_dir.$filename, "");
        }else{//else delete it then recreate it
            if (!unlink($file_dir.$filename))
            {
                array_push($this->output, "Error deleting: ".$file_dir.$filename);
                return;
            }
            else
            {
                array_push($this->output, "+Creating Route File");
                $this->editor->createFile($file_dir.$filename, " ");
            }         
        }

        array_push($this->output, "File Created: ".$filename);

        $this->edit_route(array('table' => "routes.php", 'file_url' => $file_dir."routes.php"));

        /**
         *  create table routes to the CRUD
        */                      

        for ($i=0; $i < count($this->tables); $i++) {
            /**
             *  editing route file to include current table as a resource
            */               

            $this->edit_route(array('table' => $this->tables[$i], 'file_url' => $file_dir.$filename));
        }  

        $this->edit_route(array('table' => "Last", 'file_url' => $file_dir."routes.php"));
    }

    /**
     * Loops through each table column and insert it into migration
     *
     * @return Response
     */
    public function edit_route($request)
    {
        $data = $this->get_db_data($this->db_name);
        //array_push($this->output, "<pre>";
        //print_r($data);
        //array_push($this->output, "</pre>";

        if($request["table"] == "routes.php"){
            include "../app/KreeViews/route.kree.php";

            $write_request = array(
                'file_url' => $request["file_url"],
                'new_content' => $new_content,
                'remove_lines' => [],
                'line_number' => 0,
                'write_options' => 'replace',
                'table' => $request['table']
            );                
            $this->editor->write($write_request);
        }elseif($request["table"] == "Last"){
            $new_content = [
                "\n});\n"
            ];

            $write_request = array(
                'file_url' => $request["file_url"],
                'new_content' => $new_content,
                'remove_lines' => [],
                'write_options' => 'append',
                'table' => $request['table']
            );                
            $this->editor->write($write_request);            
        }else{
            $new_content = [
                "\tRoute::resource('".$request["table"]."', '".$request["table"]."Controller');\n\n"
            ];

            $write_request = array(
                'file_url' => $request["file_url"],
                'new_content' => $new_content,
                'remove_lines' => [],
                'write_options' => 'append',
                'table' => $request['table']
            );                
            $this->editor->write($write_request);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////VIEW KREEATOR///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_directories()
    {
        /**
         *  create main views, which may include Main file that has bootstraped Header and Footer
        */      

        $file_dir = $this->base_dir.$this->project_name."/resources/views/";

        for ($i=0; $i < count($this->tables); $i++) {
            //creating model for table via php artisan make:model command
            $result = file_exists($file_dir.$this->tables[$i]);
            
            if(!$result){ //if dir does not exist, create it
                array_push($this->output, "*Creating View Directory for ".$this->tables[$i].": ".$file_dir.$this->tables[$i]);
                $this->editor->makeDirectory($file_dir.$this->tables[$i]);
            }else{
                if (!$this->editor->deleteDirectory($file_dir.$this->tables[$i]))
                {
                    array_push($this->output, "Error deleting: ".$file_dir);
                    return;
                }
                else
                {
                    array_push($this->output, "+Creating View Directory for ".$this->tables[$i]);
                    $this->editor->makeDirectory($file_dir.$this->tables[$i]);
                }         
            }

            array_push($this->output, "Directory Created: ".$file_dir);

            //Loops through each table column and insert it into migration
            //$this->edit_controller(array('table' => $this->tables[$i], 'filename' => $filename));

            //break;
        }               
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_views()
    {
        $this->create_directories();

        /**
         *  create main view, which may include Main file called app.blade.php that has bootstraped Header and Footer
        */      

        // $file_dir = $this->base_dir.$this->project_name."\\resources\\views\\";
        
        // $filename = "app.blade.php";
        // array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));
        
        // $this->edit_view(array('table' => "app.blade.php"));

        /**
         *  create error handling partial view
        */      
        $filename = "list.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir."errors\\".$filename)));
        
        $this->edit_view(array('table' => "list.blade.php"));

        /**
         *  create table views, which may include CRUD files that use bootstrap
        */                      

        for ($i=0; $i < count($this->tables); $i++) {
            $file_dir = $this->base_dir.$this->project_name."\\resources\\views\\".$this->tables[$i]."\\";
            
            /**
             *  creating index view , which may include CRUD navigation
            */               
            $filename = "index.blade.php";
            array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

            //Loops through each table column and insert it into migration

            /**
             *  creating create view , which may include CRUD navigation
            */               
            $filename = "create.blade.php";
            array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

            //Loops through each table column and insert it into migration

            /**
             *  creating index view , which may include CRUD navigation
            */               
            $filename = "edit.blade.php";
            array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

            //Loops through each table column and insert it into migration

            /**
             *  creating index view , which may include CRUD navigation
            */               
            $filename = "show.blade.php";
            array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

            /**
             *  creating index view , which may include CRUD navigation
            */               
            $filename = "form.blade.php";
            array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

            //Edit View
            $this->edit_view(array('table' => $this->tables[$i]));

            //break;
        }               
    }    

    /**
     * Loops through each table column and insert it into migration
     *
     * @return Response
     */
    public function edit_view($request)
    {
        $data = $this->get_db_data($this->db_name);
        //array_push($this->output, "<pre>";
        //print_r($data);
        //array_push($this->output, "</pre>";

        /**
         *  check to see if we need to create main file app.blade.php
        */
        if ($request["table"] == "app.blade.php") {
            include "../app/KreeViews/app.kree.php";

            $write_request = array(
                'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\app.blade.php",
                'new_content' => $new_content,
                'remove_lines' => [0],
                'line_number' => 0,
                'write_options' => 'replace',
                'table' => $request['table']
            );                
            $this->editor->write($write_request);

            return;
        }  

        /**
         *  check to see if we need to create main file app.blade.php
        */
        if ($request["table"] == "list.blade.php") {
            include "../app/KreeViews/errors/list.kree.php";

            $write_request = array(
                'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\errors\\list.blade.php",
                'new_content' => $new_content,
                'remove_lines' => [0],
                'line_number' => 0,
                'write_options' => 'replace',
                'table' => $request['table']
            );                
            $this->editor->write($write_request);

            return;
        }                

        for ($i=0; $i < count($data); $i++) {
            if($data[$i]["name"] == $request['table']){        
                $table = $request['table'];
                $tableInView = $table;
                /**
                 *  write to index()
                */  
                include "../app/KreeViews/index.kree.php";    

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\".$table."\\index.blade.php",
                    'new_content' => $new_content,
                    'remove_lines' => [0],
                    'line_number' => 0,
                    'write_options' => 'replace',
                    'table' => $request['table']
                );                
                $this->editor->write($write_request);

                /**
                 *  write to create()
                */             
                include "../app/KreeViews/create.kree.php";    

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\".$table."\\create.blade.php",
                    'new_content' => $new_content,
                    'remove_lines' => [0],
                    'line_number' => 0,
                    'write_options' => 'replace',
                    'table' => $request['table']
                );                
                $this->editor->write($write_request);                
               
                /**
                 *  write to edit()
                */              
                include "../app/KreeViews/edit.kree.php";    

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\".$table."\\edit.blade.php",
                    'new_content' => $new_content,
                    'remove_lines' => [0],
                    'line_number' => 0,
                    'write_options' => 'replace',
                    'table' => $request['table']
                );                
                $this->editor->write($write_request);

                /**
                 *  write to show()
                */             
                include "../app/KreeViews/show.kree.php";    

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\".$table."\\show.blade.php",
                    'new_content' => $new_content,
                    'remove_lines' => [0],
                    'line_number' => 0,
                    'write_options' => 'replace',
                    'table' => $request['table']
                );                
                $this->editor->write($write_request);

                /**
                 *  write to form partial
                */             
                include "../app/KreeViews/form.kree.php";    

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\\resources\\views\\".$table."\\form.blade.php",
                    'new_content' => $new_content,
                    'remove_lines' => [0],
                    'line_number' => 0,
                    'write_options' => 'replace',
                    'table' => $request['table']
                );                
                $this->editor->write($write_request);                

                 return;
            }
        }
    }            

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////CONTROLLER KREEATOR///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * For chosen project, loop through all tables.
     * Create a controller file for each table.
     * Foreach column insert it into Mass Assigned Array.
     *
     * @return Response
     */
    public function create_controllers()
    {
        $file_dir = $this->base_dir.$this->project_name."\app\\Http\\Controllers\\";

        for ($i=0; $i < count($this->tables); $i++) {
            $result = $this->editor->exists($file_dir.$this->tables[$i]."Controller.php");
            $filename = $this->tables[$i]."Controller.php";

            if(!$result){ //if controller does not exist, create it
                array_push($this->output, "*Creating Controller for ".$this->tables[$i]);
                $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "controller", 'table' => $this->tables[$i]));
            }else{
                if (!unlink($file_dir.$filename))
                {
                    array_push($this->output, "Error deleting: ".$filename);
                    return;
                }
                array_push($this->output, "*Creating Controller for ".$this->tables[$i]);
                $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "controller", 'table' => $this->tables[$i]));                                                    
            }

            array_push($this->output, "File Created: ".$filename);

            //Loops through each table column and insert it into migration
            $this->edit_controller(array('table' => $this->tables[$i], 'filename' => $filename));
        }        
    }

    /**
     * Loops through each table column and insert it into migration
     *
     * @return Response
     */
    public function edit_controller($request)
    {
        $data = $this->get_db_data($this->db_name);

        for ($i=0; $i < count($data); $i++) {
            if($data[$i]["name"] == $request['table']){        
                $table = $request['table'];
                $project = $this->project_name;
                //echo "getcwd: ".getcwd();

                /**
                 *  add model and view service provider to controller
                */
                include "../app/KreeViews/controllers/dependencies.kree.php";
                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'remove_lines' => [],
                    'new_content' => $new_content,
                    'line_number' => 8,
                    'write_options' => 'index',
                    'table' => $table
                );

                echo "<pre>";
                print_r($write_request);
                echo "</pre>";
                $this->editor->write($write_request);

                /**
                 *  write to index()
                */ 
                include "../app/KreeViews/controllers/index.kree.php";

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "index",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );                

                $this->editor->update_function($update_request);

                /**
                 *  write to create()
                */              
                include "../app/KreeViews/controllers/create.kree.php";

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "create",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );                

                $this->editor->update_function($update_request);

                /**
                 *  write to store()
                */              
                include "../app/KreeViews/controllers/store.kree.php";

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "store",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );

                $this->editor->update_function($update_request);                

                /**
                 *  write to show()
                */        
                include "../app/KreeViews/controllers/show.kree.php";

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "show",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );                

                $this->editor->update_function($update_request);

                /**
                 *  write to edit()
                */ 
                include "../app/KreeViews/controllers/edit.kree.php";             
                
                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "edit",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );                

                $this->editor->update_function($update_request);

                /**
                 *  write to update()
                */  
                include "../app/KreeViews/controllers/update.kree.php";            

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "update",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );

                $this->editor->update_function($update_request);                

                /**
                 *  write to destroy()
                */   
                include "../app/KreeViews/controllers/destroy.kree.php";           

                $update_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\Http\Controllers\\".$request['filename'],
                    'function_name' => "destroy",
                    'new_content' => $new_content,
                    'update_type' => "replace",
                    'table' => $table
                );                

                $this->editor->update_function($update_request);
            }
        }
    }        


    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////MODEL KREEATOR///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * For chosen project, loop through all tables.
     * Create a model file for each table.
     * Foreach column insert it into Mass Assigned Array.
     *
     * @return Response
     */
    public function create_models()
    {
        $file_dir = $this->base_dir.$this->project_name."\app\\";

        for ($i=0; $i < count($this->tables); $i++) {
            //creating model for table via php artisan make:model command
            $result = $this->editor->exists($file_dir.$this->tables[$i].".php");
            $filename = $this->tables[$i].".php";
            if(!$result){ //if model does not exist, create it
                array_push($this->output, "Creating Model for ".$this->tables[$i]);
                $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "model", 'table' => $this->tables[$i]));
            }else{
                if (!unlink($file_dir.$filename))
                {
                    array_push($this->output, "Error deleting: ".$filename);
                    return;
                }
                else
                {
                    array_push($this->output, "Creating Model for ".$this->tables[$i]);
                    $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "model", 'table' => $this->tables[$i]));                                    
                }                 
            }

            array_push($this->output, "File Created: ".$filename);

            //Loops through each table column and insert it into migration
            $this->edit_model(array('table' => $this->tables[$i], 'filename' => $filename));
        }
    }

    /**
     * Loops through each table column and insert it into migration
     *
     * @return Response
     */
    public function edit_model($request)
    {
        $data = $this->get_db_data($this->db_name);

        //print_r($data);

        for ($i=0; $i < count($data); $i++) {
            if($data[$i]["name"] == $request['table']){
                $new_content = array();
                array_push($new_content, "\tpublic \$table = '".$request['table']."'; \n");
                array_push($new_content, "\tprotected \$fillable = [ \n");
                for ($j=0; $j < count($data[$i]["columns"]); $j++) {
                    //print_r($data[$i]["columns"][$j]);
                    if(strpos($data[$i]["columns"][$j]->{"Type"}, "int") == false AND $data[$i]["columns"][$j]->{"Key"} !== "PRI" ){ //Not Primary Keys
                        array_push($new_content, "          '".$data[$i]["columns"][$j]->{"Field"}."'".($j != count($data[$i]["columns"]) -1 ? "," : "")." \n");
                    }
                }
                array_push($new_content, "      ]; \n");

                if(isset($data[$i]["fk_details"])){
                    for ($k=0; $k < count($data[$i]["fk_details"]); $k++) {
                        //$new_relationships = $this->create_model_relationship(array('table' => $data[$i]["fk_details"][0]->{"REFERENCED_TABLE_NAME"}, 'relationship' => $data[$i]["fk_details"][0]->{"CONSTRAINT_NAME"}, "ref_table" => $data[$i]["fk_details"][0]->{"TABLE_NAME"}));
                        $this->editor->array_insert($new_content, count($new_content), $new_relationships);
                    }
                }

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\app\\".$request['filename'],
                    'remove_lines' => [11],
                    'new_content' => $new_content,
                    'line_number' => 8,
                    'write_options' => 'index',
                    'table' => $request['table']
                );                

                $this->editor->write($write_request);
                
                return "DONE";
            } 
        }
    }      

    /**
     * create_model_relationship =====================Fix this for future use
     *
     * @return Response
     */
    public function create_model_relationship($request)
    {
        /*
        $result = array();
        $content = array();

        $relationship = explode("_", $request["relationship"]);
        if(count($relationship) > 1){
            array_push($content, "      return \$this->".$relationship."('kree\\".$request["ref_table"]."'); \n");
        }

        $result = $this->editor->create_function(array(
            'comments' => "* ".$request["relationship"]." Model relationship for ".$request["table"]." and ".$request["ref_table"],
            'spacing' => "     ", 
            'content' => $content));

        return $result;

        //$this->ref_relationships;
        //$this->relation_queue                         
        */
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////MIGRATION KREEATOR///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * For chosen project, loop through all tables.
     * Create a migration file for each table.
     * For each table column insert it into migration.
     *
     * @return Response
     */
    public function create_migrations()
    {
        $file_dir = $this->base_dir.$this->project_name."\database\migrations\\";
        for ($i=0; $i < count($this->tables); $i++) {
            //creating migration for table via php artisan make:migration command
            $result = $this->editor->exists($file_dir."_".$this->tables[$i]."_table.php");
            $filename = $result["filename"];
            if(!$result){ //if migration does not exist, create it
                array_push($this->output, "1. Creating migration for ".$this->tables[$i]);
                $output = $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "migration", 'table' => $this->tables[$i]));
            }else{ //remove migration then create it
                if (!unlink($file_dir.$filename))
                {
                    array_push($this->output, "Error deleting: ".$filename);
                    return;
                }
                else
                {
                    array_push($this->output, "2. Creating migration for ".$this->tables[$i]);
                    $output = $this->editor->make_command(array('base_dir' => $this->base_dir, 'php_dir' => $this->php_dir, 'project_name' => $this->project_name, 'type' => "migration", 'table' => $this->tables[$i]));                                    
                }                
            }
            echo "<h1>Output</h1><pre>";
            print_r($output);
            echo "</pre>"; 

            array_push($this->output, "File Created: ".$filename);
            
            echo "<pre>";
            print_r($this->output);
            echo "</pre>";            
            //Loops through each table column and insert it into migration
            $this->edit_migration(array('table' => $this->tables[$i], 'filename' => $filename));
        }
    }

    /**
     * Loops through each table column and insert it into migration
     *
     * @return Response
     */
    public function edit_migration($request)
    {
        $data = $this->get_db_data($this->db_name);

        //print_r($data);

        for ($i=0; $i < count($data); $i++) {
            if($data[$i]["name"] == $request['table']){
                //array_push($this->output, "Adding columns for ".$data[$i]["name"];

                $new_content = array();
                for ($j=0; $j < count($data[$i]["columns"]); $j++) {
                    //print_r($data[$i]["columns"][$j]);
                    $new_content[$j] = $this->get_column_migration($data[$i]["columns"][$j]);
                }

                $write_request = array(
                    'file_url' => $this->base_dir.$this->project_name."\database\migrations\\".$request['filename'],
                    'remove_lines' => [],
                    'new_content' => $new_content,
                    'line_number' => 15,
                    'write_options' => 'index'
                );                

                echo "<pre>";
                print_r($write_request);
                echo "</pre>";
                $this->editor->write($write_request);
                
                return;
            }
        }
    }             

    /**
     * Check if migration exists from given table name
     *
     * @return Response
     */
    public function get_column_migration($column)
    {   
        $nullable = "";
        $default = "";
        $result = "";

        if($column->{"Null"} == "YES"){
            $nullable = "->nullable()";
        }
        if(!($column->{"Default"} == null)){
            $default = "->default(".$column->{"Default"}.")";
        }        

        if(strpos($column->{"Type"}, "int") !== false AND $column->{"Key"} == "PRI" ){ //Primary Keys
            $result = "\$table->increments('".$column->{"Field"}."')".$nullable.$default.";";

        }else if(strpos($column->{"Type"}, "int") !== false AND $column->{"Key"} == "MUL"){ //Int Index
            $result = "\$table->integer('".$column->{"Field"}."')".$nullable.$default."->index();";

        }else if(strpos($column->{"Type"}, "int") !== false AND $column->{"Key"} == ""){ //Normal Interger
            $result = "\$table->integer('".$column->{"Field"}."')".$nullable.$default.";";

        }else if(strpos($column->{"Type"}, "date") !== false){ //DATE equivalent for the database.
            $result = "\$table->date('".$column->{"Field"}."')".$nullable.$default.";";

        }else if(strpos($column->{"Type"}, "varchar") !== false){ //varchar with size
            $varcharlen = rtrim(substr($column->{"Type"}, 8), ")");
            $result = "\$table->string('".$column->{"Field"}."', ".$varcharlen.")".$nullable.$default.";";
        }

        return "            ".$result."\n";
    }    
}

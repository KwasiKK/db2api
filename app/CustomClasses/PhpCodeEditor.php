<?php

class PhpCodeEditor
{
    /**
     * Current Position in DOMNodeList
     * @var Integer
     */
    protected $output;
    protected $editor;
    public $base_dir = "C:\laragon\www\\";
    public $php_dir = "C:\laragon\bin\php\php-5.6.13\php";

    /**
     * @param DOMNode $domNode
     * @return void
     */
    public function __construct()
    {
        $this->editor = new \KreeFilesystem();
        $this->output = array();
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_auth($request){
        //modify route files
        $this->create_auth_views(array(
            "project_name" => $request["project_name"]
        ));    

        $this->add_auth_routes(array(
            "project_name" => $request["project_name"]
        ));        

        //modify Auth controllers & User model
        $this->modify_auth_controller($request);

        $this->modify_user_model($request);                
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function modify_user_model($request){
        $file_url = $this->base_dir.$request["project_name"]."\\app\\User.php";

        $file = file($file_url);

        include '../app/KreeViews/auth/Model.php';

        $write_request = array(
            'file_url' => $file_url,
            'new_content' => $new_content,
            'remove_lines' => "all",
            'line_number' => 0,
            'write_options' => 'replace'
        );

        $this->editor->write($write_request);
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function modify_auth_controller($request){
        $file_url = $this->base_dir.$request["project_name"]."\\app\\Http\\Controllers\\Auth\\RegisterController.php";

        $file = file($file_url);

        include '../app/KreeViews/auth/Controller@create.php';

        $update_request = array(
            'file_url' => $file_url,
            'function_name' => "create",
            'new_content' => $new_content,
            'update_type' => "replace"
        );                

        $this->editor->update_function($update_request);
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function add_auth_routes($request){
        include '../app/KreeViews/auth/routes.php';
        $this->add_routes(array(
            "routes" => $auth_routes,
            "project_name" => $request["project_name"]
        ));
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function create_auth_views($request){

        $file_dir = $this->base_dir.$request["project_name"]."\\resources\\views\\auth\\";

        //Make auth directory
        $this->editor->makeDirectory($file_dir);        
        
        /**
         *  creating register view , which may include register form
        */               
        $filename = "register.blade.php";
        array_push($this->output, $this->editor->createReplaceFile(array("file" => $file_dir.$filename)));

        //print_r(scandir("../app"));
        /**
         *  write to register and add html and form builder
        */ 
        include '../app/KreeViews/auth/register.kree.php';  

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
        include '../app/KreeViews/auth/login.kree.php';  

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
        include '../app/KreeViews/auth/password.kree.php';  

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
        include '../app/KreeViews/auth/reset.kree.php';  

        $write_request = array(
            'file_url' => $file_dir.$filename,
            'new_content' => $new_content,
            'remove_lines' => [],
            'line_number' => 0,
            'write_options' => 'replace'
        );                
        $this->editor->write($write_request); 
    }

    /**
     * CREATE the project dir and CRUD/KREE files.
     * Uses commandline: create new laravel project.
     *
     * @return Response
     */
    public function add_routes($request){
        $file_url = $this->base_dir.$request["project_name"]."\\routes\\web.php";

        $file = file($file_url);
        // echo "<pre>";
        // print_r($file);
        // echo "</pre>";

        $write_request = array(
            'file_url' => $file_url,
            'new_content' => $request["routes"],
            'remove_lines' => [],
            'write_options' => 'append'
        );
        $this->editor->write($write_request); 
    }
}
<?php

/*
 * This file is part of laravel project and is modified by
 * Kwasi Kgwete
 *
 * (a) Kwasi Kgwete <kwasi@marabele.com>
 *
 */

//namespace ;
//namespace Illuminate\Filesystem;

use psy\psysh\src\Exception\ErrorException;
//use FilesystemIterator;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class KreeFilesystem
{
    use Macroable;

    /**
     * Determine if a file exists.
     *
     * @param  string  $path
     * @return bool
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * Get the contents of a file.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get($path)
    {
        if ($this->isFile($path)) {
            return file_get_contents($path);
        }

        throw new FileNotFoundException("File does not exist at path {$path}");
    }

    /**
     * Get the contents of a file.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createFile($path)
    {
        if (!is_file($path)) {
            $myfile = fopen($path, "w") or die("Unable to create file!");
            fclose($myfile);
            return true;
        }

        return false;
    }

    /**
     * Get the returned value of a file.
     *
     * @param  string  $path
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getRequire($path)
    {
        if ($this->isFile($path)) {
            return require $path;
        }

        throw new FileNotFoundException("File does not exist at path {$path}");
    }

    /**
     * Require the given file once.
     *
     * @param  string  $file
     * @return mixed
     */
    public function requireOnce($file)
    {
        require_once $file;
    }

    /**
     * Write the contents of a file.
     *
     * @param  string  $path
     * @param  string  $contents
     * @param  bool  $lock
     * @return int
     */
    public function put($path, $contents, $lock = false)
    {

        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    /**
     * Prepend to a file.
     *
     * @param  string  $path
     * @param  string  $data
     * @return int
     */
    public function prepend($path, $data)
    {
        if ($this->exists($path)) {
            return $this->put($path, $data.$this->get($path));
        }

        return $this->put($path, $data);
    }

    /**
     * Append to a file.
     *
     * @param  string  $path
     * @param  string  $data
     * @return int
     */
    public function append($path, $data)
    {
        return file_put_contents($path, $data, FILE_APPEND);
    }

    /**
     * Delete the file at a given path.
     *
     * @param  string|array  $paths
     * @return bool
     */
    public function delete($paths)
    {
        $paths = is_array($paths) ? $paths : func_get_args();

        $success = true;

        foreach ($paths as $path) {
            try {
                if (!@unlink($path)) {
                    $success = false;
                }
            } catch (ErrorException $e) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Move a file to a new location.
     *
     * @param  string  $path
     * @param  string  $target
     * @return bool
     */
    public function move($path, $target)
    {
        return rename($path, $target);
    }

    /**
     * Copy a file to a new location.
     *
     * @param  string  $path
     * @param  string  $target
     * @return bool
     */
    public function copy($path, $target)
    {
        //Create directories if they do not exist
        $dirs = explode("\\", $target);

        $current_dir = $dirs[0];
        for ($i=1; $i < count($dirs) - 1; $i++) { 
            $current_dir .= "\\".$dirs[$i];
            if(!$this->isDirectory($current_dir)){
                //echo $current_dir." does not exsists. It must be created <br/>";
                $this->makeDirectory($current_dir);
            }
        }

        return copy($path, $target);
    }

    /**
     * Extract the file name from a file path.
     *
     * @param  string  $path
     * @return string
     */
    public function name($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * Extract the file extension from a file path.
     *
     * @param  string  $path
     * @return string
     */
    public function extension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * Get the file type of a given file.
     *
     * @param  string  $path
     * @return string
     */
    public function type($path)
    {
        return filetype($path);
    }

    /**
     * Get the mime-type of a given file.
     *
     * @param  string  $path
     * @return string|false
     */
    public function mimeType($path)
    {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
    }

    /**
     * Get the file size of a given file.
     *
     * @param  string  $path
     * @return int
     */
    public function size($path)
    {
        return filesize($path);
    }

    /**
     * Get the file's last modification time.
     *
     * @param  string  $path
     * @return int
     */
    public function lastModified($path)
    {
        return filemtime($path);
    }

    /**
     * Determine if the given path is a directory.
     *
     * @param  string  $directory
     * @return bool
     */
    public function isDirectory($directory)
    {
        return is_dir($directory);
    }

    /**
     * Determine if the given path is writable.
     *
     * @param  string  $path
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }

    /**
     * Determine if the given path is a file.
     *
     * @param  string  $file
     * @return bool
     */
    public function isFile($file)
    {
        return is_file($file);
    }

    /**
     * Find path names matching a given pattern.
     *
     * @param  string  $pattern
     * @param  int     $flags
     * @return array
     */
    public function glob($pattern, $flags = 0)
    {
        return glob($pattern, $flags);
    }

    /**
     * Get an array of all files in a directory.
     *
     * @param  string  $directory
     * @return array
     */
    public function files($directory)
    {
        $glob = glob($directory.'/*');

        if ($glob === false) {
            return [];
        }

        // To get the appropriate files, we'll simply glob the directory and filter
        // out any "files" that are not truly files so we do not end up with any
        // directories in our list, but only true files within the directory.
        return array_filter($glob, function ($file) {
            return filetype($file) == 'file';
        });
    }

    /**
     * Get all of the files from the given directory (recursive).
     *
     * @param  string  $directory
     * @return array
     */
    public function allFiles($directory)
    {
        return iterator_to_array(Finder::create()->files()->in($directory), false);
    }

    /**
     * Get all of the directories within a given directory.
     *
     * @param  string  $directory
     * @return array
     */
    public function directories($directory)
    {
        $directories = [];

        foreach (Finder::create()->in($directory)->directories()->depth(0) as $dir) {
            $directories[] = $dir->getPathname();
        }

        return $directories;
    }

    /**
     * Create a directory.
     *
     * @param  string  $path
     * @param  int     $mode
     * @param  bool    $recursive
     * @param  bool    $force
     * @return bool
     */
    public function makeDirectory($path, $mode = 0755, $recursive = false, $force = false)
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }

        return mkdir($path, $mode, $recursive);
    }

    /**
     * Copy a directory from one location to another.
     *
     * @param  string  $directory
     * @param  string  $destination
     * @param  int     $options
     * @return bool
     */
    public function copyDirectory($directory, $destination, $options = null)
    {
        if (!$this->isDirectory($directory)) {
            return false;
        }

        $options = $options ?: FilesystemIterator::SKIP_DOTS;

        // If the destination directory does not actually exist, we will go ahead and
        // create it recursively, which just gets the destination prepared to copy
        // the files over. Once we make the directory we'll proceed the copying.
        if (!$this->isDirectory($destination)) {
            $this->makeDirectory($destination, 0777, true);
        }

        $items = new FilesystemIterator($directory, $options);

        foreach ($items as $item) {
            // As we spin through items, we will check to see if the current file is actually
            // a directory or a file. When it is actually a directory we will need to call
            // back into this function recursively to keep copying these nested folders.
            $target = $destination.'/'.$item->getBasename();

            if ($item->isDir()) {
                $path = $item->getPathname();

                if (!$this->copyDirectory($path, $target, $options)) {
                    return false;
                }
            }

            // If the current items is just a regular file, we will just copy this to the new
            // location and keep looping. If for some reason the copy fails we'll bail out
            // and return false, so the developer is aware that the copy process failed.
            else {
                if (!$this->copy($item->getPathname(), $target)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Recursively delete a directory.
     *
     * The directory itself may be optionally preserved.
     *
     * @param  string  $directory
     * @param  bool    $preserve
     * @return bool
     */
    public function deleteDirectory($directory, $preserve = false)
    {
        if (!$this->isDirectory($directory)) {
            return false;
        }

        $items = new FilesystemIterator($directory);

        foreach ($items as $item) {
            // If the item is a directory, we can just recurse into the function and
            // delete that sub-directory otherwise we'll just delete the file and
            // keep iterating through each file until the directory is cleaned.
            if ($item->isDir() && !$item->isLink()) {
                $this->deleteDirectory($item->getPathname());
            }

            // If the item is just a file, we can go ahead and delete it since we're
            // just looping through and waxing all of the files in this directory
            // and calling directories recursively, so we delete the real path.
            else {
                $this->delete($item->getPathname());
            }
        }

        if (!$preserve) {
            @rmdir($directory);
        }

        return true;
    }

    /**
     * Empty the specified directory of all files and folders.
     *
     * @param  string  $directory
     * @return bool
     */
    public function cleanDirectory($directory)
    {
        return $this->deleteDirectory($directory, true);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * create or replaces file with emty new one
     * @param  array  $request = [file_url, new_content, remove_lines, line_number]
     * @return Response
     */
    public function createReplaceFile($request)
    {

        $result = $this->exists($request["file"]);
        
        if(!$result){ //if dir does not exist, create it
            $this->createFile($request["file"], "");
        }else{
            if (!unlink($request["file"]))
            {
                return "\n Error deleting: ".$request["file"];
            }
            else
            {
                $this->createFile($request["file"], "");
            }         
        }

        return "\nFile Created: ".$request["file"]." \n";        
    }
    /**
     * Show the form for creating a new resource.
     * @param  array  $request = [file_url, new_content, remove_lines, line_number]
     * @return Response
     */
    public function write($request)
    {
        $file = file($request["file_url"]);

        //array_unshift($request["new_content"], "        /*|*|*|*|*|*|*     KREE GENERATED CODE START      *|*|*|*|*|*|*/ \n");
        //array_push($request["new_content"], "        /*|*|*|*|*|*|*     KREE GENERATED CODE ENDS      *|*|*|*|*|*|*/ \n");     
        
        //echo "<br>Lines to remove: <pre>";
        //print_r($request["remove_lines"]);
        //echo "</pre>";

        //echo "<pre>";
        //print_r($file);
        //echo "</pre>";        
        /**/
        if(isset($request["remove_lines"])){
            if(isset($request["remove_lines"]["range"])){
                for ($i=$request["remove_lines"]["range"][0]; $i < $request["remove_lines"]["range"][1]; $i++) { 
                    unset($file[$request["remove_lines"]["range"][0]]);   
                    $file = array_values($file);
                }
            }elseif($request["remove_lines"] == "all"){
                $file = array();
            }else{
                for ($i=0; $i < count($request["remove_lines"]); $i++) { 
                    unset($file[$request["remove_lines"][$i]]);   
                    $file = array_values($file);
                }
            }
        }   

        if($request["write_options"] == "replace"){
            $this->array_insert($file, 0, $request["new_content"]);
        }elseif($request["write_options"] == "append"){
            $this->array_insert($file, count($file), $request["new_content"]);
        }
        elseif($request["write_options"] == "index"){
            $this->array_insert($file, $request["line_number"], $request["new_content"]);
        }

        // echo "<h1 style='background: skyblue; ' >Edited File: </h1><pre>";
        // print_r($file);
        // echo "</pre>";        

        $file = implode("", $file);
        file_put_contents($request["file_url"], $file);                                
    }

    /**
     * Creates a function in string to be writtent to file
     *
     * @param  array  $request = [content, spacing, comments, function_type]
     * @return Response
     */
    public function create_function($request)
    {
        $result = array();

        if (isset($request["comments"])) {
            array_push($result, $request["spacing"]."/** \n ".$request["spacing"]." ".$request["comments"]." ".$request["spacing"]."* @return Response \n ".$request["spacing"]."*/ ");
        }

        if (isset($request["function_type"])) {
            $function_type = $request["function_type"];
        }else{
            $function_type = "public";
        }

        array_push($result, $request["spacing"].$function_type." function ".$request["name"]."(){ \n");
        array_push($result, implode("", $request["content"]));
        array_push($result, $request["spacing"]."} \n");

        return $result;
    }    

    /**
     * Updates a function in any given file if specified function exsists
     * @param  array  $request = [file_url, function_name, new_content, update_type]
     *
     * @return Response
     */
    public function update_function($request)
    {
        $file = file($request["file_url"]);

        $function_details = $this->get_block_details(array('file' => $file, 'function_name' => $request["function_name"], 'type' => "function"));
        $function_content = $function_details['function_content'];

        if($request['update_type'] == "append"){
            $this->array_insert($function_content, 0, $request["new_content"]);
        }else if($request['update_type'] == "prepend"){
            $this->array_insert($function_content, count($function_content), $request["new_content"]);
        }else if($request['update_type'] == "replace"){
            $function_content = $request["new_content"];
        }else if($request['update_type'] == "index"){
            $this->array_insert($function_content, $request["line_number"], $request["new_content"]);
        }else{
            echo "Please specify the update_type for function. You are Awsome! \n ";
        }

        //write to file modified function_content
        $request2 = array(
            'file_url' => $request["file_url"], 
            'write_options' => 'index', 
            'new_content' => $request["new_content"],
            'remove_lines' => array('range' => [$function_details["start_index"], $function_details["end_index"]]),
            'line_number' => $function_details["start_index"],
        ); //[file_url, new_content, remove_lines, line_number]

        $this->write($request2);
    }

    /**
     * Updates a function in any given file if specified function exsists
     * @param  array  $request = [file_url, function_name, new_content, update_type]
     *
     * @return Response
     */
    public function update_array($request)
    {
        $file = file($request["file_url"]);

        $function_details = $this->get_block_details(array('file' => $file, 'function_name' => $request["function_name"]));
        $function_content = $function_details['function_content'];

        if($request['update_type'] == "append"){
            $this->array_insert($function_content, 0, $request["new_content"]);
        }else if($request['update_type'] == "prepend"){
            $this->array_insert($function_content, count($function_content), $request["new_content"]);
        }else if($request['update_type'] == "replace"){
            $function_content = $request["new_content"];
        }else if($request['update_type'] == "index"){
            $this->array_insert($function_content, $request["line_number"], $request["new_content"]);
        }else{
            echo "Please specify the update_type for function. You are Awsome! \n ";
        }

        //write to file modified function_content
        $request2 = array(
            'file_url' => $request["file_url"], 
            'new_content' => $request["new_content"],
            'remove_lines' => array('range' => [$function_details["start_index"], $function_details["end_index"]]),
            'line_number' => $function_details["start_index"],
        ); //[file_url, new_content, remove_lines, line_number]

        $this->write($request2);
    }    

    /**
     * Updates a function in any given file if specified function exsists
     *
     * @return Response
     */
    public function get_block_details($request)
    {
        $file = $request["file"];
        $function_content = array();
        $start_index = 0;
        $end_index = 0;

        //Get the index where the function starts
        for ($i=0; $i < count($file); $i++) { 
            if(strpos($file[$i], "function ".$request["function_name"]) !== false){
                $start_index = $i+2;
                break;
            }                      
        }

        $open_brace = 0;
        $close_brace = 0; 
        if($request["type"] == "function"){
            $open_char = "{";
            $close_char = "}";
        }elseif ($request["type"] == "array") {
            $open_char = "[";
            $close_char = "]";
        }

        //Get the index where the function ends
        for ($i=$start_index; $i < count($file); $i++) { 
            if(strpos($file[$i], $open_char) !== false){
                $open_brace++;
            }                 
            if(strpos($file[$i], $close_char) !== false){
                $close_brace++;
            }

            if($close_brace > $open_brace){
                $end_index = $i;
                break;
            }
        }        

        //Create an array for the function content
        for ($i=$start_index; $i < $end_index; $i++) { 
            array_push($function_content, $file[$i]);
        }                

        $result = array(
            'function_content' => $function_content,
            'start_index' => $start_index,
            'end_index' => $end_index
        );

        return $result;
    }   

    /**
     * Access to the laravel artisan make commands
     *
     * @return Response
     */
    public function make_command($request)
    {
        if($request["type"] == "migration"){
            echo "<h2>WTF".'cd '.$request["base_dir"].''.$request["project_name"].' && '.$request["php_dir"].' '.$request["base_dir"].''.$request["project_name"].'\artisan make:migration create_'.$request["table"].'_table --create="'.$request["table"].'" 2>&1'."</h2>";
            exec('cd '.$request["base_dir"].''.$request["project_name"].' && '.$request["php_dir"].' '.$request["base_dir"].''.$request["project_name"].'\artisan make:migration create_'.$request["table"].'_table --create="'.$request["table"].'" 2>&1', $output, $retval);
            return $output; //substr($output[0], 19).".php";
        }else if($request["type"] == "model"){
            exec('cd '.$request["base_dir"].''.$request["project_name"].' && '.$request["php_dir"].' '.$request["base_dir"].''.$request["project_name"].'\artisan make:model '.$request["table"].' 2>&1', $output, $retval);
            //print_r($output);
            return $output;            
        }else if($request["type"] == "controller"){
            echo "<h2>controller::</h2>";
            exec('cd '.$request["base_dir"].''.$request["project_name"].' && '.$request["php_dir"].' '.$request["base_dir"].''.$request["project_name"].'\artisan make:controller '.$request["table"].'Controller --resource 2>&1', $output, $retval);
            print_r($output);
            return $output;            
        }else if($request["type"] == "composer_html"){
            exec('cd '.$request["base_dir"].''.$request["project_name"].' && composer update && composer require illuminate/html --verbose 2>&1', $output, $retval);
            //print_r($output);
            return $output;                        
        }
    }

    /**
     * Access to the laravel artisan make commands
     *
     * @return Response
     */
    public function create_project($request)
    {
        exec('cd '.$request["base_dir"].' && composer create-project laravel/laravel '.$request["project_name"].' "'.$request["project_version"].'" --verbose 2>&1', $output, $retval);
        //print_r($output);

        //php artisan key:generate
        return $output;            
    }                     

    /**
     * @param array      $array
     * @param int|string $position
     * @param mixed      $insert
     */
    public function array_insert(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }

    /**
     * @param array      $array
     * @param int|string $position
     * @param mixed      $insert
     */
    public function extract_links($request)
    {
        $file = file($request["file_url"]);
        $links = array();
        $styles = array();
        $scripts = array();
        $images = array();

        for ($i=0; $i < count($file); $i++) {
            if(strpos($file[$i], "<link ") !== false){
                array_push($styles, $this->get_link_from_line(array("line" => $file[$i], "type" => "style")));
            }elseif (strpos($file[$i], "<script ") !== false AND strpos($file[$i], "src") !== false) {
                array_push($scripts, $this->get_link_from_line(array("line" => $file[$i], "type" => "src")));
            }elseif (strpos($file[$i], "<img ") !== false AND strpos($file[$i], "src") !== false) {
                array_push($images, $this->get_link_from_line(array("line" => $file[$i], "type" => "src")));
            }
        }        
        $links["scripts"] = $scripts;
        $links["styles"] = $styles;
        $links["images"] = $images;

        return $links;
    }

    /**
     * Convert file to a php array
     *
     * @return Response
     */
    public function get_link_from_line($request)
    {
        if($request["type"] == "style"){
            $start = strpos($request["line"], "href=\"") + 6;
            $end = strpos($request["line"], "\"", $start);
        }elseif ($request["type"] == "src") {
            $start = strpos($request["line"], "src=\"") + 5;
            $end = strpos($request["line"], "\"", $start);            
        }

        $link = substr($request["line"], $start, $end - $start);

        if(strpos($link, "asset('") !== false){
            $start = strpos($link, "asset('") + 7;
            $end = strpos($link, "')", $start);
            $link = substr($link, $start, $end - $start);
        }

        return $link;
    }                     

    // /**
    //  * Convert php array to a file
    //  *
    //  * @return Response
    //  */
    // public function array_to_file($request)
    // {
    //     // exec('cd '.$request["base_dir"].' && composer create-project laravel/laravel '.$request["project_name"].' "'.$request["project_version"].'" --verbose 2>&1', $output, $retval);
    //     // print_r($output);

    //     // //php artisan key:generate
    //     // return $output;            
    // }                         
}

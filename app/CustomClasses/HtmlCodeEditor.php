<?php

use CodeBeautifier as CodeBeautifier;
use Yangqi\Htmldom\Htmldom;
use App\EditedFiles;

class HtmlCodeEditor
{
    /**
     * Current Position in DOMNodeList
     * @var Integer
     */
    protected $remove_array;
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
    }

    /**
     * Returns the current DOMNode
     * @return DOMNode
     */
    public function edit($request)
    {
        $file_details = $this->getFileDetails(array("input" => $request["input"], "type" => $request["type"]));

        // echo "File Details:
        // <pre>";
        // print_r($file_details);
        // echo "</pre>";

        if($file_details == "error"){
            return "Error occured";
        }

        $write_request = array(
            'file_url' => $file_details["file_url"],
            'new_content' => [$file_details["edited_html"]],
            'remove_lines' => "all",
            'line_number' => 0,
            'write_options' => 'replace'
        );                

        $this->editor->write($write_request);

        $code_beautifier = new CodeBeautifier();
        
        $code_beautifier->beautify(array(
            'file_url' => $file_details["file_url"]
        ));
    }

    /**
     * Returns the current DOMNode
     * @return DOMNode
     */
    public function getFileDetails($request)
    {
        //echo "<h2>--".$request["input"]["project"]."--</h2>";
        if (str_contains($request["input"]["project"], ".")) {
            $dotpos = strpos($request["input"]["project"], ".");
            $project_name = substr($request["input"]["project"], 0, $dotpos);
        }else{
            $project_name = $request["input"]["project"];
        }

        //echo "<h2>1==".$project_name."=2=</h2>";

        $project_dir = $this->base_dir.$project_name."\\resources\\views\\";
        $project_public_dir = $this->base_dir.$project_name."\\public\\";
        
        $file_url = $project_dir.$request["input"]["filename"];
        $main_file_url = $this->getMainFileUrl(array(
            "file_url" => $file_url, 
            "project_dir" => $project_dir
        ));
        
        if(!str_contains($file_url, ".blade.php")){
            $file_url .= ".blade.php";
        }

        $file = file($file_url);
        $main_file = file($main_file_url);

        $file_html_string = implode("\n", $file);
        $main_file_html_string = implode("\n", $main_file);

        $file_html_dom = new Htmldom();
        $main_file_html_dom = new Htmldom();

        $file_html = $file_html_dom->str_get_html($file_html_string);
        $main_file_html = $main_file_html_dom->str_get_html($main_file_html_string);

        $class_clause = "";
        $id_clause = "";
        $tag = strtolower($request["input"]["element"]["tag"]);
        if(isset($request["input"]["element"]["class"]) 
            AND $request["input"]["element"]["class"] !== null 
            AND $request["input"]["element"]["class"] !== ""){
            $class_clause = "[class=".rtrim($request["input"]["element"]["class"])."]";
        }
        if(isset($request["input"]["element"]["id"]) 
            AND $request["input"]["element"]["id"] !== null 
            AND $request["input"]["element"]["id"] !== ""){
            $id_clause = "[id=".$request["input"]["element"]["id"]."]";
        }

        $final_file_html = "none";
        $edit_html = "none";
        if(count($file_html->find($tag.$class_clause)) > 0){
            $final_file_url = $file_url;
            $final_file_html = $file_html;
             //= $file_html->find($tag.$class_clause)[0];
        }elseif (count($main_file_html->find($tag.$class_clause)) > 0 ) {
            $final_file_html = $main_file_html;
            $final_file_url = $main_file_url;
            //$edit_html = $main_file_html->find($tag.$class_clause)[0];
        }else{
            echo "<br><h2>Element not Found anywhere :>".$tag.$class_clause;
            return "error";
        }

        //Performing the needed edit
        if($final_file_html !== "none"){
            if($request["type"] == "insert_after"){
                $final_file_html->find($tag.$class_clause)[0]->outertext .= $request["input"]["new_content"];
            }else if($request["type"] == "insert_before"){
                $final_file_html->find($tag.$class_clause)[0]->outertext = $request["input"]["new_content"].$final_file_html->find($tag.$class_clause)[0]->outertext;
            }else if($request["type"] == "add_code"){
                $final_file_html->find($tag.$class_clause)[0]->innertext .= $request["input"]["new_content"];
            }else if($request["type"] == "remove_code"){
                $final_file_html->find($tag.$class_clause)[0]->outertext = "";
            }else if($request["type"] == "edit_media"){
                $final_file_html->find($tag.$class_clause)[0]->src = $request["input"]["new_content"];
                
                $edited_file = new EditedFiles;

                $edited_file->project = $request["input"]["project"];
                $edited_file->file_url = $request["input"]["new_content"];
                $edited_file->type = "media";
                $edited_file->save();
            }else if($request["type"] == "edit_text"){
                $final_file_html->find($tag.$class_clause)[0]->innertext = $request["input"]["new_content"];
            }
        }

        //Store the edited file in the edited_files_json
        //print_r(scandir("../app"));
        $edited_files = EditedFiles::where(array("project" => $request["input"]["project"], "file_url" => $final_file_url))->get();

        if(count($edited_files) == 0){

            $edited_file = new EditedFiles;

            $edited_file->project = $request["input"]["project"];
            $edited_file->file_url = $final_file_url;
            $edited_file->type = "file";
            $edited_file->save();
        }

        return array(
            'file_url' => $final_file_url, 
            'project_dir' => $project_dir,
            'edited_html' => $final_file_html,
        );
    }

    /**
     * Returns the current DOMNode
     * @return DOMNode
     */
    public function getMainFileUrl($request)
    {
        if(!str_contains($request["file_url"], ".blade.php")){
            $request["file_url"] .= ".blade.php";
        }

        //echo ">>><p>".$request["file_url"]."</p>";
        $file = file($request["file_url"]);

        $main_file_name = "none"; 
        foreach ($file as $key => $line) {
            if(str_contains($line, "@extends")){
                $line = str_replace('"', "'", $line);
                $main_file_name = $this->getStringBetween($line,"'","'");
                break;
            }
        }

        return $request["project_dir"].$main_file_name.".blade.php";
    }

    public function getStringBetween($str,$from,$to)
    {   
        $pos1 = $this->strposX($str, $from, 1) + 1;
        $pos2 = $this->strposX($str, $to, 2);
        return substr($str,$pos1,$pos2 - $pos1);
    }

    /**
     * Find the position of the Xth occurrence of a substring in a string
     * @param $haystack
     * @param $needle
     * @param $number integer > 0
     * @return int
     */
    public function strposX($haystack, $needle, $number){
        if($number == '1'){
            return strpos($haystack, $needle);
        }elseif($number > '1'){
            return strpos($haystack, $needle, $this->strposX($haystack, $needle, $number - 1) + strlen($needle));
        }else{
            return error_log('Error: Value for parameter $number is out of range');
        }
    }
}
<?php

use Yangqi\Htmldom\Htmldom;

class CodeBeautifier
{
    /**
     * Current Position in DOMNodeList
     * @var Integer
     */
    protected $remove_array;
    protected $editor;

    /**
     * @param DOMNode $domNode
     * @return void
     */
    public function __construct()
    {
        $this->remove_array = array("<html", "</html>", "<head", "</head", "<body", "</body>", "<title", "</title");
        $this->editor = new \KreeFilesystem();
    }

    /**
     * Returns the current DOMNode
     * @return DOMNode
     */
    public function beautify($request)
    {
        //$previous_value = libxml_use_internal_errors(TRUE);

        $file_dom = new \Htmldom();

        $content = File::get($request["file_url"]);
        $file_dom->str_get_html($content);

        foreach ($file_dom->find("p") as $key3 => $p) {
            if(strpos($p->innertext, "@extends") !== false OR 
            strpos($p->innertext, "@section") !== false OR 
            strpos($p->innertext, "@endsection") !== false){ 
                $p->outertext = $p->innertext;
            }
        }

        foreach ($file_dom->find("form") as $key3 => $p) {
            if(strpos($p->innertext, "@extends") !== false OR 
            strpos($p->innertext, "@section") !== false OR 
            strpos($p->innertext, "@endsection") !== false){ 
                $p->outertext = $p->innertext;
            }
        }

        $file_dom = str_replace("@endsection</p>", "@endsection", $file_dom);
        $file_dom = str_replace("@endsection</form>", "@endsection", $file_dom);

        $file_dom = str_replace("%7B", "{", $file_dom);

        $file_dom = str_replace("%7D", "}", $file_dom);

        $file_dom = str_replace("%20", " ", $file_dom);

        $config = array(
                    'indent'         => true,
                    'doctype'        => 'omit',
                    'output-xhtml'   => false,
                    'fix-uri'        => false,
                    'show-errors'    => false,
                    'show-warnings'  => false,
                    'wrap'           => 200,
                    'tidy-mark' => false,
                    'indent-spaces' => 4,
                    'preserve-entities' => true,
                    'new-blocklevel-tags' => 'article,header,footer,section,nav',
                    'new-inline-tags' => 'video,audio,canvas,ruby,rt,rp',                   
                );

        // Tidy
        $tidy_html = new \Tidy;
        $tidy_html->parseString($file_dom, $config, 'utf8');
        $tidy_html->cleanRepair();
        echo $tidy_html->errorBuffer;

        $write_request = array(
            'file_url' => $request["file_url"],
            'new_content' => $tidy_html,
            'remove_lines' => "all",
            'line_number' => 0,
            'write_options' => 'replace'
        );                

        $this->editor->write($write_request);            

        if(!(strpos($request["file_url"], "main.blade.php") !== false)){
            
            $tidy_html = file($request["file_url"]);
            for ($i=0; $i < count($tidy_html); $i++) { 
                //echo "<br>i = ".$i;
                for ($j=0; $j < count($this->remove_array); $j++) { 
                    //echo "<br>j = ".$j;
                    if(isset($tidy_html[$i])){
                        if(strpos($tidy_html[$i], $this->remove_array[$j]) !== false){
                            //echo "<br>j found = ".$j;
                            unset($tidy_html[$i]);
                            continue;
                        }                                 
                    }
                }
            }
            array_pop($tidy_html);
            array_pop($tidy_html);
        } 

        $write_request = array(
            'file_url' => $request["file_url"],
            'new_content' => $tidy_html,
            'remove_lines' => "all",
            'line_number' => 0,
            'write_options' => 'replace'
        );                

        $this->editor->write($write_request); 

        // libxml_clear_errors();
        // libxml_use_internal_errors($previous_value);          
    }
}
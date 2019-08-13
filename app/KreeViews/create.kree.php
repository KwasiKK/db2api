<?php
    $new_content = [
        "@extends(\"app\")\n",
        "@section(\"content\")\n",    
        "<div class=\"container\">\n\n"
    ];

    include 'crudmenu.kree.php';
    
    $new_content = array_merge($new_content, 
    [
        "<h1>Create a ".$tableInView."</h1>\n\n",

        "{!! Form::open(array('url' => '".$table."')) !!}\n\n",

        "@include('".$table.".form', ['submitButtonText' => 'Create'])\n\n",

        "{!! Form::close() !!}\n\n",

        "@include('errors.list')\n\n",        

        "</div>\n",
        "@stop\n"          
    ]);
?> 
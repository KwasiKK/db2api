<?php
    $new_content = [
        "@extends(\"app\")\n",
        "@section(\"content\")\n",    
        "<div class=\"container\">\n\n"
    ];

    include 'crudmenu.kree.php';
    
    $new_content = array_merge($new_content, 
    [
        "<h1>Edit ".$tableInView."</h1>\n\n",

        "{!! Form::model(\$".$table.", array('method' => 'PATCH', 'action' => ['".$table."Controller@update', \$".$table."->id])) !!}\n\n",

        "@include('".$table.".form', ['submitButtonText' => 'Update'])\n\n",

        "{!! Form::close() !!}\n\n",

        "@include('errors.list')\n\n",        

        "</div>\n",
        "@stop\n"          
    ]);
?> 
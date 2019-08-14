<?php
    $new_content = [
        "\t\t// get all the ".$table."s \n",
        "\t\t$".$table." = ".$table."::all();\n\n",
        "\t\t// load the view and pass the ".$table."s \n",
        "\t\treturn View::make('".$table.".index')->with('".$table."', $".$table.");\n"
    ];
?>
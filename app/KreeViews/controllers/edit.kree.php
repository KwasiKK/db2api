<?php
    $new_content = [
        "\t\t// get one ".$table." \n",
        "\t\t\$".$table." = ".$table."::find(\$id);\n\n",
        "\t\t// show the view and pass the ".$table." to it \n",
        "\t\treturn View::make('".$table.".edit')->with('".$table."', \$".$table.");\n"
    ];
?> 
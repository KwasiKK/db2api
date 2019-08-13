<?php
    $new_content = [
        "\t\t// delete one ".$table." \n",
        "\t\t\$".$table." = ".$table."::find(\$id);\n\n",
        "\t\t\$".$table."->delete();\n\n",
        "\t\t// redirect\n",
        "\t\tSession::flash('message', 'Successfully deleted the ".$table."!');\n",
        "\t\treturn Redirect::to('".$table."');\n"
    ];
?>
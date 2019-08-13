<?php
    $new_content = array_merge($new_content, 
    [
        "<div class=\"crud-menu\">\n",
        "\t\t<a href=\"{{ URL::to('".$table."') }}\" class=\"btn btn-small btn-success\">View All ".$tableInView."</a>\n",
        "\t\t<a href=\"{{ URL::to('".$table."/create') }}\" class=\"btn btn-small btn-success\">Create a ".$tableInView."</a>\n",
        "</div>\n\n"
    ]);
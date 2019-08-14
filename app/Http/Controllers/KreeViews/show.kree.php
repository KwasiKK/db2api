    <?php
    $new_content = [
        "@extends(\"app\")\n",
        "@section(\"content\")\n",
        "<div class=\"container\">\n\n"
    ];

    include 'crudmenu.kree.php';
    
    $new_content = array_merge($new_content, 
    [
        "<h1>Showing ".$tableInView."s</h1>\n\n",

        "<!-- will be used to show any messages -->\n",
        "@if (Session::has('message'))\n",
        "\t<div class=\"alert alert-info\">{{ Session::get('message') }}</div>\n",
        "@endif\n\n",

        "<table class=\"table table-striped table-bordered\">\n",
        "\t<thead>\n",
        "\t\t<tr>\n"
    ]);

    $table_header_code = array();
    $table_body_code = array();
    //Loop through table columns that will show up in the table header and body
    for ($j=0; $j < count($data[$i]["columns"]); $j++) {
        //print_r($data[$i]["columns"][$j]);
        if($data[$i]["columns"][$j]["name"] !== "updated_at" AND $data[$i]["columns"][$j]["name"] !== "created_at" AND strpos($data[$i]["columns"][$j]["type"], "int") == false AND $data[$i]["columns"][$j]["key"] !== "PRI" ){ //Not Primary Keys
            //Add table column to view for table header              
            array_push($table_header_code, "\t\t\t<td>".$data[$i]["columns"][$j]["name"]."</td>\n");
            //Add table column to view for table body  
            array_push($table_body_code, "\t\t\t<td>{{ \$".$table."->".$data[$i]["columns"][$j]["name"]." }}</td>\n");
        }
    }
    $new_content = array_merge($new_content, $table_header_code);

    $new_content = array_merge($new_content, [
        "\t\t\t<td></td>\n",
        "\t\t</tr>\n",
        "\t</thead>\n",
        "\t<tbody>\n",
        "\t\t<tr>\n"
    ]);

    $new_content = array_merge($new_content, $table_body_code);

    $new_content = array_merge($new_content, ["\t\t\t<!-- we will also add show, edit, and delete buttons -->\n",
        "\t\t\t<td>\n",

        "\t\t\t\t<!-- delete the ".$table." (uses the destroy method DESTROY /".$table."/{id} -->\n",
        "\t\t\t\t<!-- we will add this later since its a little more complicated than the first two buttons -->\n",
        "\t\t\t\t{!! Form::open(array('url' => '".$table."/' . \$".$table."->id, 'class' => 'table-btn')) !!}\n",
        "\t\t\t\t\t{!! Form::hidden('_method', 'DELETE') !!}\n",
        "\t\t\t\t\t{!! Form::submit('Delete', array('class' => 'btn btn-warning btn-xs')) !!}\n",
        "\t\t\t\t{!! Form::close() !!}\n\n",

        "\t\t\t\t<!-- edit this ".$table." (uses the edit method found at GET /".$table."/{id}/edit -->\n",
        "\t\t\t\t<a class=\"btn btn-xs btn-info table-btn\" href=\"{{ URL::to('".$table."/' . \$".$table."->".$table."_id . '/edit') }}\">Edit</a>\n\n",

        "\t\t\t</td>\n",
        "\t\t</tr>\n",
        "\t</tbody>\n",
        "</table>\n\n",

        "</div>\n",
        "@stop\n"
    ]);
?>
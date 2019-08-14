    <?php
    $new_content = [
        "@extends(\"app\")\n",
        "@section(\"content\")\n",
        "<div class=\"container\">\n\n"
    ];

    include 'crudmenu.kree.php';
    
    $new_content = array_merge($new_content, 
    [
        "<h1>All the ".$tableInView."s</h1>\n\n",

        "<!-- will be used to show any messages -->\n",
        "@if (Session::has('message'))\n",
        "\t<div class=\"alert alert-info\">{{ Session::get('message') }}</div>\n",
        "@endif\n\n",

        "<table class=\"table table-striped table-bordered data-table\">\n",
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
            array_push($table_body_code, "\t\t\t<td><?php echo \$value->".$data[$i]["columns"][$j]["name"]."; ?></td>\n");
        }
    }
    $new_content = array_merge($new_content, $table_header_code);

    $new_content = array_merge($new_content, [
        "\t\t\t<td></td>\n",
        "\t\t</tr>\n",
        "\t</thead>\n",
        "\t<tbody>\n",
        "\t<?php foreach(\$".$table." as \$key => \$value){ ?>\n",
        "\t\t<tr>\n"
    ]);

    $new_content = array_merge($new_content, $table_body_code);

    $new_content = array_merge($new_content, ["\t\t\t<!-- we will also add show, edit, and delete buttons -->\n",
        "\t\t\t<td>\n",

        "\t\t\t\t<!-- delete the ".$table." (uses the destroy method DESTROY /".$table."/{id} -->\n",
        "\t\t\t\t<!-- we will add this later since its a little more complicated than the first two buttons -->\n",
        "\t\t\t\t{!! Form::open(array('url' => '".$table."/' . \$value->id, 'class' => 'table-btn')) !!}\n",
        "\t\t\t\t\t{!! Form::hidden('_method', 'DELETE') !!}\n",
        "\t\t\t\t\t{!! Form::submit('Delete', array('class' => 'btn btn-xs btn-warning')) !!}\n",
        "\t\t\t\t{!! Form::close() !!}\n\n",

        "\t\t\t\t<!-- show the ".$table." (uses the show method found at GET /".$table."/{id} -->\n",
        "\t\t\t\t<a class=\"btn btn-xs btn-success table-btn\" href=\"{{ URL::to('".$table."/' . \$value->id) }}\" >Show</a>\n\n",

        "\t\t\t\t<!-- edit this ".$table." (uses the edit method found at GET /".$table."/{id}/edit -->\n",
        "\t\t\t\t<a class=\"btn btn-xs btn-info table-btn\" href=\"{{ URL::to('".$table."/' . \$value->id . '/edit') }}\">Edit</a>\n\n",

        "\t\t\t</td>\n",
        "\t\t</tr>\n",
        "\t<?php } ?>\n",
        "\t</tbody>\n",
        "</table>\n\n",
        "</div>\n",
        "@stop\n",

        "@section(\"scripts\")\n",        
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css\"/>\n",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/1.0.1/css/buttons.bootstrap.min.css\"/>\n",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/colreorder/1.2.0/css/colReorder.bootstrap.min.css\"/>\n",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/responsive/1.0.7/css/responsive.bootstrap.min.css\"/>\n",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/scroller/1.3.0/css/scroller.bootstrap.min.css\"/>\n",
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/select/1.0.0/css/select.bootstrap.min.css\"/>\n\n",
         
        "<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-2.1.4.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/dataTables.buttons.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/buttons.bootstrap.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/buttons.colVis.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/buttons.flash.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/buttons.html5.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/1.0.1/js/buttons.print.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/colreorder/1.2.0/js/dataTables.colReorder.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/scroller/1.3.0/js/dataTables.scroller.min.js\"></script>\n",
        "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/select/1.0.0/js/dataTables.select.min.js\"></script>\n\n",        
        "<script>\n",
        "$(document).ready(function() {\n",
        "\t$('.data-table').DataTable({\n",
        "\t\tlengthMenu: [[10, 25, 50, -1], [10, 25, 50, \"All\"]],\n",
        "\t\tdom: 'Bfrtip',\n",
        "\t\tbuttons: [\n",
        "\t\t\t'colvis',\n",
        "\t\t\t'excel'\n",
        "\t\t]\n",
        "\t});\n",
        "});\n",        
        "</script>\n\n",
        "@stop\n"
    ]);
?>
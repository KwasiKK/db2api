    <?php
        $new_content = [];
        //Loop through table columns that should appear on the form
        for ($j=0; $j < count($data[$i]["columns"]); $j++) {
            if($data[$i]["columns"][$j]->{"Field"} !== "updated_at" AND $data[$i]["columns"][$j]->{"Field"} !== "created_at" AND strpos($data[$i]["columns"][$j]->{"Type"}, "int") == false AND $data[$i]["columns"][$j]->{"Key"} !== "PRI" AND strpos($data[$i]["columns"][$j]->{"Type"}, "timestamp") == false){ //Not Primary Keys Or Timestamp // AND NOT (updated_at  OR created_at)
                //echo "\n INSIDE IF\n"
                //OR 
                //Add table column to view for form input
                $input = ["\t<div class=\"form-group\">\n",
                        "\t\t{!! Form::label('name', '".$data[$i]["columns"][$j]->{"Field"}."') !!}\n",
                        "\t\t{!! Form::text('".$data[$i]["columns"][$j]->{"Field"}."', Input::old('".$data[$i]["columns"][$j]->{"Field"}."'), array('class' => 'form-control')) !!}\n",
                        "\t</div>\n\n"];
                $new_content = array_merge($new_content, $input);
            }
        } 

        array_push($new_content, "\t{!! Form::submit(\$submitButtonText, array('class' => 'btn btn-primary')) !!}\n\n");
?>
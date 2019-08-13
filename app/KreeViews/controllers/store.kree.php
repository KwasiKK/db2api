<?php
    $new_content = [
        "\t\t// validate input \n",
        "\t\t\$rules = array(\n"
    ];

    $store_fields = array();
    //Loop through table columns that will show up on the form and add them to $rules array
    for ($j=0; $j < count($data[$i]["columns"]); $j++) {
        //print_r($data[$i]["columns"][$j]);
        if($data[$i]["columns"][$j]->{"Field"} !== "updated_at" AND $data[$i]["columns"][$j]->{"Field"} !== "created_at" AND strpos($data[$i]["columns"][$j]->{"Type"}, "int") == false AND $data[$i]["columns"][$j]->{"Key"} !== "PRI" ){ //Not Primary Keys
            $column_rules = "required";
            //Add more rules === 2B Done

            //Add email rules
            if($data[$i]["columns"][$j]->{"Field"} == "email"){
                $column_rules .= "|email";
            }

            //Add number rules
            if(strpos($data[$i]["columns"][$j]->{"Type"}, "int") == true){
                $column_rules .= "|numeric";
            }                        
            array_push($store_fields, "\t\t\t$".$table."->".$data[$i]["columns"][$j]->{"Field"}." = Input::get('".$data[$i]["columns"][$j]->{"Field"}."');\n");
            array_push($new_content, "\t\t\t'".$data[$i]["columns"][$j]->{"Field"}."' => '".$column_rules."'".($j != count($data[$i]["columns"]) -1 ? "," : "")." \n");
        }
    }
    array_push($new_content, "\t\t); \n");

    array_push($new_content, "\t\t\$validator = Validator::make(Input::all(), \$rules);\n\n");
    array_push($new_content, "\t\t// process the validator\n");
    array_push($new_content, "\t\tif(\$validator->fails()){\n");
    array_push($new_content, "\t\t\treturn Redirect::to('".$table."/create')\n");
    array_push($new_content, "\t\t\t\t->withErrors(\$validator)\n");
    array_push($new_content, "\t\t\t\t->withInput(Input::all());\n");
    array_push($new_content, "\t\t} else {\n");
    array_push($new_content, "\t\t\t// store the data \n");
    array_push($new_content, "\t\t\t$".$table." = new ".$table."; \n");

   //merge $column_rules into $new_content
    $new_content = array_merge($new_content, $store_fields);

    array_push($new_content, "\t\t\t\$".$table."->save();\n\n");
    array_push($new_content, "\t\t\t// redirect\n");
    array_push($new_content, "\t\t\tSession::flash('message', 'Successfully created ".$table."!');\n");
    array_push($new_content, "\t\t\treturn Redirect::to('".$table."');\n");
    array_push($new_content, "\t\t}\n");
?> 
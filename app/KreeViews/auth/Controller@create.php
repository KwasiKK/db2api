    <?php
        $new_content = [
            "\t\treturn User::create([\n",
        ];

        foreach ($request["fields"] as $key => $field) {
            $field_name = snake_case($field["name"]);
            array_push($new_content, "\t\t\t'".$field_name."' => \$data['".$field_name."'],\n");
        }
        array_push($new_content, "\t\t\t'password' => Hash::make(\$data['password']),\n");
        array_push($new_content, "\t\t]);\n");
?>
<?php
    $new_content = [
        "<?php\n\n",
        "namespace ".$request["project_name"].";\n\n",

        "use Illuminate\Auth\Authenticatable;\n\n",

        "use Illuminate\Database\Eloquent\Model;\n",
        "use Illuminate\Auth\Passwords\CanResetPassword;\n",
        "use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;\n",
        "use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;\n\n",

        "class User extends Model implements AuthenticatableContract, CanResetPasswordContract\n",
        "{\n",
        "\tuse Authenticatable, CanResetPassword;\n\n",

        "\t/**\n",
        "\t * The database table used by the model.\n",
        "\t *\n",
        "\t * @var string\n",
        "\t */\n",
        "\tprotected \$table = 'users';\n\n",

        "\t/**\n",
        "\t * The attributes that are mass assignable.\n",
        "\t *\n",
        "\t * @var array\n",
        "\t */\n\n",
    ];

    $fields = "\tprotected \$fillable = [";
    foreach ($request["fields"] as $key => $field) {
        $field_name = snake_case($field["name"]);
        $fields .= "'".$field_name."', ";
    }
    $fields .= "];\n\n";

    array_push($new_content, $fields);

    $new_content = array_merge($new_content, [
        "\t/**\n",
        "\t * The attributes excluded from the model's JSON form.\n",
        "\t *\n",
        "\t * @var array\n",
        "\t */\n",
        "\tprotected \$hidden = ['password', 'remember_token'];\n",
        "}\n",
    ]);
?>
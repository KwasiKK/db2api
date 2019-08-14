<?php
    $new_content = [
        "<?php\n\n",

        "/*\n",
        "|--------------------------------------------------------------------------\n",
        "| Application Routes\n",
        "|--------------------------------------------------------------------------\n",
        "|\n",
        "| Here is where you can register all of the routes for an application.\n",
        "| It's a breeze. Simply tell Laravel the URIs it should respond to\n",
        "| and give it the controller to call when that URI is requested.\n",
        "|\n",
        "*/\n\n",

        "Auth::routes();\n\n",

        "Route::get('/', function () {\n",
        "\treturn view('welcome');\n",
        "});\n\n",

        "Route::group(['middleware' => 'auth'], function()\n",
        "{\n"
    ];
?>
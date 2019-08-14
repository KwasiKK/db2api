    <?php
        $auth_routes = [
            "\n// Authentication routes...\n",
            "Route::get('auth/login', 'Auth\AuthController@getLogin');\n",
            "Route::post('auth/login', 'Auth\AuthController@postLogin');\n",
            "Route::get('auth/logout', 'Auth\AuthController@getLogout');\n\n",

            "// Registration routes...\n",
            "Route::get('auth/register', 'Auth\AuthController@getRegister');\n",
            "Route::post('auth/register', 'Auth\AuthController@postRegister');\n\n",

            "Route::get('auth/verify_page', 'Auth\AuthController@getVerifyPage');\n",
            "Route::get('register/verify/{confirmationCode}', [\n",
            "\t'as' => 'confirmation_path',\n",
            "\t'uses' => 'Auth\AuthController@confirm'\n",
            "]);\n\n",

            "// Password routes...\n",
            "Route::controllers([\n",
            "\t'password' => 'Auth\PasswordController'\n",
            "]);\n",
        
        ];
?>
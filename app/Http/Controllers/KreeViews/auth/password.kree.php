    <?php
        $new_content = [
            "@extends('main')\n",

            "@section('content')\n",
            "<section id=\"login\" class=\"container content-section text-center\">\n",
            "\t<div class=\"row\">\n",
            "\t\t<div class=\"col-md-8 col-md-offset-2\">\n",
            "\t\t\t<div class=\"panel panel-default\">\n",
            "\t\t\t\t<div class=\"panel-heading\">Reset Password</div>\n",
            "\t\t\t\t<div class=\"panel-body\">\n",
            "\t\t\t\t\t@if (session('status'))\n",
            "\t\t\t\t\t\t<div class=\"alert alert-success\">\n",
            "\t\t\t\t\t\t\t{{ session('status') }}\n",
            "\t\t\t\t\t\t</div>\n",
            "\t\t\t\t\t@endif\n",

            "\t\t\t\t\t@include('errors.list')\n\n",

            "\t\t\t\t\t<form class=\"form-horizontal\" role=\"form\" method=\"POST\" action=\"{{ url('/password/email') }}\">\n",
            "\t\t\t\t\t\t<input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\">\n",

            "\t\t\t\t\t\t<div class=\"form-group\">\n",
            "\t\t\t\t\t\t\t<label class=\"col-md-4 control-label\">E-Mail Address</label>\n",
            "\t\t\t\t\t\t\t<div class=\"col-md-6\">\n",
            "\t\t\t\t\t\t\t\t<input type=\"email\" class=\"form-control\" name=\"email\" value=\"{{ old('email') }}\">\n",
            "\t\t\t\t\t\t\t</div>\n",
            "\t\t\t\t\t\t</div>\n",

            "\t\t\t\t\t\t<div class=\"form-group\">\n",
            "\t\t\t\t\t\t\t<div class=\"col-md-6 col-md-offset-4\">\n",
            "\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\">\n",
            "\t\t\t\t\t\t\t\t\tSend Password Reset Link\n",
            "\t\t\t\t\t\t\t\t</button>\n",
            "\t\t\t\t\t\t\t</div>\n",
            "\t\t\t\t\t\t</div>\n",
            "\t\t\t\t\t</form>\n",
            "\t\t\t\t</div>\n",
            "\t\t\t</div>\n",
            "\t\t</div>\n",
            "\t</div>\n",
            "</section>\n",
            "@endsection\n"
          
        ];
?>
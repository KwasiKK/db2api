<?php
            $new_content = [
                "<!DOCTYPE html>\n",
                "<html lang=\"en\">\n",
                "<head>\n\n",

                "\t\t<meta charset=\"utf-8\">\n",
                "\t\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n",
                "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n",
                "\t\t<meta name=\"description\" content=\"Assigned Developer should fill this in\">\n",
                "\t\t<meta name=\"author\" content=\"Kabelo Kwasi Kgwete\">\n\n",

                "\t\t<title>Assigned Developer should fill this in</title>\n\n",

                "\t\t<!-- Bootstrap Core CSS -->\n",
                "\t\t<link href=\"{{ asset('/css/bootstrap.min.css') }}\" rel=\"stylesheet\">\n\n",

                "\t\t<!-- Custom CSS -->\n",
                "\t\t<link href=\"{{ asset('/css/application.css') }}\" rel=\"stylesheet\">\n\n",

                "\t\t<!-- bootstrap-switch CSS -->\n",
                "\t\t<link href=\"{{ asset('/css/highlight.css') }}\" rel=\"stylesheet\">\n",
                "\t\t<link href=\"{{ asset('/css/bootstrap-switch.css') }}\" rel=\"stylesheet\">\n\n",

                "\t\t<!-- Favicons -->\n",
                "\t\t<link href=\"{{ asset('/img/favicon/favicon.png') }}\" rel=\"shortcut icon\">\n",
                "\t\t<link href=\"{{ asset('/img/favicon/apple-touch-icon-57-precomposed.png') }}\" rel=\"apple-touch-icon\">\n",
                "\t\t<link href=\"{{ asset('/img/favicon/apple-touch-icon-72-precomposed.png') }}\" rel=\"apple-touch-icon\" sizes=\"72x72\">\n",
                "\t\t<link href=\"{{ asset('/img/favicon/apple-touch-icon-144-precomposed.png') }}\" rel=\"apple-touch-icon\" sizes=\"114x114\">\n\n",

                "\t\t<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->\n",
                "\t\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n",
                "\t\t<!--[if lt IE 9]>\n",
                "\t\t\t\t<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>\n",
                "\t\t\t\t<script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>\n",
                "\t\t<![endif]-->\n\n",

                "\t\t<!-- Modernizr Scripts -->\n",
                "\t\t<script src=\"{{ asset('/js/vendor/modernizr-2.7.1.min.js') }}\"></script>\n\n",

                "\t\t@yield('head')\n",
                "</head>\n",
                "<body\tclass=\"index\" id=\"to-top\">\n",
                "\t\t<!-- Side nav -->\n",
                "\t\t<nav class=\"side-nav\" role=\"navigation\">\n\n",

                "\t\t\t<ul class=\"nav-side-nav\">\n",
                "\t\t\t\t<li><a class=\"tooltip-side-nav\" href=\"#section-1\" title=\"\" data-original-title=\"Services\" data-placement=\"left\"></a></li>\n",
                "\t\t\t\t<li><a class=\"tooltip-side-nav\" href=\"#section-2\" title=\"\" data-original-title=\"Features\" data-placement=\"left\"></a></li>\n",
                "\t\t\t\t<li><a class=\"tooltip-side-nav\" href=\"#section-3\" title=\"\" data-original-title=\"Subscribe\" data-placement=\"left\"></a></li>\n",
                "\t\t\t\t<li><a class=\"tooltip-side-nav\" href=\"#to-top\" title=\"\" data-original-title=\"Back\" data-placement=\"left\"></a></li>\n",
                "\t\t\t</ul>\n\n",

                "\t\t</nav> <!-- /.side-nav -->\n\n",

                "\t\t<div class=\"feedback\"></div>\n\n",

                "\t\t@yield('content')\n\n",

                "\t\t@yield('modals')\n\n",


                "\t\t<!-- Footer -->\n",
                "\t\t<footer class=\"footer-section\" role=\"contentinfo\">\n\n",

                "\t\t\t<div class=\"container\">\n\n",

                "\t\t\t\t<div class=\"row\">\n\n",

                "\t\t\t\t\t<div class=\"col-md-4 col-footer\">\n\n",

                "\t\t\t\t\t\t<!-- Footer 1 -->\n",
                "\t\t\t\t\t\t<section>\n",
                "\t\t\t\t\t\t\t<p>Made with <i class=\"fa fa-heart\"></i> by Kwasi Kgwete.</p>\n",
                "\t\t\t\t\t\t</section>\n\n",

                "\t\t\t\t\t\t<!-- AddThis Button -->\n",
                "\t\t\t\t\t\t<ul class=\"addthis_toolbox addthis_default_style\">\n\n",

                "\t\t\t\t\t\t\t<li><a class=\"addthis_button_facebook_like\"></a></li>\n",
                "\t\t\t\t\t\t\t<li><a class=\"addthis_button_tweet\"></a></li>\n\n",

                "\t\t\t\t\t\t</ul> <!-- /.addthis_toolbox -->\n\n",

                "\t\t\t\t\t</div> <!-- /.col-md-4 -->\n\n",

                "\t\t\t\t\t<div class=\"col-md-4 col-footer col-padding\">\n\n",

                "\t\t\t\t\t\t<!-- Footer 1 -->\n",
                "\t\t\t\t\t\t<section class=\"text-center\">\n",
                "\t\t\t\t\t\t\t<p>Be sure to read <a href=\"#fakelinks\">Terms</a> and <a href=\"#fakelinks\">Privacy Policy</a>.</p>\n",
                "\t\t\t\t\t\t</section>\n\n",

                "\t\t\t\t\t\t<!-- Social media links -->\n",
                "\t\t\t\t\t\t<ul class=\"social-media-links\">\n\n",

                "\t\t\t\t\t\t\t<li><a class=\"fa fa-twitter tw\" href=\"#fakelinks\"></a></li>\n",
                "\t\t\t\t\t\t\t<li><a class=\"fa fa-facebook fb\" href=\"#fakelinks\"></a></li>\n",
                "\t\t\t\t\t\t\t<li><a class=\"fa fa-pinterest pn\" href=\"#fakelinks\"></a></li>\n\n",

                "\t\t\t\t\t\t</ul> <!-- /.social-media-links -->\n\n",

                "\t\t\t\t\t</div> <!-- /.col-md-4 -->\n\n",

                "\t\t\t\t\t<div class=\"col-md-4 col-footer\">\n\n",

                "\t\t\t\t\t\t<!-- Footer 1 -->\n",
                "\t\t\t\t\t\t<section>\n",
                "\t\t\t\t\t\t\t<p><strong>Marabele Enterprise</strong> <br>Berantah Street, Block 123 <br>South, 12356.</p>\n",
                "\t\t\t\t\t\t</section>\n\n",

                "\t\t\t\t\t</div> <!-- /.col-md-4 -->\n\n",

                "\t\t\t\t</div> <!-- /.row -->\n\n",

                "\t\t\t</div> <!-- /.container -->\n\n",

                "\t\t</footer> <!-- /.footer-section -->\n\n",

                "\t\t@yield('footer')\n\n",

                "\t\t<style type=\"text/css\">\n",
                "\t\t\t\t.img-logo{\n",
                "\t\t\t\t\tborder-radius: 0px 55px 91px;\n",
                "\t\t\t\t\tbackground-color: aliceblue;\n",
                "\t\t\t\t}\n",
                "\t\t</style>\n\n",

                "\t\t<!-- Scripts -->\n",
                "\t\t<script src=\"{{ asset('/js/vendor/jquery-2.1.0.min.js') }}\"></script>\n",
                "\t\t<script src=\"{{ asset('/js/bootstrap.min.js') }}\"></script>\n",
                "\t<script src=\"{{ asset('/js/jquery.form.js') }}\"></script>\n\n",

                "\t<!-- Plugin JavaScript -->\n",
                "\t<script src=\"{{ asset('/js/assets/application.js') }}\"></script>\n\n",

                "\t<!-- Plugin JavaScript -->\n",
                "\t<script src=\"{{ asset('/js/assets/highlight.js') }}\"></script>\n",
                "\t<script src=\"{{ asset('/js/bootstrap-switch.js') }}\"></script>\n",
                "\t<script src=\"{{ asset('/js/main.js') }}\"></script>\n\n",

                "\t\t@if(isset(\$welcome_page))\n\n",

                "\t\t@else\n",
                "\t\t\t\t<script type=\"text/javascript\">//\$(\".navbar\").addClass(\"top-nav-collapse\");</script>\n",
                "\t\t@endif\n\n",

                "\t\t@yield('scripts')\n",
                "</body>\n",
                "</html>\n\n"
            ];
?>
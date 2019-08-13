<?php
    $new_content = [
        "\t\t@if (count(\$errors) > 0)\n",
        "\t\t\t<div class=\"col-md-8 col-md-offset-2\">\n",
        "\t\t\t\t<div class=\"alert alert-danger\">\n",
        "\t\t\t\t\t<strong>Whoops!</strong> There were some problems with your input.<br><br>\n",
        "\t\t\t\t\t<ul>\n",
        "\t\t\t\t\t\t@foreach (\$errors->all() as \$error)\n",
        "\t\t\t\t\t\t\t<li>{{ \$error }}</li>\n",
        "\t\t\t\t\t\t@endforeach\n",
        "\t\t\t\t\t</ul>\n",
        "\t\t\t\t</div>\t\n",
        "\t\t\t</div>\n",
        "\t\t@endif\n"
    ];
?> 
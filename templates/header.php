<?php
    $root = substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
    $root = str_replace("/templates", "/", $root);
?>
<head>
    <title>MC Server Panel | <?php echo $title ?></title>
    <link href="<?php echo $root?>include/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $root?>include/css/jquery.scrollbar.css" rel="stylesheet">
    <script src="<?php echo $root?>include/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $root?>include/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $root?>include/js/jquery.scrollbar.min.js"></script>
    <script src="<?php echo $root?>include/<?php echo $title?>/script.js"></script>
    <script>
        $(document).ready(function () {
           $(".scrollbar-rail").scrollbar();
        });
    </script>
    <style>
        html {
            height: 100%;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
        }

        .container {
            max-height: 85%;
        }

        .navbar {
            max-height: 15%;
        }
    </style>
</head>
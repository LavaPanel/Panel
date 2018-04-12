<?php
    $root = substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
    $root = str_replace("/templates", "/", $root);
?>
<head>
    <title>Lava Panel | <?php echo $title ?></title>
    <link href="<?php echo $root?>include/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $root?>include/css/jquery.scrollbar.css" rel="stylesheet">
    <script src="<?php echo $root?>include/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $root?>include/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $root?>include/js/jquery.scrollbar.min.js"></script>
    <script src="<?php echo $root?>include/<?php echo $title?>/script.js"></script>
    <script>
        $(document).ready(function () {
            $(".scrollbar-rail").scrollbar();
            resize();
            window.onresize = function() {
                resize();
            };
            $(".dropdown").hover(resize, function () {
                setTimeout(resize, 200);
            });
            $(".navbar-toggler").click(function () {
                setTimeout(resize, 1000);
            });
        });
        function resize()
        {
            var heights = window.innerHeight;
            heights -= $(".navbar").height();
            heights -= 40;
            $(".container").height(heights + "px");
        }
    </script>
</head>
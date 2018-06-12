<?php
if($title != "Install") {
    if(!file_exists($_SERVER['DOCUMENT_ROOT'] . "storage/install.lock")) {
        ?>
        <script>
            window.location.replace("/install.php");
        </script>
        <?php
        return;
    }
}
?>
<head>
    <title>Lava Panel | <?php echo $title ?></title>
    <link href="/include/css/bootstrap.min.css" rel="stylesheet">
    <link href="/include/css/jquery.scrollbar.css" rel="stylesheet">
    <link href="/favicon.ico" rel="icon">
    <script src="/include/js/jquery-3.2.1.min.js"></script>
    <script src="/include/js/jquery.validate.min.js"></script>
    <script src="/include/js/bootstrap.bundle.min.js"></script>
    <script src="/include/js/jquery.scrollbar.min.js"></script>
    <script src="/include/pages/<?php echo $title?>/script.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
    <style>
        .container {
            overflow-x: hidden;
        }

        .row {
            max-width: 95%;
        }
    </style>
</head>
<body>
<?php
if(!isset($nonav)) {
include_once "navbar.php";
}
?>
</body>

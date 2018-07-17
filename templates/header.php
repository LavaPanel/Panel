<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/util/GeneralUtils.php";
if($title != "Install") {
    if(!file_exists($_SERVER['DOCUMENT_ROOT'] . "storage/install.lock")) {
        ?>
        <script>
            //window.location.replace("/install.php");
        </script>
        <?php
        //return;
    }
}
if($title != "Login") {
    if (!userLogedIn()) {
        ?>
        <script>
            window.location.replace("/login.php");
        </script>
        <?php
    }
}
?>
<head>
    <title>Lava Panel | <?php echo $title ?></title>
    <link href="/include/css/bootstrap.min.css" rel="stylesheet">
    <link href="/include/css/jquery.scrollbar.css" rel="stylesheet">
    <?php
    if($title != "Install") {
        ?>
        <link href="/include/css/alerts.css" rel="stylesheet">
        <!-- TODO work on alert script -->
        <?php
    }
    ?>
    <link href="/include/pages/<?php echo $title?>/style.css" rel="stylesheet" />
    <link href="/include/css/jquery.contextMenu.css" rel="stylesheet">
    <link href="/favicon.ico" rel="icon">
    <script src="/include/js/jquery-3.2.1.min.js"></script>
    <script src="/include/js/jquery.contextMenu.min.js"></script>
    <script src="/include/js/jquery.validate.min.js"></script>
    <script src="/include/js/bootstrap.bundle.min.js"></script>
    <script src="/include/js/jquery.scrollbar.min.js"></script>
    <?php
    if($title != "Install") {
        ?>
        <script src="/include/js/alert.js"></script>
        <?php
    }
    ?>
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

            /*$.contextMenu({
                selector: 'body',
                callback: function(key, options) {
                    var m = "clicked: " + key;
                    window.console && console.log(m) || alert(m);
                },
                items: {
                    'test': {name: "Test"},
                    'edit': {name: "Edit", icon: "edit"},
                    "sep1": "---------",
                    'stuff': {name: "Stuff"}
                }
            });*/
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
<div class="alerts" style="min-width: 25%">

</div>
</body>
<script>
    //TODO handle this better. we don't want everyone doing evals
    function input(string) {
        $.ajax({
            url: '/util/eval.php',
            data: 'data=' + string,
            success: function (results) {
                console.log(results);
            }
        });
    }

    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };
</script>
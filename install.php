<html>
<?php
$title = "Install";
include_once "templates/header.php";
require_once "util/DatabaseUtils.php";
?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">
        Install
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="">Step 1</a></li>
            <!--            <li class="nav-item"><a class="nav-link disabled" href="">>></a></li>-->
        </ul>
    </div>
</nav>
<div class="container scrollbar-rail">
    <div class="content">
        <div class="jumbotron">
            <h1>Install</h1>
            <hr>
            <p>This page will guide you through installing the front end part of the server controller</p>
        </div>
        <div id="step1">
            <div class="jumbotron">
                <h1>Extensions Check</h1>
                <hr>
                <p>In this step we will check to make sure you have the extensions the panel needs to operate</p>
            </div>
            <code>
                <?php
                $needed = array(
                    "json",
                    "curl",
                    "PDO"
                );
                $not_loaded = false;
                foreach ($needed as $needs) {
                    if (extension_loaded($needs)) {
                        echo "<p class='extension'>" . ucwords($needs) . " - <img class='good' height='20' src='include/img/check.svg' alt='Good!'></p>";
                    } else {
                        echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
                        $not_loaded = true;
                    }
                }
                ?>
            </code>
            <?php
            if ($not_loaded) {
                echo "Extensions needed!";
            } else {
                echo "Extensions good!";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
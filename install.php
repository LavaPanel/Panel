<html>
<?php
$title = "Install";
include_once "templates/header.php";
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
        <ul id="steps-header" class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="?step=1">Step 1</a></li>
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
            <p>This saves after each step so if you ever need to come back later just copy the current url and it will
                auto resume!</p>
        </div>
        <div id="install-buttons-top">
            <button class="btn btn-primary prev" onclick="prev()" value="Previous Step"> < Previous</button>
            <button class="btn btn-primary float-right next" onclick="next()" value="Next Step" disabled>Next >
            </button>
            <button class="btn btn-primary float-right finish" onclick="end()" value="End" disabled>Finish</button>
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
                        if ($needs == "PDO") {
                            if (count(PDO::getAvailableDrivers()) == 0) {
                                echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad-pdo' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
                                $not_loaded = true;
                            } else {
                                echo "<p class='extension'>" . ucwords($needs) . " - <img class='good' height='20' src='include/img/check.svg' alt='Good!'></p>";
                                ?>
                                <div class="ml-2">
                                    <p>Available PDO drivers</p>
                                    <?php
                                    foreach (PDO::getAvailableDrivers() as $key => $value) {
                                        echo "<p> - $value</p>";
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p class='extension'>" . ucwords($needs) . " - <img class='good' height='20' src='include/img/check.svg' alt='Good!'></p>";
                        }
                    } else {
                        echo "<p class='extension'>" . ucwords($needs) . " - <img class='bad' height='20' id='bad' src='include/img/cross.svg' alt='Bad!'></p>";
                        $not_loaded = true;
                    }
                }
                ?>
            </code>
            <?php
            if ($not_loaded) {
                echo "Extensions needed! Please reload the page after you've installed the extensions";
            } else {
            ?>
                <script>
                    $(document).ready(function () {
                        enableButtons(1);
                    });
                </script>
                <?php
            }
            ?>
        </div>
    </div>

    <div id="step2">
        <div class="jumbotron">
            <h1>Storage Setup</h1>
            <hr>
            <p>In this step you will set up your storage method</p>
        </div>
        <script>
            enableButtons(2);
        </script>
    </div>

    <div id="step3">
        <div class="jumbotron">
            <h1>Temp</h1>
            <hr>
            <p>I'm testing stuffs</p>
        </div>
    </div>

    <div id="install-buttons-bottom">
        <button class="btn btn-primary prev" onclick="prev()" value="Previous Step"> < Previous</button>
        <button class="btn btn-primary float-right next" onclick="next()" value="Next Step" disabled>Next >
        </button>
        <button class="btn btn-primary float-right finish" onclick="end()" value="End" disabled>Finish</button>
    </div>
</div>
</body>
</html>
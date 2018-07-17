<html>
<?php
if(!file_exists("storage/install.lock")) {
    $title = "Install";
    $nonav = true;
    include_once "templates/header.php";
    $supported = array(
        'mysql',
        'sqlite'
    )
    ?>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"><img src="/include/img/banner.png" height="30px"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="steps-header" class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="?step=1">Step 1</a></li>
            </ul>
        </div>
    </nav>
    <div class="container scrollbar-rail">
        <div class="content">
            <div class="jumbotron">
                <h1>Install</h1>
                <hr>
                <p>This page will guide you through installing the front end part of the server controller</p>
                <p>This saves after each step so if you ever need to come back later just copy the current url and it
                    will
                    auto resume!</p>
            </div>
            <div id="install-buttons-top">
                <button class="btn btn-primary prev" value="Previous Step"> < Previous</button>
                <button class="btn btn-primary float-right next" value="Next Step" disabled>Next >
                </button>
                <button class="btn btn-primary float-right finish" onclick="end()" value="End" disabled>Finish</button>
            </div>

            <?php
            foreach (scandir("templates/Install") as $file) {
                $path = "templates/Install/" . $file;
                $info = pathinfo($path);
                if (array_key_exists('extension', $info)) {
                    if ($info['extension'] === 'php') {
                        include_once $path;
                    }
                }
            }
            ?>

            <div id="install-buttons-bottom">
                <button class="btn btn-primary prev" onclick="prev()" value="Previous Step"> < Previous</button>
                <button class="btn btn-primary float-right next" onclick="next()" value="Next Step" disabled>Next >
                </button>
                <button class="btn btn-primary float-right finish" onclick="end()" value="End" disabled>Finish</button>
            </div>
        </div>
    </body>
    <?php
} else {
    ?>
    <h1>Remove the file <code>storage/install.lock</code> to reinstall</h1>
<?php
}
?>
</html>
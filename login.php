<?php
$nonav = true;
$title = "Login";
include_once "templates/header.php";
?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand"><img src="/include/img/banner.png" height="30px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<div class="container">
    <div class="jumbotron">
        <h1>Login</h1>
        <hr/>
        <p>Login to your account</p>
    </div>
    <div class="btn-group">
        <button id="btn-login" onclick="loginFun()" class="btn btn-primary">Login</button>
        <?php
            $config = new JsonConfig();
            $create = false;
        try {
            if ($config->getBoolean("allowGuestCreate")) {
                $create = true;
                ?>
                <button id="btn-create" onclick="createFun()" class="btn btn-secondary">Create Account</button>
                <?php
            }
        } catch (ElementNotFoundException $e) {
            echo warn($e->getMessage(), $e->getTraceAsString());
        } catch (ElementTypeMismatchException $e) {
            echo warn($e->getMessage(), $e->getTraceAsString());
        }
        ?>
    </div>
    <div id="login">
        <form>
            <label for="name">Email</label>
            <input class="form-control" type="email" id="name" name="name">
            <label for="pass">Password</label>
            <input class="form-control" type="password" id="pass" name="pass">
            <div class="form-check form-group">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Login">
        </form>

        <a href="javascript:void(0)" type="button" onclick="forgotFun()">Forgot password</a>
    </div>
    <?php
    if($create) {
        ?>
        <form id="create">
            <label for="username">Username</label>
            <input required type="text" id="username" name="username" class="form-control">
            <label for="create-email">Email</label>
            <input required type="email" id="create-email" name="email" class="form-control">
            <div class="row">
                <div class="col">
                    <label for="password">Password</label>
                    <input required type="password" id="password" name="pass" class="form-control">
                </div>
                <div class="col">
                    <label for="pass-repeat">Repeat Password</label>
                    <input required type="password" id="pass-repeat" class="form-control">
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Submit">
        </form>
        <?php
    }
    ?>
    <form id="forgot">
        <label for="forgot-email">Email</label>
        <input type="email" id="forgot-email" name="email" class="form-control">
        <input type="submit" class="btn btn-primary float-right" value="Submit">
    </form>
</div>
</body>

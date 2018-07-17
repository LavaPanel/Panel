<?php
if(!isset($_GET['action'])) {
    header("location: /");
    return;
}
$action = $_GET['action'];
if($action == "login") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $remember = isset($_POST['remember']);
}
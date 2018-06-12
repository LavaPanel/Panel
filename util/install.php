<?php
if(isset($_GET['savedb'])) {
    $data = file_get_contents('php://input');
    file_put_contents("../storage/db.json", $data);
} else if(isset($_GET['lock'])) {
    file_put_contents("../storage/install.lock", "Remove this file to reinstall");
} else if(isset($_GET['testconn'])) {
    require_once "GeneralUtils.php";
    $data = json_decode(file_get_contents('php://input'), true);

    $good = true;

    $type = $data['type'];
    if($type === "mysql") {
        $host = $data['host'];
        $port = $data['port'];
        $database = $data['db'];
        $user = $data['user'];
        $pass = $data['pass'];

        $server = $host . ":" . $port;

        try {
            $conn = new PDO("mysql:host=$server;dbname=$database", $user, $pass);
            $result = array("status" => "good");
        } catch (PDOException $e) {
            $result = array("status" => "bad", "message" => $e->getMessage());
        }
    } else if($type == "sqlite") {
        $path = $data['path'];
        try {
            $conn = new PDO("sqlite:$path");
            $result = array("status" => "good");
        } catch (PDOException $e) {
            $result = array("status" => "bad", "message" => $e->getMessage());
        }
    } else {
        $result = array("status" => "bad", "message" => $type . " isn't implemented fully yet");
    }
    echo json_encode($result);
}
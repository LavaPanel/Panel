<?php
function getPDO() {
    $data = json_decode(file_get_contents("../storage/db.json"));

    $conn = null;

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
        } catch (PDOException $e) {

        }
    } else if($type == "sqlite") {
        $path = $data['path'];
        try {
            $conn = new PDO("sqlite:$path");
        } catch (PDOException $e) {
            
        }
    } else {

    }

    return $conn;
}
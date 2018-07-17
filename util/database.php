<?php
require_once "GeneralUtils.php";

/**
 * @return null|PDO
 */
function getPDO() {
    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/storage/db.json"), true);

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

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error("Error connecting to database", $e->getMessage(), false);
        }
    } else if($type == "sqlite") {
        $path = $data['path'];
        try {
            $conn = new PDO("sqlite:$path");
        } catch (PDOException $e) {
            error("Error connecting to database", $e->getMessage(), false);
        }
    } else {
        error("Error connecting to database", "Database type '" . $type . "' isn't defined!", false);
    }

    return $conn;
}
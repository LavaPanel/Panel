<?php
require_once "database.php";
require_once "config.php";
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function warn($title, $message) {
    $pdo = getPDO();
    $addError = "INSERT INTO messages (type, title, message) VALUES ('warn', :title, :message)";
    try {
        $prepare = $pdo->prepare($addError);
        $prepare->bindParam(':title', $title);
        $prepare->bindParam(':message', $message);
        $prepare->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function error($title, $message, $db = true) {
    if(!$db) {
        $data = array();
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/storage/error.json")) {
            $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/storage/error.json"));
        }
        $error = array();
        $error['title'] = $title;
        $error['message'] = $message;
        array_push($data, $error);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/storage/error.json", json_encode($data));
        return;
    }

    $pdo = getPDO();
    $addError = "INSERT INTO messages (type, title, message) VALUES ('error', :title, :message)";
    try {
        $statement = $pdo->prepare($addError);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':message', $message);
        $statement->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

if(isset($_GET['messages'])) {
    $uuid = $_GET['UUID'];
    $getMessages = "";
}

/**
 * @return bool|string
 */
function userLogedIn() {
    if(!isset($_SESSION['userid'])) {
        if(isset($_COOKIE['token'])) {
            if(isset($_COOKIE['userid'])) {
                $userid = $_COOKIE['userid'];
                $token = $_COOKIE['token'];
                $getUser = "SELECT userid, token FROM not_expired WHERE userid = '$userid' AND token = '$token'";
                $pdo = getPDO();
                $pdoStatment = $pdo->query($getUser);
                $results = $pdoStatment->fetchAll();
                if(count($results) > 0) {
                    $_SESSION['userid'] = $userid;
                    return $userid;
                } else {
                    unset($_COOKIE['userid']);
                    unset($_COOKIE['token']);
                    return false;
                }
            } else {
                unset($_COOKIE['token']);
                return false;
            }
        } else {
            if(isset($_COOKIE['userid'])) {
                unset($_COOKIE['userid']);
            }
            return false;
        }
    } else {
        return $_SESSION['userid'];
    }
}

function getAdminLevel() {
    $userid = userLogedIn();
    if(!$userid) {
        return 0;
    } else {
        $getUser = "SELECT adminlevel FROM user WHERE userid = '$userid'";
        $pdo = getPDO();
        $pdoStatment = $pdo->query($getUser);
        $results = $pdoStatment->fetch(PDO::FETCH_ASSOC);
        $adminLevel = $results['adminlevel'];
        return $adminLevel;
    }
}
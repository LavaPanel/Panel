<?php
//TODO user control
require_once "GeneralUtils.php";
    if (isset($_GET['dismiss'])) {
        $id = $_GET['dismiss'];
        $user = userLogedIn();
        $delete = "DELETE FROM user_messages WHERE userid = '$user' AND messageid = '$id'";
        return;
    }
    $user = userLogedIn();
    $getMessages = "SELECT userid, messageid, title, message, type FROM user_messages um INNER JOIN messages m on um.messageid = m.id WHERE userid = '$user'";
    $db = getPDO();
    $resultStatement = $db->query($getMessages);
    $result = $resultStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>
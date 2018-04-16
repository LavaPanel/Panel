<?php
require_once "GeneralUtils.php";
$data = json_decode(file_get_contents('php://input'), true);
echo "{\"type\": \"" . $data['type'] . "\"}";
?>
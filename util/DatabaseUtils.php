<?php
require_once "GeneralUtils.php";
class DatabaseUtils
{
    private $conn = null;

    function __construct($host, $user, $pass, $port, $database)
    {
        //$this->conn = mysqli_connect($host, $user, $pass, $database, $port);
    }

    public function getMysql()
    {
        return $this->conn;
    }

    public function createTable($name, $object) {
        debug_to_console(get_object_vars($object));
    }
}
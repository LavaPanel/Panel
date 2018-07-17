<?php
require_once ("GeneralUtils.php");
echo "evaling \n" . $_GET['data'] . " \n\n";
echo (print_r(eval($_GET['data']), true));
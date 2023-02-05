<?php

session_start();
session_destroy();
$_SESSION = array(); 
header ('location: ../Cliente/login.php');
die();
?>

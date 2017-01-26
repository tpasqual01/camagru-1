<?php
//session_start();
require_once('includes.php');
$_SESSION = array(); session_destroy(); 
header('Location: index.php');
exit;
?>

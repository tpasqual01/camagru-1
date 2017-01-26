<?php
//session_start();
require_once('includes.php');
//CSession->kill_session();
//if ($_SESSION["valide"] !='ok') {header('Location: login.php');}
$_SESSION = array(); session_destroy(); 
header('Location: index.php');
exit;
?>

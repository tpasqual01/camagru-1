<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');

if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}



print('<div id="main">');
print ('<p>Home</p>');

print('</div>');	
include ('footer.php');
?>

<?php
//session_start();
require_once('includes.php');
require_once('head.php');
require_once('header.php');

if ($_SESSION["valide"]=='ok') { print('session valide)'); }
else
{header('Location: index.php');}

print('<div id="main">');
print ('<p>Home</p>');

print('</div>');	
include ('footer.php');
?>

<?php
session_start();
if (!$_SESSION["email"] || $_SESSION["valide"] !='ok') {header('Location: login.php');} 
//if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}
if ($_SESSION["valide"]=='ok') {header('Location: home.php');}


require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$session = new CSession($_POST);
$session->user_login();
/*$session_usr_exist = new CSession($_POST);
print ($session_usr_exist->user_exist());
exit();*/
print ('sess '.$_SESSION['valide']);
if ($_SESSION['valide'] == 'ok') 
{header('Location: home.php');}
else
{header('Location: index.php');}

print('<div id="main">');


	//include ('main.php');
//include ('aside.php');

print ('<p>Index</p>');

print('</div>');	
include ('footer.php');

?>

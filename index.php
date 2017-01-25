<?php
session_start();
if (!$_SESSION["email"] || $_SESSION["valide"] !='ok') {header('Location: login.php');} 
if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}
if ($_SESSION["valide"]=='ok') {header('Location: home.php');} //{ $_SESSION = array(); session_destroy();


require_once('includes.php');
require_once('head.php');
require_once('header.php');

/*session oui ou non
login ok ou non
inscription
logoff*/

//$_SESSION = array(); session_destroy();
print('<div id="main">');


	//include ('main.php');
//include ('aside.php');

print ('<p>Index</p>');

print('</div>');	
include ('footer.php');





	/*if $login == ok
	print"Kill session<br />";
	$_SESSION = array();
	session_destroy();*/




/*include ('header.php');
include ('main.php');
include ('aside.php');
include ('footer.php');
include_once('Form.class.php');

$_SESSION["user"]=$value;
$_SESSION["status"]=$value;
*/

?>

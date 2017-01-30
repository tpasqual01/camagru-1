<?php
require_once('includes_session.php');
//$session = new CSession();
//$session->user_login();
$session = new CSession($_POST);
$user_exist = $session->user_exist();
require_once('head.php');
require_once('header.php');
print('<div id="main">');
//print ('retour '.$user_exist.'<br />');
if (!$user_exist) 
{ 
	print('<p>Création impossible</p>');
	$suite = 'index.php';
}

if ($user_exist == 'yes')
	{
		print('<p>Erreur : Utilisateur existe dans la base</p>'); 
		$suite = 'register.php';
	}

if ($user_exist == 'no') {
	print('<p>Utilisateur à créer dans la base</p>'); 
	$action = $session->user_add();
	if ($action == 'ok' ) 
	{
		print('<p>Utilisateur validé dans la base</p>');
		$suite = 'index.php';
	}
	else
	{
		print("<p>Impossible de créer l'utilisateur</p>");
		$suite = 'register.php';	
	}
	
 }

print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
?>
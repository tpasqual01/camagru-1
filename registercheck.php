<?php
// le retour de $user_exist ne fonctionne pas
// voir pourquoi
// remplacer print<p> par $print->content('hghghg')
// $action = $session->user_add();  enlever provisoirement a remettre a la fin
require_once('includes_session.php');
//$session = new CSession();
//$session->user_login();
$session = new CSession($_POST);
$user_exist = $session->user_exist();
$action_valid = new CInscription();
$print = new CPrint();

require_once('head.php');
require_once('header.php');
print('<div id="main">');
//print ('retour '.$user_exist.'<br />');
if (!$user_exist) 
{ 
	print('<p>Création impossible :'.$user_exist.'</p>');
	$suite = 'index.php';
}

if ($user_exist == 'yes')
	{
		print('<p>Erreur : Utilisateur existe dans la base</p>'); 
		$suite = 'register.php';
	}

if ($user_exist == 'no') {
	print('<p>Utilisateur à créer dans la base</p>'); 
	/////// out provisoir $action = $session->user_add();
	$action = 'ok'; /////// a remettre apres validation
	if ($action == 'ok' ) 
	{
		print('<p>Utilisateur validé dans la base</p>');
		if ($action_valid->send_validation($_SESSION) == 'ok'){$print->content('send ok');}
		print('<p><br />Un mail de validation de compte vient de vous être envoyé pour finaliser votre inscription</p>');
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
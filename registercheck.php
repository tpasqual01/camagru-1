<?php
// remplacer print<p> par $print->content('hghghg')
// $action = $session->user_add();  enlever provisoirement a remettre a la fin
require_once('includes_session.php');
//$session = new CSession();
//$session->user_login();
$CSession = new CSession();
$user_exist = $CSession->user_exist();
$CInscription = new CInscription();
$CPrint = new CPrint();

require_once('head.php');
require_once('header.php');
print('<div id="main">');

///////////////   a faire 
// tester si l'ensemble des champs sont renseignes
// si ce n'est pas le cas , reafficher le form en mettant les valeurs saisie et un message qui indique l'erreur

if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		print('<p>Création impossible :'.$user_exist.'</p>');
		$suite = 'index.php';
	}

if ($user_exist == 'yes')
	{
		$CPrint->content('Erreur : Utilisateur existe dans la base'); 
		$suite = 'register.php';
	}

if ($user_exist == 'no')
	{
		$CPrint->content('Utilisateur à créer dans la base'); 
		$action = $CSession->user_add();
	//$action = 'ok'; /////// a remettre apres validation
		if ($action == 'user_add' ) 
		{
			$CPrint->content('Utilisateur validé dans la base');
		//if ($CInscription->send_validation($_SESSION) == 'ok'){$print->content('send ok');}
			$CPrint->content('<br />Un mail de validation de compte vient de vous être envoyé à '.strip_tags($_POST['email']).'<br /> pour finaliser votre inscription');
			$suite = 'index.php';
		}
		else
		{
			$CPrint->content("Impossible de créer l'utilisateur");
			$suite = 'register.php';	
		}
	
 }

print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
?>
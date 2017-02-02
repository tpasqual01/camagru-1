<?php
// on recupere le mail pour envoyer un lien de reinitialisation de password
require_once('includes_session.php');
//$CSession = new CSession();
$user_exist = $CSession->user_exist();
$CInscription = new CInscription();
$CPrint = new CPrint();

require_once('head.php');
require_once('header.php');
print('<div id="main">');

if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		print('<p>Création impossible :'.$user_exist.'</p>');
		$suite = 'index.php';
	}

if ($user_exist == 'yes')
	{
		$CPrint->content('Vous allez recevoir un mail contenant un lien de réinitialisation'); 
		$suite = 'register.php';
	}

if ($user_exist == 'no')
	{
		$CPrint->content('le mail : '.$_POST['email'].' n\'existe pas dans la base'); 
		$suite = 'index.php';
		
			//$CPrint->content('<br />Un mail de validation de compte vient de vous être envoyé à '.strip_tags($_POST['email']).'<br /> pour finaliser votre inscription');

	
 }

print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
?>
<?php
// on recupere le mail pour envoyer un lien de reinitialisation de password
require_once('includes_session.php');
$CSession = new CSession();
$user_exist = $CSession->user_exist();
$CInscription = new CInscription();
$CPrint = new CPrint();

require_once('head.php');
require_once('header.php');
print('<div id="main">');

if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$CPrint->content('Erreur vérification user :'.$user_exist.'<br />Contacter le support technique');
		$msg = 'Refaite une tentative';
		$msg_lien = ' Go ';
		$lien = 'pwd_reinit.php';
	}

if ($user_exist == 'yes')
	{
		// envoyer mail avec UID etc....
		// generer uid
		$idunik = uniqid();
		$email = strip_tags($_POST['email']);
		$sujet = "Camagru confirmation de votre inscription";
		$message = "Vous venez de vous inscrire sur Camagru. Pour confirmer votre inscription veuillez cliquer sur le lien suivant : <a href = 'http://localhost:8080/camagru/login.php?id=$idunik' >je confirme mon inscription </a>"; 
		$from = "notreply@camagru42.fr";
		//$from = "dlievre@student.42.fr";
		if ($CInscription->send_email($email, $sujet, $message, $from) != "send_email") {$CPrint->content('Impossible d\'envoyer le mail de réinitialisation, contactez le support technique'); exit;}
		$CPrint->content('Vous allez recevoir un mail à l\'adresse '.strip_tags($_POST['email']).' <br />contenant un lien de réinitialisation de votre mot de passe'); 
		$msg = '';
		$lien = '';
	}

if ($user_exist == 'no')
	{
		$CPrint->content('le mail : '.$_POST['email'].' n\'existe pas dans la base'); 
		$msg = 'Refaite une tentative';
		$msg_lien = ' Go ';
		$lien = 'pwd_reinit.php';
 }

	if ($msg && $lien) $CPrint->content($msg.'<a href="'.$lien.'">'.$msg_lien.'</a></p>');

print('</div>');	
include ('footer.php');
?>
<?php
//session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$content = '';
print('<div id="main">');

$CPrint = new CPrint();

$aff_formulaire = 'yes';
if (isset($_POST['Reinit']) == TRUE)
{
	$CSession = new CSession();
	$user_exist = $CSession->user_exist();

	if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$content = 'Création impossible :'.$user_exist;
		$class_msg = 'msg_err';
		$aff_formulaire = 'yes';
	}

	if ($user_exist == 'yes')
	{
		$CInscription = new CInscription();
		$email = strip_tags($_POST['email']);
		$action = $CInscription->send_reinitialisation($email);

		if ($action == 'send email')
		{
			$content = 'Un mail de réinitialisation vient de vous être envoyé à l\'adresse '.$email;
			$class_msg = 'content';
			$aff_formulaire = 'no';
		}
		else
		{
			$class_msg = 'msg_err';
			$CPrint->content('Impossible d\'envoyer le mail de réinitialisation, contactez le support technique', $class_msg);
			$aff_formulaire = 'yes';
			exit;
		}

		
		/*$aff_formulaire = 'no';
		// envoyer le mail de reinit
				// envoyer mail avec UID etc....
				// generer uid
		$idunik = uniqid();
		$email = strip_tags($_POST['email']);
		$sujet = "Camagru réinitialisation de votre mot de passe";
		$message = "Vous venez de vous inscrire sur Camagru. Pour confirmer votre inscription veuillez cliquer sur le lien suivant : <a href = 'http://localhost:8080/camagru/pwd_reinit_chk.php?id=$idunik' >je confirme mon inscription </a>"; 
		$from = "notreply@camagru42.fr";
		$from = "dlievre@student.42.fr";
		//$from = "te42pe@gmail.com";
		$CInscription = new CInscription();
		$action = $CInscription->send_email($email, $sujet, $message, $from);
		if ($action == 'send email')
		{
			$content = 'Un mail de réinitialisation vient de vous être envoyé à l\'adresse '.$email;
		}
		else
		{
			$CPrint->content('Impossible d\'envoyer le mail de réinitialisation, contactez le support technique', 'msg_err');
			exit;
		}*/
	}


}

if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' )
{
	$TabForm = array();

	$CForm = new CForm;
	$TabForm[] = $CForm->Form('pwd_reinit.php', 'Form', 'POST');
	$TabForm[] = $CForm->InputLabel("Votre Mail ", "LabelMail", "LabelMail");
	$TabForm[] = $CForm->InputMail("Votre Mail ", "email", $_POST['email']);
	$TabForm[] = $CForm->Submit("Réinitialisation", "Reinit");

	$CPrint = new CPrint();

	$CPrint->Form('Réinitialisation Mot de passe', $TabForm);
	$CPrint->content("Renseignez votre email, pour recevoir un lien de réinitialisation", 'content');
	//var_dump($TabForm);
}

?>
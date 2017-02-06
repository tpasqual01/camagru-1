<?php
// on recupere le mail pour envoyer un lien de reinitialisation de password
require_once('includes_session.php');
$CPrint = new CPrint();
$CPrint->content(' key '.$_GET['key'], 'content');
// on recherche l'utilisateur de cette key, puis on demande la question secrete

if (!$_GET['key']) 
	{
		exit;
	}
else
	{

		require_once('head.php');
		require_once('header.php');
		print('<div id="main">');
		$CPrint->content('Vous avez demandé la réinitialisation de votre mot de passe<br /> ', 'content');
		$CPrint->content('Complétez les informations ci-dessous pour valider votre demande<br /> ', 'content');

		/*$CSession = new CSession();
		$user_exist = $CSession->user_exist();
		$CInscription = new CInscription();
		$CPrint = new CPrint();*/


if ( $aff_formulaire == 'yes' or 1 == 1)
{
$TabForm = array();
$login = new CForm;
$TabForm[] = $login->Form('pwd_reinit_chk.php', 'Form', 'POST');
$TabForm[] = $login->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $login->InputMail("Votre Mail", "email", $_POST['email']);
$TabForm[] = $login->InputLabel("Votre nouveau Password", "LabelPassword", "LabelPassword"); // InputLabel($labelTitre, $id, $labelFor)
$TabForm[] = $login->InputPassword("Password", "Password", ''); // InputPassword($Titre, $id)
$TabForm[] = $login->InputLabel("Confirmez le Password", "LabelPasswordbis", "LabelPasswordbis");
$TabForm[] = $login->InputPassword("Passwordbis", "Passwordbis", '');
$TabForm[] = $login->Submit("Envoyer", "Envoyer");

$CPrint->Form('Login', $TabForm);
//$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>', 'lien');
}









print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
}
?>
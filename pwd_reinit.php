<?php
//session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

print('<div id="main">');

$CPrint = new CPrint();

$aff_formulaire = 'yes';
if (isset($_POST['Reinit']) == TRUE)
{
	$CSession = new CSession();
	$user_exist = $CSession->user_exist();
//$CInscription = new CInscription();

	if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$content = 'Création impossible :'.$user_exist;
		$aff_formulaire = 'yes';
	}

	if ($user_exist == 'yes')
	{
		$content = 'Vous allez recevoir un mail contenant un lien de réinitialisation'; 
		$aff_formulaire = 'no';
	}

	if ($user_exist == 'no')
	{
		$content = 'le mail : '.$_POST['email'].' n\'existe pas dans la base'; 
		$aff_formulaire = 'yes';
	}

}

if ($content) $CPrint->content($content);

if ( $aff_formulaire == 'yes' )
{
	$TabForm = array();

	$CForm = new CForm;
	$TabForm[] = $CForm->Form('pwd_reinit.php', 'Form', 'POST');
	$TabForm[] = $CForm->InputLabel("Mail ", "Votre Mail", "Mail");
	$TabForm[] = $CForm->InputMail("Votre Mail ", "email", $_POST['email']);
	$TabForm[] = $CForm->Submit("Réinitialisation", "Reinit");

	$CPrint = new CPrint();

	$CPrint->Form('Réinitialisation Mot de passe', $TabForm);
	$CPrint->content("Renseignez votre email, pour recevoir un lien de réinitialisation");
	//var_dump($TabForm);
}

?>
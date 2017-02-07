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
		$class_msg = 'content';
		$content = 'Vous avez demandé la réinitialisation de votre mot de passe<br /> ';
		$content .= 'Complétez les informations ci-dessous pour valider votre demande<br /> ';

		/*$CSession = new CSession();
		$user_exist = $CSession->user_exist();
		$CInscription = new CInscription();
		$CPrint = new CPrint();*/

$CPrint->Titre('Réinitialisation du Mot de passe', $class_msg);
if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' or 1 == 1)
	{
		$CForm = new CForm;

		$TabForm = array();
		$login = new CForm;
		$TabForm[] = $CForm->Form('pwd_reinit_chk.php', 'Form', 'POST');
		$TabForm[] = $CForm->InputLabel("Mail", "Votre Mail", "Mail");
		$TabForm[] = $CForm->InputMail("Votre Mail", "email", $_POST['email']);
// aller recuperer la question secrete de ce user et l'afficher
		$Tabquestion[] = "Le nom de votre chien";

		$TabForm[] = $CForm->InputLabel("Question secrète", "LabelQuestion", "Notused");
		$TabForm[] = $CForm->InputSelect("Question secrète ", "Question", $Tabquestion, '0');
		$TabForm[] = $CForm->InputLabel("Réponse", "LabelReponse", "Notused");
		$TabForm[] = $CForm->InputText("Reponse", "Reponse", $_POST['Reponse']);

		$TabForm[] = $CForm->InputLabel("Votre nouveau Password", "LabelPassword", "LabelPassword"); // InputLabel($labelTitre, $id, $labelFor)
		$TabForm[] = $CForm->InputPassword("Password", "Password", ''); // InputPassword($Titre, $id)
		$TabForm[] = $CForm->InputLabel("Confirmez le Password", "LabelPasswordbis", "LabelPasswordbis");
		$TabForm[] = $CForm->InputPassword("Passwordbis", "Passwordbis", '');
		$TabForm[] = $CForm->Submit("Envoyer", "Envoyer");

		$CPrint->Form('', $TabForm);
		//$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>', 'lien');
}









print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
}
?>
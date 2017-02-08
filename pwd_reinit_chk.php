<?php
// on recupere le mail pour envoyer un lien de reinitialisation de password
require_once('includes_session.php');
$CPrint = new CPrint();
$CForm = new CForm;
$CSession = new CSession();

$aff_formulaire = 'yes';

$CPrint->content(' key '.$_GET['key'], 'content');
if (!$_GET['key'] and !$_SESSION['key']) exit;
//if exist($_GET['key']) print 'check en cours';// a faire pour s'assurer que la cle existe pour reinitialiser
// on doit passer par une session pour gerer ensuite le formulaire car on perd le get key
if ($_GET['key']) $_SESSION['key'] = $_GET['key']; // uniquement si la key est valide , a finir 

require_once('head.php');
require_once('header.php');
print('<div id="main">');

// on recherche l'utilisateur de cette key, puis on demande la question secrete
if ($CSession->userkey_exist($_SESSION['key']) == 'no') 
	{
		print 'erreur key not exist : '. $_SESSION['key'];
		exit;
	}
else
{

		if (isset($_POST['Envoyer']) == TRUE) // controle des champs
		{
			$TabFormChk["email"] = "Votre Mail";
			$TabFormChk["Password"] = "Password";
			$TabFormChk["Passwordbis"] = "Confirmez le Password";
			$TabFormChk["Reponse"] = "Réponse";

			$error_field = $CForm->InputTextChk($TabFormChk);	
		}

		$class_msg = 'content';
		$content = 'Vous avez demandé la réinitialisation de votre mot de passe<br /> ';
		$content .= 'Complétez les informations ci-dessous pour valider votre demande<br /> ';

if (isset($_POST['Envoyer']) == TRUE and !$error_field )
	{
		print 'controle<br />'; 
		// on check la key et le mail, la reponse 
		print $_POST['email'].'>>>';
		$tbl_info_user = $CSession->user_info($_POST['email'], 'email');
print_r($tbl_info_user);print '...<br />';
print $tbl_info_user['email'] .' '. $_POST['email'] .'<br/> '. $tbl_info_user['Questionsecrete'] .' '. $_POST['Questionsecrete'] .'<br/> '. $tbl_info_user['Reponsesecrete'] .'  '. $_POST['Reponsesecrete']; print ':::<br />';
		if ($tbl_info_user['email'] == $_POST['email'] and $tbl_info_user['Questionsecrete'] == $_POST['Questionsecrete'] and $tbl_info_user['Reponsesecrete'] == $_POST['Reponsesecrete']) { print 'update base';}
		else
			{ print 'erreur !!!!';}

		/*$CSession = new CSession();
		$user_exist = $CSession->user_exist();
		$CInscription = new CInscription();
		$CPrint = new CPrint();*/
	}

$CPrint->Titre('Réinitialisation du Mot de passe', $class_msg);
if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes')
	{
		$TabForm = array();
		$TabForm[] = $CForm->Form('pwd_reinit_chk.php', 'Form', 'POST');
		$TabForm[] = $CForm->InputLabel("Mail", "Votre Mail * ", "Mail");
		$TabForm[] = $CForm->InputMail("Votre Mail", "email", $_POST['email'], '*');
// aller recuperer la question secrete de cet user et l'afficher


		//$tbl_info_user = $CSession->user_info($email, 'email');
        $tbl_info_user = $CSession->user_info($_SESSION['key'], 'key');
       // ok ici  print_r($tbl_info_user);
        $Questionsecrete = $tbl_info_user['Questionsecrete'];
        
		//$Tabquestion[] = "Le nom de votre chien";

		$TabForm[] = $CForm->InputLabel("Question secrète *", "LabelQuestion", "Notused");
		$TabForm[] = $CForm->InputSelect("Question secrète ", "Question", $Tabquestion, $Questionsecrete, '*');
		$TabForm[] = $CForm->InputLabel("Réponse *", "LabelReponse", "Notused");
		$TabForm[] = $CForm->InputText("Reponse", "Reponse", $_POST['Reponse'], '*');

		$TabForm[] = $CForm->InputLabel("Votre nouveau Password * ", "LabelPassword", "LabelPassword"); // InputLabel($labelTitre, $id, $labelFor)
		$TabForm[] = $CForm->InputPassword("Password", "Password", '*'); // ($Titre, $id, $required)
		$TabForm[] = $CForm->InputLabel("Confirmez le Password * ", "LabelPasswordbis", "LabelPasswordbis");
		$TabForm[] = $CForm->InputPassword("Passwordbis", "Passwordbis", '*');
		$TabForm[] = $CForm->Submit("Envoyer", "Envoyer");

		if ($error_field) $CPrint->content($error_field, 'msg_err');

		$CPrint->Form('', $TabForm);
		//$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>', 'lien');
}

print ('<p>Continuer <a href="'.$suite.'"> Go </a></p>');

print('</div>');	
include ('footer.php');
}
?>
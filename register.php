<?php
//session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$aff_formulaire = 'yes';
if (isset($_POST['Envoyer']) == TRUE)
{
	$CSession = new CSession();
	$user_exist = $CSession->user_exist();
	$CInscription = new CInscription();
	$CPrint = new CPrint();

	if ($user_exist != 'yes' and $user_exist != 'no') 
	{ 
		$content = 'Création impossible :'.$user_exist;
		$aff_formulaire = 'yes';
		//$suite = 'index.php';
	}

	if ($user_exist == 'yes')
	{
		$content = 'Erreur : Cet utilisateur existe dans la base'; 
		$aff_formulaire = 'yes';
		//$suite = 'register.php';
	}

	if ($user_exist == 'no')
	{
		$content = 'Utilisateur à créer dans la base<br />'; 
		$action = $CSession->user_add();
	//$action = 'ok'; /////// a remettre apres validation
		if ($action == 'user_add' ) 
		{
			$content .= 'Utilisateur validé dans la base';
		//if ($CInscription->send_validation($_SESSION) == 'ok'){$print->content('send ok');}
			$content .= '<br />Un mail de validation de compte vient de vous être envoyé à '.strip_tags($_POST['email']).'<br /> pour finaliser votre inscription';
			$aff_formulaire = 'no';
			//$suite = 'index.php';
		}
		else
		{
			$content .= "Impossible de créer l'utilisateur";
			$aff_formulaire = 'no';
			//$suite = 'register.php';	
		}
	
	}
}

if ( $aff_formulaire == 'yes' )
{
	$TabForm = array();

	$inscription = new CForm;
	$TabForm[] = $inscription->Form('register.php', 'Form', 'POST');
	$TabForm[] = $inscription->InputLabel("Nom", "Votre Nom", "Notused");
	$TabForm[] = $inscription->InputText("Votre Nom", "Nom", $_POST['Nom']);
	$TabForm[] = $inscription->InputLabel("Prenom", "Votre Prénom", "Notused");
	$TabForm[] = $inscription->InputText("Votre Prénom", "Prenom", $_POST['Prenom']);
	$TabForm[] = $inscription->InputLabel("Mail", "Votre Mail", "Notused");
	$TabForm[] = $inscription->InputMail("Votre Mail", "email", $_POST['email']);
	$TabForm[] = $inscription->InputLabel("Password", "Password", "Notused");
	$TabForm[] = $inscription->InputPassword("Password", "Password");

	$Tabquestion[] = "Le nom de votre chien";
	$Tabquestion[] = "Le prènom de votre meilleur ami";
	$Tabquestion[] = "Votre nom de jeune fille";
	$Tabquestion[] = "Votre sport favori";
	$TabForm[] = $inscription->InputLabel("Question secrète", "Question secrète", "Notused");
	$TabForm[] = $inscription->InputSelect("Question secrète ", "Question", $Tabquestion, '3');
	$TabForm[] = $inscription->InputLabel("Réponse", "Réponse", "Notused");
	$TabForm[] = $inscription->InputText("Reponse", "Reponse", $_POST['Reponse']);

	$TabForm[] = $inscription->Submit("Envoyer", "Envoyer");

	print('<div id="main">');
	$CPrint = new CPrint();
	if ($content) $CPrint->content($content);
	$CPrint->Form('Inscriptions', $TabForm);
}
print('</div>');	
include ('footer.php');
?>
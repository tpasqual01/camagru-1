<?php
session_start();
require_once('includes_session.php');
$aff_formulaire = 'yes';
if (isset($_POST['Envoyer']) == TRUE)
{
$CSession = new CSession();
$user_ckeck = $CSession->user_login();

if (!$user_ckeck) header('Location: login.php');
if ($user_ckeck == 'user_login')
    {
    if ($_SESSION['valide'] == 'ok') 
        header('Location: home.php');
    exit;
    }
$class_msg = '';
if ($user_ckeck == 'user not confirmed')
    {
        $content = "Votre inscription n'est pas encore validée<br />Vous avez dû recevoir un mail pour finaliser votre inscription";
        $class_msg = 'msg_err';
        $aff_formulaire = 'no';
    }
if ($user_ckeck == 'user password bad')
    {
        $content = "Votre Mot de passe n'est pas valide<br />Vérifiez votre saisie";
        if ($CSession->ismajuscule($_POST['Password']) == 'majuscule') $content .= "<br />Vérifiez les majuscules de votre mot de passe";
        $class_msg = 'msg_err';
        $aff_formulaire = 'yes';
    }
if ($user_ckeck == 'user not exit')
    {
        $content = $_POST['email']."Votre Login n'existe pas dans la base<br />Vérifiez votre saisie";
        $class_msg = 'msg_err';
        $aff_formulaire = 'yes';
    }
}
require_once('head.php');
require_once('header.php');
print('<div id="main">');

$CPrint = new CPrint();
if ($content) $CPrint->content($content, $class_msg);

if ( $aff_formulaire == 'yes' )
{
$TabForm = array();
$login = new CForm;
$TabForm[] = $login->Form('login.php', 'Form', 'POST');
$TabForm[] = $login->InputLabel("Votre Mail", "LabelMail", "Mail");
$TabForm[] = $login->InputMail("Votre Mail", "email", $_POST['email']);
$TabForm[] = $login->InputLabel("Password", "LabelPassword", "LabelPassword");
$TabForm[] = $login->InputPassword("Password", "Password"); // InputPassword($Titre, $id)
$TabForm[] = $login->Submit("Envoyer", "Envoyer");

$CPrint->Form('Login', $TabForm);
$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>', 'lien');
$CPrint->content( 'Inscription : <a href="register.php" target="_self">S\'enregister</a>', 'lien');

}
print('</div>');
include ('footer.php');
?>
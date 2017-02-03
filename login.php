<?php
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

if ($user_ckeck == 'user not confirmed')
    {
        $content = "Votre inscription n'est pas encore validée<br />Vous avez dû recevoir un mail pour finaliser votre inscription";
        $aff_formulaire = 'no';
    }
if ($user_ckeck == 'user password bad')
    {
        $content = "Votre Mot de passe n'est pas valide<br />Vérifiez votre saisie";
        $aff_formulaire = 'yes';
    }
if ($user_ckeck == 'user not exit')
    {
        $content = "Votre Login n'existe pas dans la base<br />Vérifiez votre saisie";
        $aff_formulaire = 'yes';
    }
}
require_once('head.php');
require_once('header.php');
print('<div id="main">');

if ( $aff_formulaire == 'yes' )
{
$TabForm = array();
$login = new CForm;
$TabForm[] = $login->Form('login.php', 'Form', 'POST');
$TabForm[] = $login->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $login->InputMail("Votre Mail", "email", $_POST['email']);
$TabForm[] = $login->InputLabel("Password", "Password", "Password");
$TabForm[] = $login->InputPassword("Password", "Password");
$TabForm[] = $login->Submit("Envoyer", "Envoyer");

$CPrint = new CPrint();
if ($content) $CPrint->content($content);
$CPrint->Form('Login', $TabForm);
$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>');
$CPrint->content( 'Inscription : <a href="register.php" target="_self">S\'enregister</a>');

}
print('</div>');
include ('footer.php');
?>
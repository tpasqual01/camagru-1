<?php
//session_start();
//require_once('includes.php');
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

print ('<'.$_POST['Envoyer'].'>');

if (!isset($_POST['Envoyer']))
{
print('<div id="main">');

$TabForm = array();

$login = new CForm;
$TabForm[] = $login->Form('login.php', 'Form', 'POST');
$TabForm[] = $login->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $login->InputMail("Votre Mail", "email", $_POST['email']);
$TabForm[] = $login->InputLabel("Password", "Password", "Password");
$TabForm[] = $login->InputPassword("Password", "Password");
$TabForm[] = $login->Submit("Envoyer", "Envoyer");


$CPrint = new CPrint();

print ('<p>info</p>');

$CPrint->Form('Login', $TabForm);
$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>');
$CPrint->content( 'Inscription : <a href="register.php" target="_self">S\'enregister</a>');
//var_dump($TabForm);
}
else
{

print ('<.'.isset($_POST['Envoyer']).'.>');


$CSession = new CSession();

$user_ckeck = $CSession->user_login();

if (!$user_ckeck) header('Location: login.php');

if ($user_ckeck == 'user_login')
    {
    if ($_SESSION['valide'] == 'ok') 
        header('Location: home.php');
    exit;
    }
//require_once('head.php');
//require_once('header.php');
print('<div id="main">');

if ($user_ckeck == 'user not confirmed')
    {
        $CPrint = new CPrint();
        $CPrint->content("Votre inscription n'est pas encore validée<br />Vous avez dû recevoir un mail pour finaliser votre inscription");
        //$CInscription = new CInscription();
        //$CInscription->send_validation($email, $lignes->Prenom, $lignes->Nom, $lignes->Keyconfirm);
    }
if ($user_ckeck == 'user password bad')
    {
        $CPrint = new CPrint();
        $CPrint->content("Votre Mot de passe n'est pas valide<br />Vérifiez votre saisie");
    }
if ($user_ckeck == 'user not exit')
    {
        $CPrint = new CPrint();
        $CPrint->content("Votre Login n'existe pas dans la base<br />Vérifiez votre saisie");
    }

//print('</div>');    
//include ('footer.php');

}
print('</div>');
include ('footer.php');
?>
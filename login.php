<?php
//session_start();
require_once('includes.php');
require_once('head.php');
require_once('header.php');
print('<div id="main">');

$TabForm = array();

$login = new CForm;
$TabForm[] = $login->Form('logincheck.php', 'Form', 'POST');
$TabForm[] = $login->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $login->InputMail("Votre Mail", "email");
$TabForm[] = $login->InputLabel("Password", "Password", "Password");
$TabForm[] = $login->InputPassword("Password", "Password");
$TabForm[] = $login->Submit("Envoyer");


$CPrint = new CPrint();
$CPrint->Form('Login', $TabForm);
$CPrint->content( 'Mot de passe oublié  : <a href="pwd_reinit.php" target="_self">Réinitialisation</a>');
$CPrint->content( 'Inscription : <a href="register.php" target="_self">S\'enregister</a>');
//var_dump($TabForm);

print('</div>');
include ('footer.php');
?>
<?php
//session_start();
require_once('includes.php');
require_once('head.php');
require_once('header.php');

$TabForm = array();

$CForm = new CForm;
$TabForm[] = $CForm->Form('pwd_reinit_send.php', 'Form', 'POST');
$TabForm[] = $CForm->InputLabel("Mail", "Votre Mail", "Mail");
$TabForm[] = $CForm->InputMail("Votre Mail", "email");

$TabForm[] = $CForm->Submit("Envoyer");

print('<div id="main">');
$CPrint = new CPrint();
$CPrint->Form('Réinitialisation Mot de passe', $TabForm);
$CPrint->content("Renseignez votre email, pour recevoir un lien de réinitialisation");
//var_dump($TabForm);


?>
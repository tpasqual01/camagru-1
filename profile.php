<?php
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

if ($_SESSION['valide'] == 'ok'){
  $session_usr_exist = new CSession($_POST);
}
print ($session_usr_exist->user_exist());

print('<div id="main">');

$profile = new CSession();
$Tab = $profile->get_Profile();

$print = new CPrint();
$print->Profil_Print('Profile Utilisateur', $Tab);

print('</div>');  
include ('footer.php');
?>
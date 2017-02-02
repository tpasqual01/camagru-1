<?php
require_once('includes_session.php');


if ($_SESSION['valide'] == 'ok')
{
  $session = new CSession();
  require_once('head.php');
  require_once('header.php');
  print('<div id="main">');

  $CSession = new CSession();
  $TabProfil = $CSession->get_profile();

  $print = new CPrint();
  $print->profil('Profile Utilisateur', $TabProfil);

  print('</div>'); 
  include ('footer.php');
}
  else
{
  header('Location: index.php');
}
?>
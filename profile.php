<?php
require_once('includes_session.php');


if ($_SESSION['valide'] == 'ok')
{
  $session = new CSession();
  require_once('head.php');
  require_once('header.php');
  print('<div id="main">');

  $profile = new CSession();
  $TabProfil = $profile->get_Profile();

  $print = new CPrint();
  $print->Profil('Profile Utilisateur', $TabProfil);

  print('</div>'); 
  include ('footer.php');
}
  else
{
  header('Location: index.php');
}
?>
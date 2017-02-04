<?php
if ($_SESSION["valide"]=='ok') {
	$status = ' : Login';
	$nom = 'Nom';
		$SuperUser = $_SESSION["email"] == 'dominique@lievre.net' ? '<a href="superuser.php">SuperUser</a><br />' : '';
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>';
	print '<div id="header_user" class="header_user"><p class="header_user">'.$_SESSION["email"].$status.'<br />'.$SuperUser.'<a href="logoff.php">Log out</a>'.'<br />'.'<a href="profile.php">Profile</a>'.'<a href="profile.php">Profile</a>'.'</p></div>'.'</div>';
}
else
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>'.'<div id="header_user" class="header_user"><p class="header_user">Not Logged<br /><a href="login.php">Login</a></p></div>'.'</div>';
?>
<?php
if ($_SESSION["valide"]=='ok') {
	$status = 'Login : ';
	$nom = 'Nom';
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>'.'<div class="header_user"><p class="header_user">'.$status.$_SESSION["email"].'<br />'.'<a href="logoff.php">Log out</a>'.'<br />'.'<a href="profile.php">Profile</a>'.'</p></div>'.'</div>';
}
else
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>'.'<div class="header_user"><p>Not Logged<br /><a href="login.php">Login</a></p></div>'.'</div>';
?>
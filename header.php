<?php
if ($_SESSION["valide"]=='ok') {
	$status = 'Login : ';
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>'.'<div class="header_user"><p class="header_user">'.$status.$_SESSION["user"].'</p><img src="images/logoff.png"></div>'.'</div>';
}
else
	print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>'.'<div class="header_user"><p>Not Logged</p></div>'.'</div>';
?>
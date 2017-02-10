<?php
print '<header>';
print '<div class="header_titre"><h1>Camagru</h1>';
print '</div>';
print '<div class="header_connection">';



if ($_SESSION["valide"]=='ok') {
	$status = ' : Login';
	$nom = 'Nom';
	$SuperUser = '';
	if ($_SESSION['Superuser'] == 'yes')
		$SuperUser = '<a href="superuser.php">SuperUser</a><br />';
	
	print $_SESSION["email"].$status.'<br />';
	print $SuperUser;
	print '<a href="logoff.php">Log out</a>'.'<br />';
	print '<a href="profile.php">Profile</a>'.'<br />';
	print '<a href="index.php">Home</a>';
	print '<p id="infouser"></p>';
	//print "<script>document.getElementById('infouser').innerHTML = 'Bienvenue ".$_SESSION['Prenom']."'</script>";
	print "<script>document.getElementById('infouser').innerHTML = 'Bienvenue ";
	print $_SESSION['Prenom']."'</script>";
}
else
	print 'Not Logged<br /><a href="login.php">Login</a>';



print '</div>';
print '</header>'
?>
<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');

if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}
print('<div id="main">');
?>
<style> 
#video { border: 1px solid #000000;margin : 0;}
#canvas { border: 1px solid #000000;margin : 0;}
.btn { padding: 5px; margin: 10px;}
.fonds { margin: 10px;}
.fond { background-color: #fff;}
</style>
<video style="display:inline" width="514px" height="386" id="video"></video>
<?php

print('<canvas style="display:none" width="514px" height="386"  id="canvas"></canvas>');

print('<div class="btn"><button id="draw2" onclick="traitement.draw(\'fond01\');">Prendre une photo</button></div>');

// afficher les fonds
$dir_fonds = "fonds";
$listfond = scandir ('fonds');
$taillefond = ' width="51px" ';
print('<div class="fonds">');
$compteur = 0;
foreach ( $listfond as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		if ( ++$compteur > 9 )  { print '<br />'; $compteur = 0; }
		$id = substr($value, 0, strlen($value)-4);
		
		print '<img onclick="traitement.changefond('."'".$id."')".'" '.$taillefond.'id="'.$id.'" class="fond" src="fonds/'.$value.'"> ';
	}

}
print('</div>');
// fin des fonds
print('</div>');	
include ('footer.php');
?>
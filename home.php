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
.fond { background-color: #ddd;}
</style>
<video style="display:inline" width="514px" height="386" id="video"></video>

<?php
//print('<div class="cr1"><img class="a2" src="cam.jpg"></div>');
//print('<canvas id="canvas" class="a2"></canvas>');
print('<canvas style="display:none" width="514px" height="386"  id="canvas"></canvas>');
//print('<div class="cr1"><img class="a1" src="fonds/fond01.png"></div>');
print('<div class="btn"><button id="draw" onclick="draw();">Prendre une photo</button></div>');
print('<div class="fonds"><img width="51px" id="fond" class="fond" src="fonds/fond01.png"> ');
print('<img width="51px" id="fond" class="fond" src="fonds/fond02.png"></div>');
print('</div>');	
include ('footer.php');
?>

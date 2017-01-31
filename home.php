<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');

if ($_GET['raz']=='1') {$_SESSION = array(); session_destroy(); print '<p>Session destroye</p>';exit;}



print('<div id="main">');
?>


<style> 
div.cr1 {border: 0px solid #000000;margin : 0;text-align:left;width:512px;height:auto;overflow: hidden;}
img.a1 { position: absolute;-moz-opacity:0;filter:alpha(opacity=0);z-index: -12;width:512px;height:auto}
img.a2, canvas#canvas { position: absolute;-moz-opacity:0;filter:alpha(opacity=100);z-index: -12;width:512px;height:auto}
#video {border: 1px solid #000000;margin : 0;text-align:left;width:512px;height:auto;overflow: hidden;}
#canvas {border: 1px solid #000000;margin : 0;text-align:left;width:512px;height:auto;overflow: hidden;}
</style>
<video id="video"></video>
<button id="startbutton" onclick="takepicture();">Prendre une photo</button>
<button id="draw" onclick="draw();">Draw</button>

<?php
//print('<div class="cr1"><img class="a2" src="cam.jpg"></div>');
//print('<canvas id="canvas" class="a2"></canvas>');
print('<div class="cr1"><canvas id="canvas"></canvas></div>');
print('<div class="cr1"><img class="a1" src="fonds/fond01.png"></div>');

print('</div>');	
include ('footer.php');
?>




  // Prefer camera resolution nearest to 1280x720.
var constraints = { audio: false, video: { width: 1280, height: 720 } }; 

navigator.mediaDevices.getUserMedia(constraints)
.then(function(mediaStream)
{
  var video = document.querySelector('#video');
  video.srcObject = mediaStream;
  //var canvas = document.querySelector('#canvas');
 //alert(canvas+this.canvas.width);
  video.onloadedmetadata = function(e)
  { video.play(); };
})
.catch(function(err) { console.log(err.name + ": " + err.message); })

class Cfusion
{
  constructor(fond)
  {
    this.fond_select = fond; // this est important pour une variable de la classe et non de fonction
    //alert(' fond initial '+this.fond_select);
  }

  draw()
  {
    //alert(' fond actif : '+this.fond_select);
 
    var canvas = document.querySelector('#canvas');
    var ctx = canvas.getContext('2d');
    var canvaswidth = canvas.width;
    var canvasheight = canvas.height;
    // Draw photo
    ctx.drawImage(video, 1, 1, canvaswidth, canvasheight);
    // Draw background
    ctx.drawImage(document.getElementById(this.fond_select), 0, 0, canvaswidth, canvasheight);
    // effacer video et afficher fusion
    video.style.display = "none";
    canvas.style.display = "inline";
  }

  changefond(nom)
  {
  this.fond_select = nom;
  alert(' changement du fond : '+this.fond_select);
  }

}

const traitement = new Cfusion('fond02');


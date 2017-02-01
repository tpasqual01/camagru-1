


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


function draw() {
  //var canvas = document.getElementById('canvas');
  //var canvas = document.querySelector('#canvas');

  var canvas = document.querySelector('#canvas');

  var ctx = canvas.getContext('2d');
  canvaswidth = this.canvas.width;
  canvasheight = this.canvas.height;
  videowidth = this.video.width;
  videoheight = this.video.height;
  //var video = document.getElementById('video');
//  alert('sizev '+videowidth+' '+videoheight+'sizec '+canvaswidth+' '+canvasheight);
  // Draw photo
  ctx.drawImage(video, 1, 1, canvaswidth, canvasheight);
  // Draw background
  ctx.drawImage(document.getElementById('fond'), 1, 1, canvaswidth, canvasheight);

  video.style.display = "none";
  canvas.style.display = "inline";

}
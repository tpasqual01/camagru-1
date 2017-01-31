

  // Prefer camera resolution nearest to 1280x720.
var constraints = { audio: false, video: { width: 1280, height: 720 } }; 

navigator.mediaDevices.getUserMedia(constraints)
.then(function(mediaStream) {
  var video = document.querySelector('#video');
  video.srcObject = mediaStream;
  var photo = document.querySelector('#photo');
  //alert(canvas);
  video.onloadedmetadata = function(e) {
    video.play();
  };
})
.catch(function(err) { console.log(err.name + ": " + err.message); })

function draw() {
  var canvas = document.getElementById('canvas');
  var ctx = canvas.getContext('2d');

  // Dessine la découpe
  ctx.drawImage(document.getElementById('video'), 1, 1, 512, 124, 1, 1, 512, 104);

  // Dessine le cadre
  ctx.drawImage(document.getElementById('a1'), 2, 2);
}



  function takepicture() {

    var photo = document.querySelector('#photo');
    var video = document.querySelector('#video');
   var canvas = document.querySelector('#canvas');


//var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var image = document.getElementById("video");
var dstx = 0;
var dsty = 0;
var dLargeur = 512;

//https://developer.mozilla.org/fr/docs/Web/API/CanvasRenderingContext2D/drawImage
ctx.drawImage(image, dstx, dsty, dLargeur, 250, dstx, dsty, dLargeur, 250);

  /*	var photo = document.querySelector('#photo');
    var video = document.querySelector('#video');
    //var canvas = document.querySelector('#canvas');
      alert(canvas);
      canvas.setAttribute('width', 512);
      //photo.setAttribute('height', auto);
    canvas.drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    canvas.setAttribute('src', data);*/
  }




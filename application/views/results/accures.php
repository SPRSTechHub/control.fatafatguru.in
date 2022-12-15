<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="init();">

    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-center">
            Loader....
            <span id="ress">ss</span>
        </div>
        <input type="hidden" value="" id="actcode" />
        <div class="d-flex align-items-center justify-content-center">
            <img src="cat.png" class="image" />
            <video id="video" width="320" height="240" style="display: none;" autoplay></video>
            <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
        </div>
    </div>


    <script>
    const image = document.querySelector(".image");
    let video = document.querySelector("#video");
    let canvas = document.querySelector("#canvas");
    var stream;
    const picker = setInterval(shoot, 10000);

    function init() {
        if (!navigator.mediaDevices?.enumerateDevices) {
            console.log("enumerateDevices() not supported.");
        } else {
            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }

    function shoot() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        let image_data_url = canvas.toDataURL('image/jpeg');
        if (image_data_url != null) {
            clearInterval(picker);
            console.log('stop shooting');
            //document.querySelector("#video").style.display = "none";
            //document.querySelector("#canvas").style.display = "block";

            setTimeout(
                function() {
                    console.log(image_data_url);
                    document.querySelector("#ress").textContent = image_data_url;
                    image.src = image_data_url;
                    //  sendData(image_data_url);
                }, 5000);
        } else {
            document.querySelector("#ress").textContent = 'null';
        }
        vidOff();
    }

    function vidOff() {
        video.pause();
        video.src = "";
        navigator.getUserMedia({
                audio: false,
                video: true
            },
            function(stream) {
                var track = stream.getTracks()[0];
                track.stop();
            },
            function(error) {
                console.log('getUserMedia() error', error);
            });
    }

    /*   function sendData(data) {
          var blob = new Blob([JSON.stringify(data)]);
          var url = URL.createObjectURL(blob);
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '/push/activation/', true);
          var formData = new FormData();
          formData.append('file', blob, 'test.jpeg');
          formData.append('actv', actcode);
          xhr.onload = function(e) {
              console.log("File uploading completed!");
          };
          xhr.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var tr = JSON.parse(this.responseText);
                  if (tr.status == 0) {
                      location.replace('<?= base_url(); ?>');
                  } else {
                      alert('Server Error! Try again later.');
                  }
              }
          };
          console.log("File uploading started!");
          xhr.send(formData);
      } */
    </script>
</body>

</html>
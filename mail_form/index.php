<?php
require_once './vendor/autoload.php';

$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
->setUsername('1c0805a5bd70a7')
->setPassword('f12f1259fc288e');

$mailer = new Swift_Mailer($transport);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $image = $_POST['image'];
    $store_name = $_POST['store_name'];
    $cnic = $_POST['cnic'];
    $invoice_num = $_POST['invoice_num'];
    
    $invoice = $_FILES['invoice'];

    $attachment = Swift_Attachment::fromPath($invoice['tmp_name'])->setFilename($invoice['name']);
    $image_file = Swift_Attachment::fromPath($image)->setFilename('image.png');
    // $image_file = new Swift_Attachment($image, 'image.png', 'image/png');
    // $image_file->setEncoder(new \Swift_Mime_ContentEncoder_RawContentEncoder());

    $body = 
    "<!doctype html>
    <html lang='en'>
        <body>
            <div>
                <h1>$name</h1>
                <p>$email</p>
                <p>$phone</p>
                <p>$invoice_num</p>
                <p>$store_name</p>
                <p>$cnic</p>
                <img src='$image' width='100' />
            </div>
        </body>
    </html>
    ";
    
    $message = (new Swift_Message('Some subject'))
    ->setFrom([$email=>$name])
    ->setTo(['info@teknokrat.org'=>'Teknokrat'])
    ->setBody($body, 'text/html')
    ->attach($attachment)
    ->attach($image_file);
    
    $result = $mailer->send($message);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Email Form</title>
  </head>
  <body>
    
   
    <div class="container mt-5">
      <h1 class="text-center">Email Form</h1>
    
        <form method="POST" enctype="multipart/form-data" action="./">
            <input type="hidden" name="image" id="image">
            <div class="form-group">
                <label for="YourName">Your Name</label>
                <input type="text" class="form-control" id="name"  name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="phone">Contact No.</label>
                <input type="telnum" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="number" class="form-control" id="cnic" name="cnic">
            </div>
            <div class="form-group">
                <label for="store_name">Store Name</label>
                <input type="text" class="form-control" id="store_name" name="store_name">
            </div>
            <div class="form-group">
                <label for="invoice_num">Invoice Number</label>
                <input type="text" class="form-control" id="invoice_num" name="invoice_num">
            </div>
            <div class="form-group">
                <label for="message">Invoice Receipt</label>
                <input type="file" name="invoice" id="invoice" class="form-control">
            </div>
                <!-- Button trigger modal -->
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Capture Image
                </button>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="mt-3">
                <p class="font-weight-bold">Consent: Lipton or Supreme will use your data for future promotion or research purposes.</p>
            </div>
        </form>
    </div>
 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Capture Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <button class="btn btn-info" id="start-camera">Start Camera</button>
            </div>
            <div class="col-md-6 col-12">
                OR
                <br>
                <input type="file" id="upload_image" class="form-control">
            </div>
            <div class="col-12">
                <div class="mx-auto">
                    <video id="video" width="250" height="500" autoplay></video>
                </div>
                <div class="mt-2">
                    <button class="btn btn-warning" onclick="changeVideoOrientation()">Change Orientation</button>
                </div>
                <div class="mt-2">
                    <button class="btn btn-danger" id="click-photo">Click Photo</button>
                </div>
            </div>
        </div>
        <canvas id="canvas" width="250" height="400"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
   
   

  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let click_button = document.querySelector("#click-photo");
        let upload_image = document.querySelector("#upload_image");
        let canvas = document.querySelector("#canvas");

        var videoConstraints = { 
            video: {
                facingMode: 'environment'
            },
            audio: false 
        }

        function changeVideoOrientation(){
            var facingMode = videoConstraints.video.facingMode
            switch (facingMode){
                case 'environment':
                    videoConstraints.video.facingMode = 'user'
                    openCamera()
                    break
                case 'user':
                    videoConstraints.video.facingMode = 'environment'
                    openCamera()
                    break
            }
            
            
        }

        async function openCamera(){
            let stream = await navigator.mediaDevices.getUserMedia(videoConstraints);
            video.srcObject = stream;
        }

        if(camera_button){
            videoConstraints.video.facingMode = 'environment'
            camera_button.addEventListener('click', function() {
                openCamera()
            });
        }

        if(click_button){
            click_button.addEventListener('click', function() {
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                let image_data_url = canvas.toDataURL('image/png');
                document.querySelector('#image').value = image_data_url
                // data url of the image
            });
        }

        
        upload_image.addEventListener('change', function(e) {
            if(e.target.files) {
            let imageFile = e.target.files[0]; //here we get the image file
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onloadend = function (e) {
                var myImage = new Image(); // Creates image object
                myImage.src = e.target.result; // Assigns converted image to image object
                myImage.onload = function(ev) {
                 // Creates a contect object
                // canvas.width = myImage.width; // Assigns image's width to canvas
                // canvas.height = myImage.height; // Assigns image's height to canvas
                // myContext.drawImage(myImage,0,0); // Draws the image on canvas
                canvas.getContext('2d').drawImage(myImage, 0, 0, canvas.width, canvas.height);
                let imgData = canvas.toDataURL("image/png"); // Assigns image base64 string in jpeg format to a variable
                document.querySelector('#image').value = imgData
                }
            }
            }
        });
        
    </script>
  </body>

</html>
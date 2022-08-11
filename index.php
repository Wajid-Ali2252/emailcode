<?php
require_once './vendor/autoload.php';
session_start();

$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
->setUsername('1c0805a5bd70a7')
->setPassword('f12f1259fc288e');

$mailer = new Swift_Mailer($transport);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $_SESSION['name']=$name;
    $phone = $_POST['phone'];
    $image = $_POST['image'];
    $email = "wasilmuhammad50@gmail.com";
    $store_name = $_POST['store_name'];
    $cnic =$_POST['cnic'];
    $cnic_formator="$cnic[0]$cnic[1]$cnic[2]$cnic[3]$cnic[4]-$cnic[5]$cnic[6]$cnic[7]$cnic[8]$cnic[9]$cnic[10]$cnic[11]-$cnic[12]";
    $image_embed = Swift_Image::fromPath($image);
    $invoice_num = $_POST['invoice_num'];
    $signature = $_POST['signature'];
    

    // $invoice = $_FILES['invoice'];

    // $attachment = Swift_Attachment::fromPath($invoice['tmp_name'])->setFilename($invoice['name']);
    $image_file = Swift_Attachment::fromPath($image)->setFilename('image.png');
    // $image_file = new Swift_Attachment($image, 'image.png', 'image/png');
    // $image_file->setEncoder(new \Swift_Mime_ContentEncoder_RawContentEncoder());

    $message = (new Swift_Message('Some subject'));
    $body = 
    "<!doctype html>
    <html lang='en'>
        <head>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Sacramento&display=swap' rel='stylesheet'>
            <style>
                .signature{
                    font-family:'Sacramento', cursive;
                    font-size: 20px;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div>
                <h1>Name: $name</h1>
                <p>Phone: $phone</p>
                <p>Invoice number: $invoice_num</p>
                <p>Store name: $store_name</p>
                <p>CNIC: $cnic_formator</p>
                <p>Consent: Lipton or Supreme will use your data for future promotion or research purposes.</p>
                <p class='signature'>$signature</p>
            </div>
        </body>
    </html>
    ";
    
    
    $message->setFrom(['empact@spsolutionsbpo.com'=>'Empact'])
    ->setTo([$email=>$name])
    ->setBody($body, 'text/html')
    // ->attach($attachment)
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">

    <style>
        .signature{
            font-family:'Sacramento', cursive;
            font-size: 16px;
        }
        h1.thankyousms{
     display: flex;
    justify-content: center;
    padding: 50px 0px;
    font-size: 18px;
    text-transform: capitalize;

        }
        .message form input.gobackbtn {
    margin: 0 auto;
    width: 15%;
    display: block;
    font-size: 20px;
    padding: 10px;
    border: none;
    background-color: #343487;
    color: #fff;
    border-radius: 50px;
}
    </style>
    <title>Email Form</title>
  </head>
  
  <body>
  <?php
  if(isset($_POST['goback']))
  {
    
    session_unset();
    session_destroy();
  }
  ?>
    
 <?php 
  if(isset($_SESSION['name'])) { ?>
  <div class="message">
   <h1 class='thankyousms'>Thanks for participanting</h1>
   <form method="POST">
            <input type="submit" value="Go Back" name="goback" class="gobackbtn">
   </form> 


  </div>
 <?php }
   else
   { ?>
   <div class="container mt-5">
      <h1 class="text-center">Email Form</h1>
    
        <form method="POST" enctype="multipart/form-data" action="./" >
            <input type="hidden" name="image" id="image">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name"  name="name" placeholder="John Smith" onblur="Validation(this);" >
                <span class="text-danger" id="usererr"></span>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" onblur="Validation(this);">
                <span class="text-danger" id="emailerr"></span>
            </div>
            <div class="form-group">
                <label for="phone">Contact No.</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="03XX-XXXXXXX"  onblur="Validation(this);" >
                <span class="text-danger" id="phoneerr"></span>
            </div>
            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="tel" class="form-control" id="cnic"   name="cnic" placeholder="XXXXX-XXXXXXX-X " onblur="Validation(this);" >
                <span class="text-danger"></span>
            </div>
          <div class="form-group">
                <label for="store_name">Store Name</label>
                <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Store Name" onblur="Validation(this);">
                <span class="text-danger" id="storeerr"></span>
            </div>
            <div class="form-group">
                <label for="invoice_num">Invoice Number</label>
                <input type="text" class="form-control" id="invoice_num" name="invoice_num" placeholder="Invoice Number" onblur="Validation(this);">
                <span class="text-danger" id="invoiceerr"></span>
            </div>
            <div class="form-group">
                <label class="btn btn-warning" for="upload_image">Upload Invoice Receipt</label>
                <input type="file" placeholder="Upload invoice receipt" name="upload_image" id="upload_image" class="form-control d-none">
            </div>
            <div class="form-group">
                <label class="btn btn-info" onclick="getSignatures()" for="signature">Select Signature</label>
                <select class="form-control signature" name="signature" id="signature">
                </select>
            </div>
                <!-- Button trigger modal -->
            <div>
                <button type="button" id="start-camera" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Capture Image
                </button>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="mt-3">
                <p class="font-weight-bold">Consent: Lipton or Supreme will use your data for future promotion or research purposes.</p>
            </div>
            <div class="form-group" style="position:relative;">
                <canvas id="canvas" width="250" height="400"></canvas>
                <div class="d-none" id="delete-btn" style="position:absolute; top:0; right:0;">
                    <button type="button" onclick="removeImage()" class="btn btn-danger">&times;</button>
                </div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
   
   
<?php } ?>
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

        function getSignatures(){
            while(document.querySelector("#signature").hasChildNodes()){
                document.querySelector("#signature").removeChild(document.querySelector("#signature").firstChild)
            }
            var name = document.querySelector("#name").value;
            var phone = document.querySelector("#phone").value;
            var nameArray = name.split(" ")
            var phoneArray = phone.split("")
            var signatureOptions = []

            if(nameArray.length == 1){
                var phoneNumLength = phoneArray.length
                var last3Digits = phoneArray[phoneNumLength-3]+phoneArray[phoneNumLength-2]+phoneArray[phoneNumLength-1]
                signatureOptions.push(nameArray[0], nameArray[0]+last3Digits)
            }else{
                var commonEl = []
                var fullName = ''
                for(let i = 0; i < nameArray.length; i++){
                    for(let j = 0; j < nameArray.length; j++){
                        if(nameArray[i] == nameArray[j]){
                            signatureOptions.push(nameArray[i])
                            commonEl.push(nameArray[i])
                        }else {
                            if(i<j)
                                signatureOptions.push(nameArray[i]+nameArray[j])
                        }
                    }
                }
                if(nameArray.length > 2){
                    commonEl.map((el)=>{
                        fullName+=el
                    })
                    signatureOptions.push(fullName)
                }
            }
            signatureOptions = signatureOptions.sort((a,b)=>{
                return a.length - b.length
            })
            signatureOptions.map((el) => {
                document.querySelector("#signature").innerHTML += `<option value='${el}'>${el}</option>`
            })
        }

        function addDeleteButton(){
            document.querySelector("#delete-btn").classList.remove('d-none')
        }

        function removeImage(){
            canvas.getContext('2d').clearRect(0,0, canvas.width, canvas.height)
            document.querySelector('#image').value = null
            upload_image.value = null
            document.querySelector("#delete-btn").classList.add('d-none')
            document.querySelector("#start-camera").classList.remove("disabled")
            document.querySelector("#start-camera").setAttribute('data-toggle', 'modal')
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
                addDeleteButton()
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
                addDeleteButton()
                document.querySelector("#start-camera").classList.add("disabled")
                document.querySelector("#start-camera").setAttribute('data-toggle', '')
                }
            }
            }
        });


        // Form Validation

        function Validation(input){
             var name=document.getElementById('name').value;
             var email=document.getElementById('email').value;
             var phone=document.getElementById('phone').value;
             var cnic=document.getElementById('cnic').value;
             var store_name=document.getElementById('store_name').value;
             var invoice_num=document.getElementById('invoice_num').value;


             if(name == "")
             {
                document.getElementById('usererr').innerHTML="Plz Fill The Username *";
                return false;
             }else{
                document.getElementById('usererr').style.display="none";
             }
             
            //  if((name.length <=3) || (name.length >=20))
            //  {
            //     document.getElementById('usererr').innerHTML="Name length must be b/w 3 to 20 character *";
            //     return false;
            //  }
            //  if(isNaN(name))
            //  {
            //     document.getElementById('usererr').innerHTML="Only characters are allowed";
            //     return false;
            //  }


             if(email == "")
             {
                document.getElementById('emailerr').innerHTML="Plz Fill The Email *";
                return false;
             }else{
                document.getElementById('emailerr').style.display="none";
             }
             
            //  if(email.indexOf('@') <= 0)
            //  {
            //     document.getElementById('emailerr').innerHTML="@ is Invalid Position *";
            //     return false;  
            //  }
            //  if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-4)!='.')) 
            //  {
            //    document.getElementById('emailerr').innerHTML= ". Invalid Position *";
            //  }
             if(phone == "")
             {
                document.getElementById('phoneerr').innerHTML="Plz Fill The Phone Number *";
                 return false;
             } else if(phone.length!=11)
             {
                document.getElementById('phoneerr').innerHTML="Phone Number must be 11 digits";
                return false;
             }
             else{
                document.getElementById('phoneerr').style.display='none';
             }
            //  if(isNaN(phone))
            //  {
            //     document.getElementById('phoneerr').innerHTML="Phone Number Not Allowed Character *";
            //     return false;
            //  }
            


             if(cnic == "")
            {
                document.getElementById('cnicerr').innerHTML="Plz Fill The Cnic *";
                return false;
            }else if(cnic.length!=13)
            {
                document.getElementById('cnicerr').innerHTML="Cnic Number must be 13 digits *";
                return false;
            }else{
                document.getElementById('cnicerr').style.display="none";
            }

            if(store_name == "")
            {
                document.getElementById('storeerr').innerHTML="Plz Fill The Store Name *";
                return false;
            }else{
                document.getElementById('storeerr').style.display="none";
            }
            


            if(invoice_num == "")
            {
               document.getElementById('invoiceerr').innerHTML="Plz Fill The Invoice Number *";
               return false;
            }else{
                document.getElementById('invoiceerr').style.display="none";
            }
            

        }
      

        
    </script>
  </body>

</html>
<?php session_start() ?>

<?php 
    include 'config.php';


    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
       
        $otp_code = $_POST['otp_code'];

        if($otp = $otp_code){
            ?>
           <script>
            window.location.replace("welcome.php");
            alert("Verfication Complete, you are now signed in");
                
            </script>  
           <?php
        }else{
            ;
            ?>
             <script>
                 alert("Invalid OTP code");
           </script>
             
             <?php

         }

        }

        ?>
        <!DOCTYPE html>
<html>
<head>
    
    

    

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Verification</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">OTP Verification</p>

            
            <div class="input-group">
                <input type="text" placeholder="OTP" name="otp_code"  >
            </div>
            <div class="input-group">
                <button name="verify" class="btn" >Verify</button>
            </div>
            
            <div class="input-group">
                <button name="resend" class="btn">Resend</button>
            </div>

            <p class="login-register-text">Go <a href="index.php">back</a>.</p>
            
        </form>
    </div>
</body>
</html>
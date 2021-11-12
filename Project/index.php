<?php session_start();?>

<?php
include 'config.php';



error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: register.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		if($result){

			

                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;

                    
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='maxedbrown2111@gmail.com';
                    $mail->Password='Tryhackme123';
    
                    $mail->setFrom('maxedbrown2111@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verification code";
                    $mail->Body="<p>Dear Patron, </p> <h3>Your OTP code is ".$otp.". <br></h3>
                    <br><br>
                    <p>Best Wishes,</p>
                    <b>Computer Security Group Work</b>
                    ";
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Registration Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                            	
                                ?>
                                <script>
                                    window.location.replace('verification.php');
                                    alert("<?php echo "Login Successfully, verify email  " . $email ?>");
                                    
                                </script>
                                <?php 
                                
                            }
                }
		
	} else {
		echo "<script> alert('Incorrect Email or Password.') </script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<h1 style="color:black;font-size:30px;">Computer Security</h1>
	<p>Michael Byfield 2002052<br>Easton Walker 1704311<br>Keyon Smith
	

	

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Sign In</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>


			<div class="input-group">
				<button name="submit" class="btn">OTP Login</button> 
			</div>
			<div class="input-group">
				<button name="qrsubmit" class="btn">QR Login</button>
			</div>
			<p class="login-register-text">Not a member yet? <a href="register.php">Join Now</a>.</p>
		</form>
	</div>
</body>
</html>
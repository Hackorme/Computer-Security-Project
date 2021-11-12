<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (firstname, lastname, phone, username, email, password)
					VALUES ('$firstname', '$lastname', '$phone', '$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				
				echo "<script>alert('Registration Complete.')</script>";
				$firstname = "";
				$lastname = "";
				$phone = "";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Email Already Used.')</script>";
		}
		
	} else {
		echo "<script>alert('Incorrect Password.')</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	
	

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register </title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">register</p>

            
			<div class="input-group">
				<input type="text" placeholder="First Name" name="firstname" value="<?php echo $firstname; ?>" required>
			</div>

 
			<div class="input-group">
				<input type="text" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>" required>
			</div>

			<div class="input-group">
				<input type="text" placeholder="Phone Number" name="phone" value="<?php echo $phone; ?>" required>
			</div>

			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>

			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>

            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Already have an account? <a href="index.php">Sign In Here</a>.</p>
		</form>
	</div>
</body>
</html>
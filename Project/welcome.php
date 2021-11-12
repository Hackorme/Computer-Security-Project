<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: verification.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
     
    <link rel="stylesheet" type="text/css" href="style.css">

   
    <title>Welcome</title>
</head>
<body>
	<div class="container">
		<?php echo "<h1>Welcome </h1>"; ?>
    <a href="logout.php">Logout</a>
	</div>
    
</body>
</html>
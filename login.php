<?php

require 'config.php';
session_start();

if(isset($_POST['submit'])) {

$user = $_POST['email'];
$pass = $_POST['password'];

$user = htmlspecialchars($user);
$pass=htmlspecialchars($pass);

if(empty($user) || empty($pass)) {
$message = 'All field are required';
} else {

$query = $pdo->prepare("SELECT * FROM Users WHERE email=? ");
$query->execute(array($user));
$row = $query->rowCount();

if( $row> 0)
{
	$fetch = $query->fetch();
	$verifyStatus=password_verify($pass,$fetch['password']);
	if($verifyStatus) {
	
	$_SESSION["email"] = $_POST["email"]; 
	$_SESSION["username"] = $fetch['username']; 
	$_SESSION["id"] = $fetch['id']; 
	 header('location:buyer.php');
	}
	 else {
	 echo '<script>alert("wrong password") </script>';
	}
}
else{

	echo '<script>alert("wrong email or password") </script>';
}



}

}
?>
 

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/loginStyle.css" rel="stylesheet">
</head>
<body class="bg-dark">
 
<div class="container h-100">
	<img src="img/user.png">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto" >Login</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
			<form  method="POST" action="<?php  htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
				<div class="form-group">
					
					<input type="text" name="email" placeholder="Enter Email" class="input_box">
				</div>
				<div class="form-group">
				
					<input type="password" name="password" placeholder="Enter Password"id="password" class="input_box">
					<span class="toggle-password" onclick="togglePassword()"> Show </span>
				</div>
 
				<button type="submit" name="submit" class="btn btn-primary">Sign In <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
				<a href="#"> <p>Reset your password</p></a> 
				<hr> 

				
			</form>

			<p class="or">OR</p>
				<a href="registration.php"> <button class="registar">Create new account</button></a> 
		</div>
		 
	
	</div>

</div>
<script src="js/validation.js"></script>
</body>
</html>
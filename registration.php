<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
   <link href="css/signupStyle.css" rel="stylesheet">
</head>
<body>
   <?php
   include 'C:\xampp\htdocs\Binary service\config.php';
   if(isset($_POST['submit']))
   {
   $username=$_POST['username'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $cpassword=$_POST['cpassword'];

   $username = htmlspecialchars($username);
   $email=htmlspecialchars($email);

   $pass= password_hash($password, PASSWORD_BCRYPT);
   $cpass= password_hash($cpassword, PASSWORD_BCRYPT);
   
   $emailQuery = $pdo->prepare("SELECT email FROM Users WHERE email=?");
   $emailQuery->execute(array($email));
   $row = $emailQuery->fetch(PDO::FETCH_BOTH);
   if($row>0)
   {
      echo '<script>alert("This email is already exist") </script>';
   }
   else
   {
      if($password===$cpassword)
      {
        $sql = "INSERT INTO Users (username, email, password,cpassword) VALUES (?,?,?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$username, $email, $pass,$cpass]);
      $_SESSION['name']=$username;
     //header(location:/Binary service/login.php")
      echo "<script type='text/javascript'>alert('Lead added successfully');location='login.php';</script>";
      }
      else
      {
        
      
 
  echo '<script>alert("password not matching") </script>';
        
      }
   }

   }
   ?>

<div class="formContainer">
<form  method="POST" action="<?php  htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST" >
<h1>Sign Up Form</h1>

<div class="text_field">
   <label for="username"><b>Username</b></label>
   <input type="text" placeholder="Enter username" name="username" id="username" required>
   
</div>

<div class="text_field">
   <label for="email"><b>Email</b></label> 
   <input type="text" placeholder="Enter Email" name="email" id="email" required>
   
</div>

<div class="text_field">
   <label for="password"><b>Password</b></label>
   <input type="password" placeholder="Enter Password" name="password" id="password" required>
   <span class="toggle-password" onclick="togglePassword()">Show</span>
</div>


<div class="text_field">
   <label for="cpassword"><b>Repeat Password</b></label>
   <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" required>  
</div>


<label>
<input type="checkbox" checked="checked" name="remember" style="marginbottom: 15px"> Remember me
</label>
<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a><p>
<div class="signupField">
<button type="submit" class="signup" name="submit" onclick="validateForm()">Sign Up</button>
<p class="para">Have an account? <a href="login.php" style="color:dodgerblue">Login</a></p>
</div>


</form>

<script src="js/validation.js"></script>

</body>
</html>
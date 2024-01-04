<?php
session_start();


    $error=array();
    if (isset($_FILES['fileUp'])) {
        
        $file_name=$_FILES['fileUp']['name'];
        $file_size=$_FILES['fileUp']['size'];
        $file_temp=$_FILES['fileUp']['tmp_name'];
        $file_type=$_FILES['fileUp']['type'];
        $file_ext=end(explode('.', $file_name));
        $extention=array("jpeg","jpg","png","JPEG","JPG","PNG");
        if(in_array($file_ext, $extention)===false)
        {
            $error[]="This extension is not allowed, choose a jpg or png file";
        }

        if(empty($error)==true)
        {
            move_uploaded_file($file_temp, "upload/".$file_name);
        }
        else
        {
            print_r($error);
            die();
        }
        
 
    }
        


 require 'C:\xampp\htdocs\Binary service\config.php';
  $title=$_POST['title'];
   $des=$_POST['des'];
   $cat=$_POST['category'];
  

   $title = htmlspecialchars($title);
   $des=htmlspecialchars($des);
   $cat = htmlspecialchars($cat);
   $date=date("d M,Y");
$seller_name;
$seller_email;

   if(empty($_SESSION['username']))
{
    header('location:login.php');
}
else
{
$seller_name=$_SESSION['username'];
$seller_email=$_SESSION['email'];
}
   $seller_name = $_SESSION["username"];
   echo "$seller_name";

$st = $pdo->query("SELECT * FROM catagory where catagory='$cat'");
$row = $st->fetch();
$id=$row['id'];

$st2 = $pdo->query("SELECT * FROM Users where email='$seller_email'");
$row2 = $st2->fetch();
$seller_id=$row2['id'];

      $sql = "INSERT INTO post (title, description,category_id,post_date,seller_id,image) VALUES (?,?,?,?,?,?)";
      $stmt= $pdo->prepare($sql);
     $status= $stmt->execute([$title, $des, $id,$date,$seller_id,$file_name]);
     $st3 = $pdo->query("update catagory set post=post+1 where id='$id'");

 if ($status)
 {
     
header("location:seller.php");
 }  
             
 else  
 {
     echo '<script>alert("query failed") </script>';
 }

?>
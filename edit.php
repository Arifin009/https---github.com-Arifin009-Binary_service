<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
      <!-- 
  //////////////////////////////////////////////////////

  Website:    http://Binary service.com/
  Email:      2020-2-60-086@std.ewubd.edu

  //////////////////////////////////////////////////////
   -->
    <link rel="stylesheet" href="css/editStyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<?php 
require 'C:\xampp\htdocs\Binary service\config.php';
session_start();
 
 if(empty($_SESSION['email']))
{
  header('location:login.php');
}


$id= $_GET['id'];
            $stmt = $pdo->query("SELECT * FROM post where id='$id'");
$post=$stmt->fetch();

?>
 <div class="wrapper">
      <h2>Edit your list</h2></a>
      <div class="content">
        <div class="container">
           <form method="POST" action="save_edit_file.php" enctype="multipart/form-data" autocomplete="off" >
              <input type="hidden" name="post_id"  class="form-control" value="<?php echo $post['id']; ?>" placeholder="">

            <label>Title</label>
            <input placeholder="" type="text" name="title" value="<?php echo $post['title'];?>">
            <label>Description</label>
            <textarea placeholder="" type="text" name="des"  ><?php echo $post['description'];?></textarea>
            <label>Category</label> 
            <select name="category">
              <option disabled>Select catagoris</option>
              <?php

              
$stmt = $pdo->query("SELECT * FROM catagory");
$cat=$stmt->fetchAll(PDO::FETCH_ASSOC);

if($cat)
   {

    foreach($cat as $c){
         if($c['id']== $post['category_id'])
         {
            echo $cat['id'];
            $selected="selected";
         }
         else
         {
            $selected="";
         }

    echo"<option {$selected}>  {$c['catagory']} </option>";
  }
   }
  

              ?>
            
            </select>
            <input type="file" name="fileUp" >
             <img  src="upload/<?php echo $post['image']; ?>" height="130px">
                <input type="hidden" name="old_image" value="<?php echo $post['image']; ?>">
            <input type="submit" name value="Submit">

            
          </form>
        </div>
      </div>
    </div>
</body>
</html>

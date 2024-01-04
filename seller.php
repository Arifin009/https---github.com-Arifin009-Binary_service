<?php
 session_start();
 
 if(empty($_SESSION['email']))
{
  header('location:login.php');
}
else
{
$username=$_SESSION['username'];
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Seller</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- 
  //////////////////////////////////////////////////////

  Website:    http://Binary service.com/
  Email:      2020-2-60-086@std.ewubd.edu

  //////////////////////////////////////////////////////
   -->
 
<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
  
 <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Animate.css -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="css/icomoon.css"> 
  <!-- Theme style  -->

 <link rel="stylesheet" href="css/sellerStyle.css">

</head>
<body>
<div class="fh5co-loader"></div>
  
  <div id="page">
  <nav class="fh5co-nav" role="navigation">
    <div class="top-menu">
      <div class="container">
        <div class="row">
          <div class="col-xs-2">
            <div id="fh5co-logo"><a href="seller.php">Binary Service </a></div>
          </div>
          <div class="col-xs-7 text-center menu-1">
            <ul>
              <li><a href="seller.php">Dashboard</a></li>
              <li class="has-dropdown">
                <a href=" #fh5co-features">My Business</a>
                <ul class="dropdown">
                  <li><a href="#">Orders</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">earnings</a></li>
                  <li><a href="chatHistory.php">history</a></li>
                </ul>
              </li>
              <li><a href="#fh5co-footer">Growth</a></li>
            </ul> 
          </div>
              
              <div class="col-xs-3 text-right menu-1 ">
            <ul>
               
              
              <li class="has-dropdown" ><a><img src="img/icon.JPEG"><a><?php echo $username ?></a>
                <ul class="dropdown">
                  <li><a href="profile.php">profile</a></li>
                  <li><a href="buyer.php">Switch to Buyer</a></li>
                  <li><a href="#">Request a post</a></li>
                  <li><a href="#">Setting</a></li>
                  <li><a href="chatHistory.php">history</a></li>
                  <li><a href="logout.php">logout</a></li>
                </ul>
              </li>
               
            </ul>
          </div>
               
        </div>
        
      </div>
    </div>
  </nav>

<?php

?>
   
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="#divone">add post</a>
              </div>
              <div class="col-md-12">


                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
           </thead>

                      <tbody>
                      <?php 
                     
                      require 'C:\xampp\htdocs\Binary service\config.php';
$seller_email=$_SESSION['email'];
 $st3 = $pdo->query("SELECT * FROM Users where email='$seller_email'");
$row3 = $st3->fetch();
$seller_id=$row3['id'];




  $st = $pdo->query("SELECT * FROM post where seller_id='$seller_id'");


  
                               
                              
                      $cnt=0;         


        while ($row = $st->fetch())  
                               { 
$cnt++;
$post_id=$row['id'];
$post_title=$row['title'];
$post_des=$row['description'];
$post_date=$row['post_date'];
$username=$_SESSION['username'];
$cat_id=$row['category_id'];

$st2 = $pdo->query("SELECT catagory FROM catagory where id='$cat_id'");
$row2=$st2->fetch();
$cat_name=$row2['catagory'];
                                ?>

                                 
                          <tr class="delete_row_<?php echo $row['id'];?>">

                              <td class='id'> <?php echo "$cnt"?></td>
                              <td><?php echo "$post_title"?></td>
                              <td><?php echo "$cat_name"?></td>
                              <td><?php echo "$post_date"?></td>
                              <td><?php echo "$username"?></td>
                            
                            <td class='edit'><a href='edit.php?id=<?php echo $row['id']; ?>'> <button style='font-size:24px'> Edit<i class='far fa-edit'></i></button></a></td>
                             <td class='delete'>
                              <a href='#' id="delete_button<?php echo $row['id'];?>" onclick="delete_row('<?php echo $row['id'];?>');">  <button style='font-size:24px'>Delete<i class='fas fa-trash-alt'></i></button> </a>
                            
                              </td>
                          </tr>
                          <?php
                         }
                         
                         ?>
                      </tbody>
                  </table>
                 
               
              </div>
          </div>
      </div>
  </div>

  <div class="overlay" id="divone">
 <div class="wrapper">
      <h2>Make your list</h2><a class="close" href="#">&times;</a>
      <div class="content">
        <div class="container">
           <form method="POST" action="save.php" enctype="multipart/form-data" >
            <label>Title</label>
            <input placeholder="title.." type="text" name="title">
            <label>Description</label>
            <textarea placeholder="Write something.." type="text" name="des"></textarea>
            <label>Category</label> 
            <select name="category">
              <option disabled>Select catagoris</option>
              <?php
              require 'C:\xampp\htdocs\Binary service\config.php';
$stmt = $pdo->query("SELECT * FROM catagory");
$cat=$stmt->fetchAll(PDO::FETCH_ASSOC);

if($cat)
   {
    foreach($cat as $c)
     
    echo"<option>{$c['catagory']} </option>";
   }
  

              ?>
            
            </select>
            <input type="file" name="fileUp" required></textarea>
            <input type="submit" name value="Submit">

            
          </form>
        </div>
      </div>
    </div>
 
</div>

 </div>


      <div class="row copyright">
        <div class="col-md-12 text-center">
          <p>
            <small class="block">&copy; 2023. All Rights Reserved.</small> 
            <small class="block">Designed by <a href="#" target="_blank">Farhan & Arifin</a> 
          </p>
          <p>
            <ul class="fh5co-social-icons">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-linkedin"></i></a></li>
              <li><a href="#"><i class="icon-dribbble"></i></a></li>
            </ul>
          </p>
        </div>
      </div>

    </div>
  </footer>
  </div>
  <script type="text/javascript">
    function delete_row(id) {
        var lnk = "http://localhost/Binary%20service/delete.php";
        if (confirm("Are you sure you want to delete this Record?")) {
            $.ajax({
                type: 'post',
                url: lnk,
                data: {
                    delete_row: 'delete_row',
                    row_id: id
                },
                success: function(data) {
                    $(".delete_row_" + id).remove();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any AJAX errors
                }
            });
        }
    }
</script>
  
 <!-- jQuery -->
 <script src="js/jquery.min.js"></script>
  <!-- Waypoints -->
  <script src="js/jquery.waypoints.min.js"></script>
  <!-- Flexslider -->
  <script src="js/jquery.flexslider-min.js"></script>
  <!-- Main -->
  <script src="js/main.js"></script>
</body>
</html>
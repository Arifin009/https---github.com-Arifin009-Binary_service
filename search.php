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
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Buyer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 

	<!-- 
	//////////////////////////////////////////////////////

	Website: 		http://Binary service.com/
	Email: 			2020-2-60-086@std.ewubd.edu

	//////////////////////////////////////////////////////
	 -->

   
	<!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">	 -->
	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	 
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/buyerStyle.css">

	</head>
	<body>
		
	<div class="fh5co-loader"></div>

	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="buyer.php">Binary Service </a></div>
					</div>

					<div class="col-xs-7">
						<form action="search.php" method="GET">
        					<input type="text" name="text" placeholder="Search...">
       						 <button type="submit" name="search">Search</button>
     					</form>
					</div>
					<div class="col-xs-3 text-right menu-1 ">
						<ul>
							 
							 
							<li class="has-dropdown" ><img src="img/icon.jpeg"><a><?php echo $username ?></a>
								<ul class="dropdown">
									<li><a href="#">profile</a></li>
									<li><a href="seller.php">Swtich to selling</a></li>
									<li><a href="#">Setting</a></li>
									<li><a href="logout.php">logout</a></li>
								</ul>
							</li>
							 
						</ul>
					</div>

				</div>
				
			</div>
		</div>
	</nav>

		 


<nav class="fh5co-cata" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					 
					<div class="col-xs-12 text-left menu-1">
						<ul>
							<li class="has-dropdown">
								<a href=" #fh5co-features">Worker</a>
								<ul class="dropdown">
									<li><a href="#">Electritian</a></li>
									<li><a href="#">Macanicc</a></li>
									<li><a href="#">plumber</a></li>
									<li><a href="#">Delevery man</a></li>
								</ul>
							</li>

							<li class="has-dropdown">
								<a href=" #fh5co-features">Teacher</a>
								<ul class="dropdown">
									<li><a href="#">Bangla</a></li>
									<li><a href="#">English</a></li>
									<li><a href="#">Math</a></li>
									<li><a href="#">Science</a></li>
									<li><a href="#">BGS</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href=" #fh5co-features">Home-Care</a>
								<ul class="dropdown">
									<li><a href="#">Child Care</a></li>
									<li><a href="#">House care</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href=" #fh5co-features">Rent</a>
								<ul class="dropdown">
									<li><a href="#">Bachlor Rent</a></li>
									<li><a href="#">Family Rent</a></li>
									<li><a href="#">commercial Rent</a></li>
								</ul>
							</li>

							<li class="has-dropdown">
								<a href=" #fh5co-features">Home Foods</a>
								<ul class="dropdown">
									<li><a href="#">Quick food</a></li>
									<li><a href="#">Event food</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	 

	<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner">
		<div class="overlay"></div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                    	<?php
                    	if (isset($_GET['search'])) {
                    	$text=$_GET['text'];
                    	
                    	$limit = 3;
                        if(isset($_GET['page'])){
                          $page = $_GET['page'];
                        }else{
                          $page = 1;
                        }
                        $offset = ($page - 1) * $limit;

	require 'C:\xampp\htdocs\Binary service\config.php';

	

	$st= $pdo->query("SELECT * FROM post where title LIKE  '%{$text}%' or description LIKE  '%{$text}%'  LIMIT {$offset},{$limit}");
	
		
	


 while ($row = $st->fetch())  {
                                
                               	$seller_id=$row['seller_id'];
    	$st2 = $pdo->query("SELECT username FROM Users where id='$seller_id'");
$row2=$st2->fetch();
$name=$row2['username'];


$cat_id=$row['category_id'];
    	$st3 = $pdo->query("SELECT catagory FROM catagory where id='$cat_id' ");
$row3=$st3->fetch();
$category=$row3['catagory'];
 
	?>
                   



                                              <div class="post-content">
 
                            <div class="row">
                                <div class="col-md-4">
                                  <a class="post-img" href="single.php?id=42"><img src="upload/<?php echo $row['image']?>" alt=""/></a>
                                </div>


                                <div class="col-md-8">
                                  <div class="inner-content clearfix">
                                      <h3><a href='single.php?id=42'><?php echo $row['title']?> </a></h3>
                                      <div class="post-information">
                                          <span>
                                              <i class="fa fa-tags" aria-hidden="true"></i>
                                              <a href='category.php?cid=31'><?php echo $category?></a>
                                          </span>
                                          <span>
                                              <i class="fa fa-user" aria-hidden="true"></i>
                                              <a href='author.php?aid=27'><?php echo $name?></a>
                                          </span>
                                          <span>
                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                              <?php echo $row['post_date']?>                                         </span>
                                      </div>
                                      <p class="description">
                                          <?php echo $row['description']?>...                                      </p>
                                      <a class='read-more pull-right' href='single.php?id=42'>contact me</a>
                                  </div>
									
                                </div>
                            </div>
                            
                        </div>
                              <?php 
									}
									
								
                                }

                             
                       $st= $pdo->query("SELECT * FROM post") or die("Query Failed.");

                        if($st->rowCount() > 0){

                          $total_records = $st->rowCount();

                          $total_page = ceil($total_records / $limit);

                          echo '<ul class="pagination admin-pagination">';
                          if($page > 1){
                            echo '<li><a href="buyer.php?page='.($page - 1).'">Prev</a></li>';
                          }
                          for($i = 1; $i <= $total_page; $i++){
                            if($i == $page){
                              $active = "active";
                            }else{
                              $active = "";
                            }
                            echo '<li class="'.$active.'"><a href="buyer.php?page='.$i.'">'.$i.'</a></li>';
                          }
                          if($total_page > $page){
                            echo '<li><a href="buyer.php?page='.($page + 1).'">Next</a></li>';
                          }

                          echo '</ul>';
                        }
                        ?>
                                         </div>

                        	<!-- /post-container -->
                </div>

                <div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search Seller</h4>
        <form>
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Top seller</h4>
                <div class="recent-post">
            <a class="post-img" href="single.php?id=42">
                <img src="admin/upload/entertainment2.jpg" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=42">Testing Recent Post </a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=31'>Entertainment</a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    21 Jan, 2020                </span>
                <a class="read-more" href="single.php?id=42">read more</a>
            </div>
        </div>
            <div class="recent-post">
            <a class="post-img" href="single.php?id=41">
                <img src="admin/upload/business.jpg" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=41">New Salman Post</a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=32'>Politics</a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    21 Jan, 2020                </span>
                <a class="read-more" href="single.php?id=41">read more</a>
            </div>
        </div>
            <div class="recent-post">
            <a class="post-img" href="single.php?id=40">
                <img src="admin/upload/politics1.jpg" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=40">Fifth Post</a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=32'>Politics</a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    19 Jan, 2020                </span>
                <a class="read-more" href="single.php?id=40">read more</a>
            </div>
        </div>
        </div>
    <!-- /recent posts box -->


</div>
            </div>
        </div>
    </div>
			</div>
		</div>
	</header>

 

	<footer id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-4 fh5co-widget">
					<h4>Binary Service</h4>
					<p> a platform that connects clients with skilled personnel to get their  requirements done efficiently and cost-effectively. Whether you're a business owner, an entrepreneur, or an individual looking for quality services, our website will provide an easy-to-use platform where you can find and hire talented professionals from a variety of fields.</p>
				</div>
				<div class="col-md-2 col-md-push-1 fh5co-widget">
					<h4>Links</h4>
					<ul class="fh5co-footer-links">
						<li><a href="index.html">Home</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">login</a></li>
					</ul>
				</div>

				<div class="col-md-2 col-md-push-1 fh5co-widget">
					<h4>Categories</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Bachlor Rent</a></li>
						<li><a href="#">Teaching</a></li>
						<li><a href="#">Home Care</a></li>
						<li><a href="#">Legal Advice</a></li>
						<li><a href="#">Macanic</a></li>
					</ul>
				</div>

				<div class="col-md-4 col-md-push-1 fh5co-widget">
					<h4>Contact Information</h4>
					<ul class="fh5co-footer-links">
						<li>123 Rampura , <br> West rampura, 1219</li>
						<li><a href="#">+016******</a></li>
						<li><a href="#">2020-2-60@std.ewubd.edu</a></li>
						<li><a href="#">BinaryService.com</a></li>
					</ul>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2023. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="#" target="_blank">Farhan & Arifin</a> </small>
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


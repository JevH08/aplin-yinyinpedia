<?php
session_start();

$defaultLink = "rss\PP\avatar.png";
$_SESSION['cekFoto'] = 0;
$idpenjual = $_SESSION['id'];
$conn = mysqli_connect("localhost","root","","yinyinpedia");
if (isset($_SESSION['active'])){
	if ($_SESSION['tipe'] =="penjual"){
		$username = $_SESSION['active'];
		$profile = $_SESSION['profile'];
	}
	else {
		header("Location: login.php");
	}
}
else {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
	<script src="jquery.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Aviato E-Commerce Template">
  
  <meta name="author" content="Themefisher.com">

  <title>YinYinPedia | Membawa Indonesia Semakin Maju</title>

  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
  
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- animate.css -->
  <link rel="stylesheet" href="plugins/animate-css/animate.css">
  
  <!-- Revolution Slider -->
  <link rel="stylesheet" type="text/css" href="plugins/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
  <link rel="stylesheet" type="text/css" href="plugins/revolution-slider/revolution/fonts/font-awesome/css/font-awesome.css">

  <!-- REVOLUTION STYLE SHEETS -->
  <link rel="stylesheet" type="text/css" href="plugins/revolution-slider/revolution/css/settings.css">
  <link rel="stylesheet" type="text/css" href="plugins/revolution-slider/revolution/css/layers.css">
  <link rel="stylesheet" type="text/css" href="plugins/revolution-slider/revolution/css/navigation.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    #proPic{
        border-radius: 50%;
        background-color: black;
        width: 30px;
        height: 30px;
        margin-left: 41% ;
    }
    #prodPic{
        border-radius: 50%;
        background-color: black;
        width: 200px;
        height: 200px;
        margin-left: 41% auto;
    }
    #proPic1{
        border-radius: 50%;
        background-color: black;
        width: 150px;
        height: 150px;
        margin-top: 15%;
    }
    .imgProduk{
		width: 130px;
		height: 100px;
	}
	.perItem{
		margin-bottom: 4%;
	}
   </style>

</head>

<body id="body">

<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>0129- 12323-123123</span>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.php">
                        YinYinPedia
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
			<!-- Cart -->
			<ul class="top-menu text-right list-inline">
	          <!-- / Cart -->

	          <!-- Search -->
	         <!-- / Search -->
			  <li class="dropdown search dropdown-slide">
	            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong"></i> Search</a> -->
	            
	              <li><input type="search" class="form-control" placeholder="Search..."></li>
	            
	          </li><!-- / Search -->
			  
			  <li>
                <button><i class="tf-ion-ios-search-strong"></i></button><br>
			  </li>


	        </ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->


<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
	    <div class="container">
	      <div class="navbar-header">
	      	<h2 class="menu-title">Main Menu</h2>
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>

	      </div><!-- / .navbar-header -->

	      <!-- Navbar Links -->
	      <div id="navbar" class="navbar-collapse collapse text-center">
	        <ul class="nav navbar-nav">

	          <!-- Home -->
	          <li class="dropdown ">
                <a href="homepageSeller.php">Home</a>
	          </li><!-- / Home -->


	          <!-- Elements -->
	          <li class="dropdown dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"> MyShop <span class="tf-ion-ios-arrow-down"></span></a>
	            <div class="dropdown-menu">
	              <div class="row">

	                <!-- Basic -->
	                <div >
	                	<ul>
							<li class="dropdown-header">Pages</li>
							<li role="separator" class="divider"></li>
							<li><a href="tambahproduk.php">Add Product</a>
			                </li>
			                <li><a href="homepageSeller.php">List Product</a>
			                </li>
			                <li><a href="acceptOrder.php">Check Orders</a>
			                </li>
			                <li><a href="history.php">Order History</a>
			                </li>
	                	</ul>
	                </div>

	              </div><!-- / .row -->
	            </div><!-- / .dropdown-menu -->
	          </li><!-- / Elements -->


	          <!-- Pages -->
	          <li class="dropdown full-width dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="tf-ion-ios-arrow-down"></span></a>
	            <div class="dropdown-menu">
	              	<div class="row">

		                <!-- Introduction -->
		                <div class="col-sm-3 col-xs-12">
		                	<ul>
								<li class="dropdown-header">Introduction</li>
								<li role="separator" class="divider"></li>
								<li><a href="contact.html">Contact Us</a></li>
								<li><a href="about.html">About Us</a></li>
								<li><a href="404.html">404 Page</a></li>
								<li><a href="coming-soon.html">Coming Soon</a></li>
								<li><a href="faq.html">FAQ</a></li>
		                	</ul>
		                </div>

		                <!-- Contact -->
		                <div class="col-sm-3 col-xs-12">
		                	<ul>
								<li class="dropdown-header">Dashboard</li>
								<li role="separator" class="divider"></li>
								<li><a href="dashboard.html">User Interface</a></li>
								<li><a href="order.html">Orders</a></li>
								<li><a href="address.html">Address</a></li>
								<li><a href="profile-details.html">Profile Details</a></li>
		                	</ul>
		                </div>

		                <!-- Utility -->
		                <div class="col-sm-3 col-xs-12">
		                	<ul>
								<li class="dropdown-header">Utility</li>
								<li role="separator" class="divider"></li>
								<li><a href="login.php">Login Page</a></li>
								<li><a href="register.php">Register Page</a></li>
								<li><a href="forget-password.php">Forget Password</a></li>
		                	</ul>
		                </div>

		                <!-- Mega Menu -->
		                <div class="col-sm-3 col-xs-12">
		                	<a href="shop.html">
			                	<img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
		                	</a>
		                </div>
	              	</div><!-- / .row -->
	            </div><!-- / .dropdown-menu -->
	          </li><!-- / Pages -->



	          <!-- Blog -->
	          <?php 
	          		if (isset($_SESSION['active'])){
	          	 ?>
	          <!-- Blog -->
	          <li class="dropdown dropdown-slide">

	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"> <?php 	echo $username ?> <span class="tf-ion-ios-arrow-down"></span></a>
	            <ul class="dropdown-menu">
					<li><?php echo '<img id=proPic src="data:image;base64,' .  base64_encode($profile)  . '" class="img-responsiveHOME"/>'; ?></li><br>
					<li><a href="">History Transaction</a>
	                </li>
	                <li><a href="">Notification</a>
	                </li>
					<li><a href="profile-details.php">Profile Details</a>
	                </li>
	                <li><a href="editAcoountSeller.php">Setting Account</a>
	                </li>
	                <li><a href="login.php">Log Out</a>
	                </li>
	            </ul>
	          </li><!-- / Blog -->
	      	<?php ;} else {?>
	      		<li class="dropdown dropdown-slide">

	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"> User <span class="tf-ion-ios-arrow-down"></span></a>
	            <ul class="dropdown-menu">
					<li><img src="<?php echo"$defaultLink"?>" alt="Profile Picture" id="proPic"></li><br>
					<li><a href="login.php">Login</a>
	                </li>
	                <li><a href="register.php">Register</a>
	                </li>
	            </ul>
	          </li><!-- / Blog -->
	      		<?php ;} ?><!-- / Blog -->
	        </ul><!-- / .nav .navbar-nav -->

	      	</div><!--/.navbar-collapse -->
	    </div><!-- / .container -->
	</nav>
</section>
<!--Main Screen -->
<div class="page-wrapper">
    <div class="container">
        <!-- <div class="col-md-3">
	        <div class="widget widget-category">
		        <h4 class="widget-title">My Shop</h4>
    	    	<ul class="widget-category-list">
	                <li><a href="#">Order</a>
	                </li>
	                <li><a href="tambahproduk.php">Add Product</a>
	                </li>
	            </ul>
	        </div> --> <!-- End category  -->
	       <!--  <div class="widget widget-category">
		        <h4 class="widget-title">Produk</h4>
    	    	<ul class="widget-category-list">
	                <li><a href="#">Animals</a>
	                </li>
	                <li><a href="#">Landscape</a>
	                </li>
	                <li><a href="#">Portrait</a>
	                </li>
	                <li><a href="#">Wild Life</a>
	                </li>
	                <li><a href="#">Video</a>
	                </li>
	            </ul>
	        </div> --> <!-- End category  -->
        <!-- </div> -->

        <!-- Tampilan Produk -->
        <section class="user-dashboard page-wrapper" >
		  <div class="container">
		    <div class="row">
		      <div class="col-md-12">
		        <ul class="list-inline dashboard-menu text-center">
		          <li><a class="active"  href="profile-details.php">Profile Details</a></li>
		          <li><a href="#">History Transaction</a></li>
		          <li><a href="#">Notification</a></li>
		        </ul>
		        <div class="dashboard-wrapper dashboard-user-profile">
		          <div class="media">
		            <div class="pull-left text-center" href="#">
		            <?php echo '<img src="data:image;base64,' .  base64_encode($profile)  . '" id="proPic1" />'; ?>
		              <!-- <img class="media-object user-img" src="images/avater.jpg" alt="Image"> -->
		            </div>
		            <div class="media-body" id=profile_details>

		              <ul class="user-profile-list" >
		              	<?php 
		              		$q = "select * from penjual where id_penjual ='$idpenjual'";
		              		$query = mysqli_query($conn,$q);
		              		
		              		while ($row = mysqli_fetch_array($query)) {
		              			echo "<h1>$row[nama_toko]</h1>";
		              			echo "<li><span>Full Name:</span>$row[nama_penjual]</li>";
		              			echo "<li><span>Address:</span>$row[alamat_penjual]</li>";
		              			echo "<li><span>City:</span>$row[kota_penjual]</li>";
		              			echo "<li><span>Phone:</span>$row[telp_penjual]</li>";
		              			echo "<li><span>Email:</span>$row[email_penjual]</li>";
		              			echo "<li><span>Saldo:</span>Rp$row[saldo],-</li>";
		              		}
		              	?>
		              	<li ><a id=tarik class="btn btn-main btn-medium btn-round-full">Tarik</a></li>
		              	
		                <!-- <li><span>Full Name:</span>Johanna Doe</li>
		                <li><span>Address:</span>USA</li>
		                <li><span>City:</span>mail@gmail.com</li>
		                <li><span>Phone:</span>+880123123</li>
		                <li><span>Email:</span></li> -->
		              </ul>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</section>

<footer class="footer section text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="footer-menu">
					<li>
						<a href="">CONTACT</a>
					</li>
					<li>
						<a href="">SHIPPING</a>
					</li>
					<li>
						<a href="">TERMS OF SERVICE</a>
					</li>
					<li>
						<a href="">PRIVACY POLICY</a>
					</li>
				</ul>
				<p class="copyright-text">Powered by Bootstrap</p>
			</div>
		</div>
	</div>
</footer>

    <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="https://code.jquery.com/jquery-git.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Instagram Feed Js -->
    <script src="plugins/instafeed-js/instafeed.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="plugins/count-down/jquery.countdown.min.js"></script>
    <!-- Custom js -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBItRd4sQ_aXlQG_fvEzsxvuYyaWnJKETk&callback=initMap"></script>

    <script src="js/script.js"></script>
    
    <script type="text/javascript">
  		$(document).ready(function () {
      		$('#tarik').click(function () {
      			
      			$.get(
	 				"ajax.php",
	 				{
	 					mode:"tarik",
	 					username:<?php echo "'$username'"; ?>
	 				},
	 				function(data){
	 					$('#profile_details').html(data);
	 				}
	 			);
      		});
  		});
  		
  	</script>

  </body>
  </html>

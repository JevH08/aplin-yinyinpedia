<?php 
    session_start();
    $defaultLink = "resource\pictures\PP\avatar.png";
    $idUser = $_SESSION['id'];
    $profile = $_SESSION['profile'];
    $conn = mysqli_connect("localhost","root","","yinyinpedia");
    $defaultLink = "rss\PP\avatar.png";
    require_once "db.php";
    $cekfoto = $_SESSION['cekFoto'];
    if (isset($_SESSION['active']) && $_SESSION['tipe']=="penjual"){
    	$idUser = $_SESSION['id'];
    	$sql = "select * from penjual";
    	$query = mysqli_query($conn, $sql);
    	foreach ($query as $row) {
    		if ($row["id_penjual"] == $idUser) {
				$temp = explode(" ",$row['nama_penjual']);
				$fNama = "";
				$lNama = "";
				$fNama = $temp[0];
				$lNama = $temp[1];
                $username = $row["username_penjual"];
				$_SESSION['userName'] = $username;
				$kota = $row["kota_penjual"];
                $namaToko = $row['nama_toko'];
                $email = $row["email_penjual"];
                $alamat = $row["alamat_penjual"];
				$telp = $row["telp_penjual"];
				$namaToko = $row["nama_toko"];	
    		}
    	}    
	    if (isset($_POST["save"])) {
	    	$sql = "select * from penjual";
			$query = mysqli_query($conn, $sql);
			$good = 1;
	    	foreach ($query as $row) {
				if ($_POST["fName"] != "" && $_POST["lName"] != ""  && $_POST["email"] != "" && $_POST["address"] != "" && $_POST["password"] != "" && $_POST["phone"] != "" ) {
	        		if ($row['email_penjual'] == $_POST['email'] && $idUser != $row['id_penjual']) {
						$good = 0;
						$temp = explode(" ",$row['nama_penjual']);
						$fNama = "";
						$lNama = "";
						$fNama = $temp[0];
						$lNama = $temp[1];
						$username = $row["username_penjual"];
	                    $namaToko = $row['nama_penjual'];
						$_SESSION['userName'] = $username;
						$kota = $row["kota_penjual"];
						$email = $row["email_penjual"];
						$alamat = $row["alamat_penjual"];
						$telp = $row["telp_penjual"];
						echo "<script> alert('Email Kembar') </script>";
						break;
	                }
	                if ($row['nama_toko'] == $_POST['namaToko'] && $idUser != $row['id_penjual']) {
						$good = 0;
						$temp = explode(" ",$row['nama_penjual']);
						$fNama = "";
						$lNama = "";
						$fNama = $temp[0];
						$lNama = $temp[1];
	                    $username = $row["username_penjual"];
	                    $namaToko = $row['nama_penjual'];
						$_SESSION['userName'] = $username;				
						$kota = $row["kota_penjual"];
						$email = $row["email_penjual"];
						$alamat = $row["alamat_penjual"];
						$telp = $row["telp_Penjual"];
						echo "<script> alert('Nama Toko Kembar') </script>";
						break;
					}
				}
				else{
					echo "<script> alert('Input Not Valid') </script>";
				}
			}
			if($good == 1){
				$idUser = $_SESSION['id'];
	            $namaToko = $_POST['namaToko'];
				$username = $_SESSION['userName'];
				$fNama = $_POST["fName"];
				$lNama = $_POST["lName"];
				$email = $_POST["email"];
				$pass = $_POST["password"];
				$pass = md5($pass);
				$alamat = $_POST["address"];
				$city = strtolower($_POST['city']);
				$telp = $_POST["phone"];
				$sql = "update penjual set username_penjual='$username', nama_toko='$namaToko', nama_penjual='$fNama $lNama', password_penjual='$pass', email_penjual='$email', kota_penjual ='$city', alamat_penjual='$alamat', telp_penjual='$telp' where id_penjual = $idUser";
				$query = mysqli_query($conn, $sql);
				if($_FILES['imgupload']['tmp_name'] != null) {
					$profile = addslashes(file_get_contents($_FILES['imgupload']['tmp_name']));
					$sql = "update penjual set profile='{$profile}' where id_penjual = $idUser";
					$_SESSION['edit'] = 1;

				}
				$query = mysqli_query($conn, $sql);
				$_SESSION['active'] = "$username";
				$sql = "select * from penjual where id_penjual = $idUser";
				$q = mysqli_query ($conn,$sql);
				while($row = mysqli_fetch_array($q))
					$_SESSION['profile'] = $row['profile'];
				header("location:homepageSeller.php");
			}
		}
    }else{
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
    <link rel="stylesheet" href="resource/jquery-ui.min.css">
    <script src="resource/jquery-3.4.1.min.js"></script>
    <script src="resource/jquery-ui.min.js"></script>
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
    #imgupload{
    	margin-left: 41%;
    }
    #padLeft{
        margin-left : 25%;
    }
   </style>
   <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewFoto = document.getElementById("prodPic");
                    previewFoto.src = e.target.result;
                    // $("#prodPic").load{"action.php"};
                    <?php 
                    	// $_SESSION['cekFoto'] = 1;
                     ?>
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        window.onload = function () {
            var fileUpload = document.getElementById("imgupload");
            fileUpload.onchange = function () {
                readURL(this);
            }
        }
    </script>
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
    <div class="container text-center col-md-6" id="padLeft" >
        <h2>Edit Profile</h2>
        <form method="post" enctype="multipart/form-data" class="text-center" style="color: #757575;">
            <h6>Profile Image</h6>
            <div class="md-form mt-0">
                <div class="col">
					<?php 
						$sql = "select * from penjual";
    					$query = mysqli_query($conn, $sql);
    					foreach ($query as $row) {
							if ($idUser == $row['id_penjual']) {
							    echo '<img id=prodPic src="data:image;base64,' .  base64_encode($row['profile'])  . '" class="img-responsiveHOME"/>'; 
                            }
                        }
					?>
                    <br>
                    <input type="file" id="imgupload" name="imgupload" ><br>
                </div>
            </div>
            <br>
            <div class="form-group">
              <input type="text" class="form-control" name="namaToko" value="<?php echo $namaToko?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="fName" value="<?php echo $fNama?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="lName" value="<?php echo $lNama?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="username" value="<?php echo $username?>" disabled>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" value="<?php echo $email?>">
            </div>
			<div class="form-group">
				<select class="browser-default form-control custom-select" name="city">
                    <option value="Aceh" <?php if ($kota == "aceh") echo "selected"?>>Aceh</option>
                    <option value="Surabaya" <?php if ($kota == "surabaya") echo "selected"?>>Surabaya</option>
                    <option value="Surakarta" <?php if ($kota == "surakarta") echo "selected"?>>Surakarta</option>
                    <option value="Jakarta" <?php if ($kota == "jakarta") echo "selected"?>>Jakarta</option>
                    <option value="Yogyakarta" <?php if ($kota == "yogyakarta") echo "selected"?>>Yogyakarta</option>
                    <option value="Solo" <?php if ($kota == "solo") echo "selected"?>>Solo</option>
                    <option value="Banjarmasin" <?php if ($kota == "banjarmasin") echo "selected"?>>Banjarmasin</option>
                    <option value="Tangerang" <?php if ($kota == "tangerang") echo "selected"?>>Tangerang</option>
                    <option value="Bandung" <?php if ($kota == "bandung") echo "selected"?>>Bandung</option>
                    <option value="Bau Bau" <?php if ($kota == "bau bau") echo "selected"?>>Bau Bau</option>
                    <option value="Tanjung Pinang" <?php if ($kota == "tanjung pinang") echo "selected"?>>Tanjung Pinang</option>
                    <option value="Banten" <?php if ($kota == "banten") echo "selected"?>>Banten</option>
                </select> 
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="address" value="<?php echo $alamat?>">
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="phone"value="<?php echo $telp?>">
            </div>
            <button type="submit" name="save"> Save Changes </button>
        </form>
    </div>
</div>

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
    


  </body>
  </html>

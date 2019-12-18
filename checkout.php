<?php 
	session_start();
	$subtotal = 0; 
	$total = 0;
    $conn = mysqli_connect("localhost","root","","yinyinpedia");
	
    if (isset($_SESSION['active']) && $_SESSION['tipe']=="pembeli"){
    	$profile = $_SESSION['profile'];
    	$idUser = $_SESSION['id'];
    	$sql = "select * from pembeli";
    	$query = mysqli_query($conn, $sql);
    	foreach ($query as $row) {
    		if ($row["id_user"] == $idUser) {
				$temp = explode(" ",$row['nama_user']);
				$fNama = "";
				$lNama = "";
				$fNama = $temp[0];
				$lNama = $temp[1];
                $username = $row["username_user"];
				$kota = $row["kota_user"];
				$_SESSION['userName'] = $username;
                $email = $row["email_user"];
                $alamat = $row["alamat_user"];
				$telp = $row["telp_user"];	
    		}
		}
	}

	$berat = 0;
	if (isset($_SESSION['cart'])){
		foreach ($_SESSION['cart'] as $key => $value) {
			$sql = "select * from produk_detail";
			$query = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($query)) {
				if ($row['id_produk'] == $value->id){
					$bla = $row;
				}
			}
			$berat += ($value->jumlah * $bla['berat']);
		}
	}

	if(isset($_POST['placeOrder'])){
		if (isset($_SESSION['active'])){
		 if ($_POST['fullName'] == "" && $_POST['addr'] == "" && $_POST['tele'] == "" && $_POST['city'] == "" && $_POST['cardNum'] == "" && $_POST['cardCode'] == "") {
		  echo '<script> alert("There is an Empty Field")</script>';
		 }
		 else{
		  $fuName = $_POST['fullName'];
		  $alamat = $_POST['addr'];
		  $telephone = $_POST['tele'];
		  $kota = $_POST['city'];
		  $noCard = $_POST['cardNum'];
		  $kodeCard = $_POST['cardCode'];
		  $pengiriman = $_POST['delivery'];
		  $bank_partner = $_POST['bank'];
		  $transDate = date("Y/m/d");
		  $idUser = $_SESSION['id'];
		  $idBankFix = -1;
		  $idPengirimanFix = -1;
	  
		  $queryBank = "SELECT * FROM bank_partner";
		  $idBank = mysqli_query($conn, $queryBank);
		  while ($row=mysqli_fetch_array($idBank)) {
		   if ($row['nama_bank'] == $bank_partner) {
			$idBankFix = $row['id_bank'];
		   }
		  }
		  $queryPengiriman = "SELECT * FROM jasa_pengiriman";
		  $idPengiriman = mysqli_query($conn, $queryPengiriman);
		  while ($row=mysqli_fetch_array($idPengiriman)) {
		   if ($row['nama_jasa'] == $pengiriman) {
			$idPengirimanFix = $row['id_jasa'];
		   }
		  }
		  $subtotal = $_SESSION['subtotal'];
		  $shipping = $_SESSION['shipping'];
		  $promo = $_SESSION['promo'];
		  $total = $_SESSION['total'];
		  $status = "waiting";
	  
		  $idUser = (int)$idUser;
		  $idBankFix = (int)$idBankFix;
		  $idPengirimanFix = (int)$idPengirimanFix;
		  $subtotal = (int)$subtotal;
		  $shipping = (int)$shipping;
		  $promo = (int)$promo;
		  $total = (int)$total;
	  
		  $queryHTransaction = "INSERT INTO htransaction VALUES ('', '$transDate', '$idUser', '$idBankFix', '$idPengirimanFix', '$subtotal', '$shipping', '$promo', '$total', '$fuName', '$alamat', '$kota', '$telephone', '$noCard', '0')";
		  $query = mysqli_query($conn, $queryHTransaction);
		  $daftarIdProduk;
		  $idHTrans = mysqli_insert_id($conn);
		  foreach ($_SESSION['cart'] as $key => $value) {
		   $queryDTransaction = "INSERT INTO dtransaction VALUES ('', '$idHTrans', '$value->id', '$value->jumlah', '$status','', '0')";
		   $query = mysqli_query($conn, $queryDTransaction);
		  }
		  $_SESSION['check'] = "ada";
		  header("Location: confirmation.php");
		  //Rubah jadi Setiap Barang di DTransaction punya status diterima atau tidak nanti dirubah melalui 
		  //codingan untuk menunggu konfirmasi dari penjual sehingga nanti setelah di accept atau di tolak bisa 
		  //update biaya total yang ada di tabel htransaction
		 }
		}else {
		 header("Location: login.php");
		}
	   }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
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
					<a href="index.php">YinYinPedia
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
			<!-- Cart -->
			<ul class="top-menu text-right list-inline">
	          <!-- Search -->
	          <li class="dropdown search dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong"></i> Search</a>
	            <ul class="dropdown-menu search-dropdown">
	              <li><form action="post"><input type="search" class="form-control" placeholder="Search..."></form></li>
	            </ul>
	          </li><!-- / Search -->

	          <!-- Languages -->
	          <li class="commonSelect">
	          	<select class="form-control">
                    <option>EN</option>
                    <option>DE</option>
                    <option>FR</option>
                    <option>ES</option>
                </select>
	          </li><!-- / Languages -->

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
                <a href="index.php">Home</a>
	          </li><!-- / Home -->


	          <!-- Elements -->
	          <li class="dropdown dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Shop <span class="tf-ion-ios-arrow-down"></span></a>
	            <div class="dropdown-menu">
	              <div class="row">

	                <!-- Basic -->
	                <div >
	                	<ul>
							<li class="dropdown-header">Pages</li>
							<li role="separator" class="divider"></li>
							<li><a href="shop.php">Shop</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="historyPembeli.php">Accept Item</a></li>
	                		
	                	</ul>
	                </div>

	                <!-- Layout -->
	                <!-- <div class="col-lg-6 col-md-6 mb-sm-3">
	                	<ul>
		                  <li class="dropdown-header">Layout</li>
		                  <li role="separator" class="divider"></li>
		                  <li><a href="product-single.html">Product Details</a></li>
		                  <li><a href="shop-sidebar.html">Shop With Sidebar</a></li>
	                	</ul>
	                </div>
 -->
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
	          <?php 
	          		if (isset($_SESSION['active'])){
	          	 ?>
	          <!-- Blog -->
	          <li class="dropdown dropdown-slide">

	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"> <?php 	echo $username ?> <span class="tf-ion-ios-arrow-down"></span></a>
	            <ul class="dropdown-menu">
					<li><?php echo '<img id=prodPic src="data:image;base64,' .  base64_encode($profile)  . '" class="img-responsiveHOME"/>'; ?></li><br>
					<li><a href="#">Product Discussion</a>
	                </li>
	                <li><a href="editAcoount.php">Setting Account</a>
	                </li>
	                <li><a href="login.php">Log Out</a>
	                </li>
	            </ul>
	          </li><!-- / Blog -->
	      	<?php ;} else {?>
	      		<li class="dropdown dropdown-slide">

	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"> User <span class="tf-ion-ios-arrow-down"></span></a>
	            <ul class="dropdown-menu">
					<li><img src="<?php echo"$defaultLink"?>" alt="Profile Picture" id="prodPic"></li><br>
					<li><a href="login.php">Login</a>
	                </li>
	                <li><a href="register.php">Register</a>
	                </li>
	            </ul>
	          </li><!-- / Blog -->
	      		<?php ;} ?>
	        </ul><!-- / .nav .navbar-nav -->

	      	</div><!--/.navbar-collapse -->
	    </div><!-- / .container -->
	</nav>
</section>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">checkout</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
         <div class="row">
		 	<form class="checkout-form" method="POST">
            <div class="col-md-8">
               <div class="block billing-details">
                  <h4 class="widget-title">Billing Details</h4>
                     <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="fullName">
                     </div>
                     <div class="form-group">
                        <label for="user_address">Address</label>
                        <input type="text" class="form-control" id="user_address" name="addr">
                     </div>
                     <div class="checkout-country-code clearfix">
                        <div class="form-group">
                            <label for="user_telephone">Telephone</label>
                            <input type="text" class="form-control" id="user_telephone" name="tele">
                        </div>
                        <div class="form-group" >
                           <label for="user_city">City</label>
                           <input type="text" class="form-control" id="user_city" name="city">
                        </div>
                     </div>
                     <div class="form-group">
                            Delivery Options
						  <?php 
							$conn = mysqli_connect("localhost","root","","yinyinpedia");
		              		$q = "select * from jasa_pengiriman";
		              		$query = mysqli_query($conn,$q);
							//Delivery
							echo '<select class="browser-default form-control custom-select" name="delivery" id="delivery">';
							echo'<option selected disabled> Choose Your Delivery Method</option>';
		              		while ($row = mysqli_fetch_array($query)) {
		              			echo '<option value="'.$row[nama_jasa].'">'.$row['nama_jasa'].' - Rp '.$berat*$row['harga_per_kilo'].'</option>';
		              		}
							echo '</select>';
		              	?>
                     </div>
               </div>
               <div class="block">
                  <h4 class="widget-title">Payment Method</h4>
                  <p>Credit Cart Details (Secure payment)</p>
                  <div class="checkout-product-details">
                     <div class="payment">
                        <div class="card-details">
                              <div class="form-group half-width padding-right">
						  			<?php 
										$conn = mysqli_connect("localhost","root","","yinyinpedia");
		              					$q = "select * from bank_partner";
		              					$query = mysqli_query($conn,$q);
							  
										echo '<select class="browser-default form-control custom-select" name="bank">';
										echo '<option selected disabled>Your Bank</option>';
										while ($row = mysqli_fetch_array($query)) {
		              						echo '<option id="bPart" value="'.$row['nama_bank'].'">'.$row['nama_bank'].'</option>';
		              					}
										echo '</select>';
		              				?>
                              </div>
                              <div class="form-group">
                                 <label for="card-number">Card Number <span class="required">*</span></label>
                                 <input  id="card-number" class="form-control" name="cardNum" type="tel" placeholder="•••• •••• •••• ••••">
                              </div>
                              <div class="form-group half-width padding-left">
                                 <label for="card-cvc">Card Code <span class="required">*</span></label>
                                 <input id="card-cvc" class="form-control" name="cardCode" type="tel" maxlength="4" placeholder="CVC" >
							  </div>
								  <button type="submit" name="placeOrder" class="btn btn-main mt-20">Place Order</button>
							  </div>
                     </div>
                  </div>
               </div>
            </div>
    		</form>
            <div class="col-md-4">
               <div class="product-checkout-details">
                  <div class="block">
                     <h4 class="widget-title">Order Summary</h4>
                     <div class="media product-card">
                        <div class="media-body">
						<?php 
                    	$total = 0;
                    	if (isset($_SESSION['cart'])){
                    		foreach ($_SESSION['cart'] as $key => $value) {
	            				$sql = "select * from produk_detail";
	            				$query = mysqli_query($conn,$sql);
	            				while ($row = mysqli_fetch_array($query)) {
	            					if ($row['id_produk'] == $value->id){
	            						$datacart = $row;
	            					}
	            				}
	            				echo "<div class='product-info'>";
	            				echo '<img src="data:image;base64,' .  base64_encode($datacart['gambar'])  . '" alt="image" width="80"/>';
	            				echo "<a href=''>$datacart[nama_barang]</a>";
	            				echo "</div>";
	            				echo "</td>";
	            				echo "Jumlah : " . "$value->jumlah"."<br>";
	            				echo "Rp $datacart[harga]";
	            				$subtotal += $value->jumlah * $datacart['harga'];
	            				$total = $total +($value->jumlah * $datacart['harga']);
	            				$idcart = $value->id; 
	            			}
                    	}else {
                    		echo "Empty";
                    	}
                    ?>
                        </div>
					 </div>
					 <div id='ongkir'>
						<ul class="summary-prices">
							<li>
							<span>Subtotal:</span>
							<span class="price"><?php echo "Rp ".$subtotal ?></span>
							</li>
							<li>
							<span>Shipping:</span>
							<span>Rp 0</span>
							</li>
							<li>
							<span>Promo:</span>
							<span>- Rp 0</span>
							</li>
						</ul>
						<div class="summary-total">
							<span>Total</span>
							<span><?php echo "Rp ".$total ?></span>
						</div>
					 </div>
                     <div class="verified-icon">
                        <img class="bank" src="gambar/bca.jpg">
                        <img class="bank" src="gambar/bri.jpg">
                        <img class="bank" src="gambar/cimb niaga.jpg">
                        <img class="bank" src="gambar/hsbc.jpg">
                        <img class="bank" src="gambar/mandiri.jpg">
                        <img class="bank" src="gambar/standard chartered.jpg">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
    
    <!-- Revolution Slider -->
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/jquery.themepunch.revolution.min.js"></script>
    
    <!-- Revolution Slider -->
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="plugins/revolution-slider/assets/warning.js"></script>  



    <!-- Custom js -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBItRd4sQ_aXlQG_fvEzsxvuYyaWnJKETk&callback=initMap"></script>

	<script src="js/script.js"></script>
	<script>
		$(document).ready(function (){
			$('#delivery').on("change",function(){
				$.get("ajax.php",
				{
					mode : "cBoxDelivery",
					namaDelivery : $('#delivery').val(),
					beratTotalBarang : <?php echo $berat?>,
					subtot : <?php echo $subtotal?>
				},
				function(data){
					$('#ongkir').html(data);
				}
				)
			})
		})
	</script>
    


  </body>
  </html>
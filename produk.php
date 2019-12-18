<?php
	session_start();
	$defaultLink = "rss\PP\avatar.png";
	$conn = mysqli_connect("localhost","root","","yinyinpedia");
	if (isset( $_POST['idproduk']))
	{
		$idproduk = $_REQUEST['idproduk'];
		$_SESSION['idbantuan'] = $_REQUEST['idproduk'];
	}
	if (isset($_SESSION['idbantuan']))
	{
		$idproduk = $_SESSION['idbantuan'];
	}
	else{
		$idproduk = $_REQUEST['idproduk'];
		$_SESSION['idbantuan'] = $_REQUEST['idproduk'];
	}
	$jumlahproduk = 0;
	if (isset($_SESSION['cart'])){
		foreach ($_SESSION['cart'] as $key => $value) {
			if ($idproduk == $value->id){
				$jumlahproduk = $value->jumlah;
			}
		}
	}

	if (isset($_SESSION['active'])){
		$username = $_SESSION['active'];
		$id = $_SESSION['id'];
		$profile = $_SESSION['profile'];
		if (isset($_POST['addcart'])){
			$jumlah = intval($_POST['product-quantity']);
			$sql = "select * from produk_detail";
			$query = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($query)) {
				if ($row['id_produk'] == $idproduk){
					$data = $row;
				}
			}
			if ((int)$data['stock'] >=(int)$jumlah &&$jumlah > 0){
				$barang = new stdClass();
				$barang->id = $idproduk;
				$barang->jumlah = $jumlah;
				$_SESSION['cart'][$idproduk] = $barang;
				header("Location: shop.php");
			}else {
				$mess = "Stock tidak cukup";
	            echo "<script type='text/javascript'> alert ('$mess') ;</script>";
			}
			// echo "string";
			
		}
		$sql = "select * from history";
		$query = mysqli_query ($conn,$sql);
		$baru = 1;
		while (	$row = mysqli_fetch_array($query)) {
			if ($row['username_user'] == $username && $row['id_produk']==$idproduk){
				$baru = 0;
			}
		}
		if ($baru == 1){
			$insert = "insert into history values('','$username',$idproduk)";
			$query = mysqli_query($conn,$insert);
		}
	}else {
		if (isset($_POST['addcart'])){
			$jumlah = intval($_POST['product-quantity']);
			$sql = "select * from produk_detail";
			$query = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($query)) {
				if ($row['id_produk'] == $idproduk){
					$data = $row;
				}
			}
			if ((int)$data['stock'] >= (int)$jumlah  && $jumlah > 0){
				$barang = new stdClass();
				$barang->id = $idproduk;
				$barang->jumlah = $jumlah;
				$_SESSION['cart'][$idproduk] = $barang;
				header("Location: shop.php");
			}else {
				$mess = "Stock tidak cukup";
	            echo "<script type='text/javascript'> alert ('$mess') ;</script>";
			}
			// echo "string";
			
		}
	}
	if (!isset($_SESSION['idbantuan'])){
		header("Location: index.php");
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
     input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
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
	          <li class="dropdown cart-nav dropdown-slide">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-android-cart"></i>Cart</a>
	            <div class="dropdown-menu cart-dropdown">
	            	<?php 
	            	$total = 0;
	            		if (isset($_SESSION['cart'])) {

	            			foreach ($_SESSION['cart'] as $key => $value) {
	            				
	            				echo "<div class=media>";
	            				echo "<a class='pull-left' href='#'>";
	            				$sql = "select * from produk_detail";
	            				$query = mysqli_query($conn,$sql);
	            				while ($row = mysqli_fetch_array($query)) {
	            					if ($row['id_produk'] == $value->id){
	            						$data = $row;
	            					}
	            				}
	            				echo '<img src="data:image;base64,' .  base64_encode($data['gambar'])  . '" alt="image" class="media-object"/>';
	            				echo "</a>";
	            				echo '<div class="media-body">';
	            				echo '<h4 class="media-heading"><a href="#">'.$data['nama_barang'].'</a></h4>';
	            				echo '<div class="cart-price">';
	            				echo '<span>'.$value->jumlah.' x</span>';
	            				echo "<span> Rp $data[harga]</span>";
	            				$total = $total + ($value->jumlah * $data['harga']) ;
	            				echo "</div>";
	            				echo "</div>";
	            				echo "</div>";
	            			}
	            		}else {
	            			echo "<div class=media>";
            				echo '<div class="media-body">';
            				echo '<div class="cart-price">';
            				echo '<span>Empty</span>';
            				echo "</div>";
            				echo "</div>";
	            			echo "</div>";
	            		}
	            	 ?>
	            	
	            	<div class="cart-summary">
                        <span>Total</span>
                        <span class="total-price"> Rp <?php echo "$total"; ?></span>
                    </div>
                    <ul class="text-center cart-buttons">
                    	<li><a href="cart.php" class="btn btn-small">View Cart</a></li>
                    </ul>
                </div>

	          </li><!-- / Cart -->

	          <!-- Search -->
	          <li class="dropdown search dropdown-slide">
	            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong"></i> Search</a> -->
	            
	              <li><input type="search" class="form-control" placeholder="Search..." id=textsearch></li>
	            
	          </li><!-- / Search -->
			  
			  <li>
                <button id=search><i class="tf-ion-ios-search-strong"></i></button><br>
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

<section class="single-product">
	<div class="container">
		<div class="row mt-20">
			
			<div class="col-md-5">
				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<?php $sql = "select * from produk_detail"; $query = mysqli_query($conn, $sql); ?>
									<?php foreach ($query as $row): ?>
										<form method="POST">
											<?php if ($row["id_produk"] == $idproduk): ?>
												<?php echo '<img src="data:image;base64,' .  base64_encode($row['gambar'])  . '" class="img-responsive"/>'; ?>
											<?php endif ?>
											<input type="hidden" name="idproduk" value="<?php echo $idproduk ?>">
										</form>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="single-product-details">
					<?php $sql = "select * from produk_detail"; $query = mysqli_query($conn, $sql); ?>
					<?php foreach ($query as $row): ?>
						<form method="POST">
							<?php if ($row["id_produk"] == $idproduk): ?>
								<h2><?= $row['nama_barang'] ?> </h2>
								<p class="product-price"> Rp <?= $row['harga'] ?></p>
								<?php
									$_SESSION["id_kategori"] = $row["id_kategori"];
									$_SESSION["tag"] = $row["tag"];
									$_SESSION["prod"] = $idproduk;
									$desc = $row["desc_barang"];
									$id_kategori = $row['id_kategori'];
									$stok = $row["stock"];
									$berat = $row["berat"];
									$kondisi = $row["kondisi"];
									$tag = $row["tag"];
									$rating = $row["rating"];
									$sold = $row["jumlah_pembeli"];
									$sql2 = "select * from kategori";
						            $query2 = mysqli_query($conn, $sql2);
						            foreach ($query2 as $row2) {
						                if ($row2["id_kategori"] == $id_kategori) {
						                    $kategori = $row2["nama_kategori"];
						                }
						            }
						            if ($kategori == "Hewan") {
						            	$kategori = "Animals";
						            }
						            else if ($kategori == "Barang") {
						            	$kategori = "Items";
						            }
						        ?>							
						    <?php endif ?>
							<input type="hidden" name="idproduk" value="<?php echo $idproduk ?>">
						</form>
					<?php endforeach ?>
					<p class="product-short-description">
						TAG : <?= $tag ?> <br>
						Rating : <?= $rating ?> <br>
						Sold : <?= $sold ?> pcs
					</p>
					<div class="product-category">
						<span>Categories :</span>
						<ul>
							<li><a href="#"><?= $kategori ?></a></li>
						</ul>
					</div>
					<div class="product-category">
						<span>Condition :</span> <?= $kondisi ?>
					</div>
					<div class="product-category">
						<span>Weight :</span> <?= $berat ?> kg
					</div>
					<div class="product-category">
						<span>Stock :</span> <?= $stok ?> pcs
					</div>
					<form method="post">	
					<div class="product-quantity">
						<span>Quantity :</span>
						<div class="product-quantity-slider">
							<input id="product-quantity" type="number" value="<?= $jumlahproduk ?>" name="product-quantity">
						</div>
					</div><br>	
					<button type="submit" class="btn btn-main btn-medium" name=addcart>Add To Cart</button>
					</form>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<form method="POST">
						<ul class="nav nav-tabs">
							<button class="btn btn-main btn-medium"> Description </button>
							<button class="btn btn-main btn-medium" formaction="diskusi-pembeli.php"> Discussions</button>
							<!-- <li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
							<li class=""><a data-toggle="tab" href="diskusi-pembeli.php" aria-expanded="false">Discussions</a></li> -->
						</ul>
						<div class="tab-content patternbg">
							<div id="details" class="tab-pane fade active in">
								<h4>Product Description</h4>
								<p><?= $desc ?></p>
							</div>
						</div>
						<input type="hidden" name="idproduk" value="<?php echo $idproduk ?>">
					</form>
				</div>
			</div>
		</div>
		<br>
		<!-- Tampilan Produk -->
        <div class="col-md-9" id="tampilanProduk">
        	<?php $tag = $_SESSION["tag"];
        	$idproduk3 = $_SESSION["prod"];
        	$idkategori = $_SESSION["id_kategori"];
        	$tottag = explode(" ", $tag);
        	$sql = "select * from produk_detail where id_kategori = $idkategori"; $query = mysqli_query($conn, $sql); ?>
        	<?php foreach ($query as $row): ?>
        		<?php if ($row["id_produk"] != $idproduk3 && $row["status"] == 0): ?>
        			<?php
					    $tagproduk = explode(" ", strtolower($row['tag']));
					    if ($tag != null){
					      $cek = 0; $hitung=0;
					    }
					    else $cek = 1;
					    for ($i= 0; $i < count($tagproduk); $i++) { 
					      for ($j=0; $j < count($tottag); $j++) { 
					         if ($tagproduk[$i] == $tottag[$j]){
					            $cek = 1;
					            $hitung = $hitung + 1;
					         }
					      }
					    }
        			?>
        			<?php if ($cek == 1): ?>
        				<form method="POST">
							<div class="col-md-4">
								<div class="product-item">
									<div class="product-thumb">
										<?php $idproduk2 = $row["id_produk"]; ?>
										<?php echo '<img src="data:image;base64,' .  base64_encode($row['gambar'])  . '"style="height: 200px"   class="img-responsive"/>'; ?>
										<div class="preview-meta">
											<ul>
												<li>
													<button type="submit" formaction="produk.php" style="background-color:transparent; border:0px">
														<a href=""><i class="tf-ion-android-cart"></i></a>
													</button>
												</li>
											</ul>
				                      	</div>
									</div>
									<div class="product-content">
										<?php if ($row["id_produk"] == $idproduk2): ?>
											<button type="submit" class="btn btn-link" name="edit" formaction="produk.php">
												<h4><?= $row['nama_barang'] ?></h4>
												<p class="price">Rp <?= $row['harga'] ?></p>
												<p class="price"> Rating : <?php if ($row['jumlah_pembeli'] !=0)$rate = $row['rating']/$row['jumlah_pembeli'];else $rate=0; echo "$rate"; ?> Sold : <?= $row['sold'] ?></p>
											</button>
										<?php endif ?>
									</div>
								</div>
							</div>
							<input type="hidden" name="idproduk" value="<?php echo $idproduk2 ?>">
						</form>
        			<?php endif ?>
				<?php endif ?>
        	<?php endforeach ?>
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
    


  </body>
  </html>

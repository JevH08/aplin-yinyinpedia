<?php
	session_start();
	$defaultLink = "rss\PP\avatar.png";
	$conn = mysqli_connect("localhost","root","","yinyinpedia");
	$_SESSION['cekFoto'] = 0;
	if (isset($_SESSION['idbantuan'])){
		unset($_SESSION['idbantuan']);
	}
	if (isset($_SESSION['active'])){
		$username = $_SESSION['active'];
		$profile = $_SESSION['profile'];
	}
	if (isset($_SESSION['id_kategori'])){
		$idkategori = $_SESSION["id_kategori"];
	}else {
		$idkategori = 1;
		$_SESSION['id_kategori'] = 1;
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

<section> <!-- Layar Utama Pembelian-->
	<div class="container">
		<div class="col-md-3">
				<div class="widget">
					<h4 class="widget-title">Sort By</h4>
					<!-- <form method="post" action="#"> -->
                        <select class="form-control" id=sort>
                        	<option disabled selected>SORT BY</option>
                            <option value=1>The Cheapest Price</option>
                            <option value=2>The Most Expensive Price</option>
                            <option value=3>New Product</option>
                        </select>
                    <!-- </form> -->
                    
	            </div>
				<div class="widget product-category">
					<h4 class="widget-title">Filter</h4>
					<div class="panel-group commonAccordion" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      	<h4 class="panel-title">
						        	<a role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
						          	Price
						        	</a>
						      	</h4>
						    </div>
					    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<ul>
								<form method="POST">
									<li><input type="number" name="minimum" class="form-control" placeholder="minimum" id=minimum></li>
									<li><input type="number" name="maximum" class="form-control" placeholder="maximum" id=maximum></li>
								</form>
								</ul>
							</div>
					    </div>
					  </div>
					  	<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      	<h4 class="panel-title">
						        	<a role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
						          	Condition
						        	</a>
						      	</h4>
						    </div>
					    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
                        	<select class="form-control" id=condition>
                    			<option disabled selected>Condition</option>
                        		<option value="New">New</option>
                            	<option value="Used">Used</option>
                        	</select>
							</div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingTwo">
					      <h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwo">
					         	Location
					        </a>
					      </h4>
					    </div>
					    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
					    	<div class="panel-body">
                        		<select class="form-control" id=city>
                    				<option disabled selected>City</option>
									<option value="aceh">Aceh</option>
				                    <option value="surabaya">Surabaya</option>
				                    <option value="surakarta">Surakarta</option>
				                    <option value="jakarta">Jakarta</option>
				                    <option value="yogyakarta">Yogyakarta</option>
				                    <option value="solo">Solo</option>
				                    <option value="banjarmasin">Banjarmasin</option>
				                    <option value="tangerang">Tangerang</option>
				                    <option value="bandung">Bandung</option>
				                    <option value="bau bau">Bau Bau</option>
				                    <option value="tanjung pinang">Tanjung Pinang</option>
				                    <option value="banten">Banten</option>
                        		</select>
					    	</div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingThree">
					      <h4 class="panel-title">
					        <a> Rating</a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
					    	<div class="panel-body">
                        		<select class="form-control" id=rating>
                    				<option disabled selected>Rating</option>
									<option value="1">>=1</option>
									<option value="2">>=2</option>
								  	<option value="3">>=3</option>
								  	<option value="4">>=4</option>
								  	<option value="5">>=5</option>
                        		</select>
					    	</div>
					    </div>
					  </div>
					</div>
				</div>
			</div>

        <!-- Tampilan Produk -->
        <div class="col-md-9" id="tampilanProduk">
			<?php $sql = "select * from produk_detail where id_kategori = $idkategori"; $query = mysqli_query($conn, $sql); ?>
			<?php foreach ($query as $row): ?>
				<?php if ($row["status"] == 0): ?>
					<form method="POST">
						<div class="col-md-4">
							<div class="product-item">
								<div class="product-thumb">
									<?php $idproduk = $row["id_produk"]; ?>
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
									<?php if ($row["id_produk"] == $idproduk): ?>
										<button type="submit" class="btn btn-link" name="edit" formaction="produk.php">
											<h4><?= $row['nama_barang'] ?></h4>
											<p class="price">Rp <?= $row['harga'] ?></p>
											<p class="price"> Rating : <?php if ($row['jumlah_pembeli'] !=0)$rate = $row['rating']/$row['jumlah_pembeli'];else $rate=0; echo "$rate"; ?> Sold : <?= $row['sold'] ?></p>
										</button>
									<?php endif ?>
								</div>
							</div>
						</div>
						<input type="hidden" name="idproduk" value="<?php echo $idproduk ?>">
					</form>
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
    <script type="text/javascript">
    	$(document).ready(function () {
    		var idx;
    		var rate;
    		$("#sort").on("change",function () {
    			idx = this.selectedIndex;
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:this.selectedIndex,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    		$('#search').click(function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		
    		});
    		// $('#textsearch').focusout(function () {
    		// 	$.get(
    		// 		"ajax.php",
    		// 		{
    		// 			mode:"maximumpembeli",
    		// 			text: $("#textsearch").val(),
    		// 			min:$('#minimum').val(),
    		// 			max:$('#maximum').val(),
    		// 			kondisi:$("#condition").val(),
    		// 			rating: rate,
    		// 			city:$('#city').val(),
    		// 			by:idx,
    		// 			kategori: <?php echo $idkategori; ?>
    		// 		},
    		// 		function (data) {
    		// 			$('#tampilanProduk').html(data);
    		// 		}
    		// 	);
    		
    		// });
    		$('#minimum').focusout(function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    		$('#maximum').focusout(function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    		$('#condition').on("change",function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    		$('#city').on("change",function() {
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: rate,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    		$('#rating').on("change",function() {
    			rate = this.selectedIndex;
    			$.get(
    				"ajax.php",
    				{
    					mode:"maximumpembeli",
    					text: $("#textsearch").val(),
    					min:$('#minimum').val(),
    					max:$('#maximum').val(),
    					kondisi:$("#condition").val(),
    					rating: this.selectedIndex,
    					city:$('#city').val(),
    					by:idx,
    					kategori: <?php echo $idkategori; ?>
    				},
    				function (data) {
    					$('#tampilanProduk').html(data);
    				}
    			);
    		});
    	});
    </script>
    

  </body>
  </html>
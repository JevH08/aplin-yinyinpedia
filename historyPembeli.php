<?php 
	session_start();
	$defaultLink = "rss\PP\avatar.png";
	$conn = mysqli_connect("localhost","root","","yinyinpedia");
	
	if (isset($_SESSION['active'])){
		$username = $_SESSION['active'];
		$profile = $_SESSION['profile'];
		if (isset($_SESSION['check'])){
			unset($_SESSION['cart']);
		}
		$tipeUser = $_SESSION['tipe'];
		if($tipeUser == "penjual"){
			header("Location: login.php");
		}
	}else{
		header("Location: login.php");
	}

    if (isset($_POST['terima'])){
        $nomorBarangUtkReview = $_POST['terima'];
        $numNota = $_POST['nomerNota'];
        $numBarang = $_POST['nomerBarang'];
		$_SESSION['idBarang'] = $numBarang;
		$_SESSION['idNota'] = $numNota;
		$sqlApaBisaReview = "SELECT status FROM dtransaction WHERE no_nota = $numNota AND id_barang = $numBarang";
		$queryApaBisaReview = mysqli_query($conn, $sqlApaBisaReview);

        while($row = mysqli_fetch_array($queryApaBisaReview)){
			$accept = $row['status'];
			if($accept == "sampe"){
				header("Location: writeReview.php");
			}else if ($accept == "reviewed"){
				echo '<script> alert("Item Has Been Reviewed")</script>';
			}else{
				echo '<script> alert("Item Have Not Arived")</script>';
			}
		}
	}

	if (isset($_POST['sampeOrder'])){
		$noNota = $_POST['nomerNota'];
		$sqlAmbilAcceptHTrans = "SELECT h.accepted, d.status FROM htransaction h, dtransaction d WHERE h.no_nota = $noNota AND d.no_nota = h.no_nota";
		$queryAmbilAcceptHTrans = mysqli_query($conn, $sqlAmbilAcceptHTrans);

        while($row = mysqli_fetch_array($queryAmbilAcceptHTrans)){
			$apakahAcc = $row['accepted'];
			$totalHargaMasukSeller = 0;
			if ($apakahAcc == 0){
				$sqlUpdateAcceptHTrans = "UPDATE htransaction SET accepted = 1 WHERE no_nota = $noNota";
				$queryUpdateAcceptHTrans = mysqli_query($conn, $sqlUpdateAcceptHTrans);
				
				$sqlUpdateAcceptDTrans = "UPDATE dtransaction SET status = 'sampe' WHERE no_nota = $noNota";
				$queryUpdateAcceptDTrans = mysqli_query($conn, $sqlUpdateAcceptDTrans);
				
				$sqlCariPenjual = "SELECT pe.saldo, pd.harga, pe.id_penjual FROM dtransaction d, produk_detail pd, penjual pe WHERE d.status = 'sampe' AND d.id_barang = pd.id_produk AND pd.id_penjual = pe.id_penjual AND d.no_nota = $noNota";
				$queryCariPenjual = mysqli_query($conn, $sqlCariPenjual);
				while($rows = mysqli_fetch_array($queryCariPenjual)){
					$oldSaldo = $rows['saldo'];
					$harga = $rows['harga'];
					$id_penjualSeller = $rows['id_penjual'];
					$newSaldo = $oldSaldo + $harga;

					$sqlUpdateMoney = "UPDATE penjual SET saldo = $newSaldo WHERE id_penjual = $id_penjualSeller ";
					$queryUpdateMoney = mysqli_query($conn, $sqlUpdateMoney);
				}
			}else{
				echo '<script> alert("Item Sudah Diterima") </script>';
			}
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
  <link rel="stylesheet" href="resource/bootstrap.min.css">
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
  <style type="text/css">
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
    .kurangiMargin{
        margin-left : -17%;
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
	            						$data2 = $row;
	            					}
	            				}
	            				echo '<img src="data:image;base64,' .  base64_encode($data2['gambar'])  . '" alt="image" class="media-object"/>';
	            				echo "</a>";
	            				echo '<div class="media-body">';
	            				echo '<h4 class="media-heading"><a href="#">'.$data2['nama_barang'].'</a></h4>';
	            				echo '<div class="cart-price">';
	            				echo '<span>'.$value->jumlah.' x</span>';
	            				echo "<span> Rp $data2[harga]</span>";
	            				$total = $total + ($value->jumlah * $data2['harga']) ;
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
	            
	              <li><input type="search" class="form-control" placeholder="Search..." disabled></li>
	            
	          </li><!-- / Search -->
			  
			  <li>
                <button disabled><i class="tf-ion-ios-search-strong"></i></button><br>
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

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">History</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">History</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
        <?php
            $idPembeli = $_SESSION['id'];
            $sqlDaftarItemPembeli = 'SELECT h.no_nota, h.nama_tujuan, h.telp_tujuan, h.kota_tujuan, jp.nama_jasa, h.shipping, b.nama_bank, h.promo, h.accepted FROM htransaction h, dtransaction d, produk_detail p, jasa_pengiriman jp, bank_partner b WHERE b.id_bank = h.id_bank AND h.id_user = '.$idPembeli.' AND d.no_nota = h.no_nota AND d.id_barang = p.id_produk AND h.id_pengiriman = jp.id_jasa GROUP BY h.no_nota';
            $queryAmbilItemPembeli = mysqli_query($conn, $sqlDaftarItemPembeli);
            while($row = mysqli_fetch_array($queryAmbilItemPembeli)){
                $nomerNota = $row['no_nota'];
                $namaPenerima = $row['nama_tujuan'];
                $alamatPenerima = $row['telp_tujuan'];
                $telp_tujuan = $row['kota_tujuan'];
                $jasaKirim = $row['nama_jasa'];
                $ongkir = $row['shipping'];
				$bank = $row['nama_bank'];
				$promo = $row['promo'];
				$harga = 0;
				$isAccepted = 1;

				$sqlGetHarga = 'SELECT p.harga, d.status FROM dtransaction d, produk_detail p WHERE d.no_nota = '.$nomerNota.' AND d.id_barang = p.id_produk AND d.status != "declined" ';
				$queryGetHarga = mysqli_query($conn, $sqlGetHarga);
				while($row2 = mysqli_fetch_array($queryGetHarga)){
					$harga = $harga + $row2['harga'];
					$statusPerPiece = $row2['status'];
					if($statusPerPiece == "waiting" || $statusPerPiece == "sampe" || $statusPerPiece == "declined" || $statusPerPiece == "reviewed"){
						$isAccepted = 0;
					}
				}
				$harga = $harga + $ongkir - $promo;
				if ($isAccepted == 1){
					echo '<div class="row border-bottom border-success">';
					echo '<div class="col-3">';
						echo 'Order Number : ' . $nomerNota . '<br>';
						echo 'Receiver Name : ' . $namaPenerima . '<br>';
						echo 'Receiver Address : ' . $alamatPenerima . '<br>';
						echo 'Receiver Telephone : ' . $telp_tujuan . '<br><br>';
						echo 'Payment Method : ' . $bank . '<br>';
						echo 'Delivery Service : ' . $jasaKirim . '<br>';
						echo 'Delivery Cost : ' . $ongkir . '<br>';
						echo 'Promo and Discount : ' . $promo . '<br>';
						echo 'Total Payment : ' . $harga. '<br>';
					echo '</div>';
					echo '<div class="col-3">';
						echo '<form method="post">';
							echo '<input type="hidden" name="nomerNota" value='.$nomerNota.' >';
							echo '<input type="submit" class="btn btn-main btn-small btn-round-full btn-icon" name="sampeOrder" value="Accept"></input>' .'<br>';
						echo '</form>';
						echo '</div>';
				}else{
					echo '<div class="row border-bottom border-success">';
						echo '<div class="col-6">';
							echo 'Order Number : ' . $nomerNota . '<br>';
							echo 'Receiver Name : ' . $namaPenerima . '<br>';
							echo 'Receiver Address : ' . $alamatPenerima . '<br>';
							echo 'Receiver Telephone : ' . $telp_tujuan . '<br><br>';
							echo 'Payment Method : ' . $bank . '<br>';
							echo 'Delivery Service : ' . $jasaKirim . '<br>';
							echo 'Delivery Cost : ' . $ongkir . '<br>';
							echo 'Promo and Discount : ' . $promo . '<br>';
							echo 'Total Payment : ' . $harga. '<br>';
						echo '</div>';
				}

                echo '<div class="col-6">';
                    echo '<div class="slots" id="slot'.$nomerNota.'">';
      
                    $sqlCetakBarang = "SELECT p.gambar, p.nama_barang, p.harga, d.status, d.no_detail, d.id_barang, d.no_nota FROM htransaction h, dtransaction d, produk_detail p WHERE h.no_nota = d.no_nota AND d.id_barang = p.id_produk AND h.no_nota = $nomerNota";
                    $queryCetakBarang = mysqli_query($conn, $sqlCetakBarang);

                    while($row = mysqli_fetch_array($queryCetakBarang)){
                        $noDetailBarang = $row['no_detail'];
                        $gambarBarang = $row['gambar'];
                        $namaBarang = $row['nama_barang'];
                        $hargaBarang = $row['harga'];
                        $statusBarang = $row['status'];
						$numBarang = $row['id_barang'];
						$numNota = $row['no_nota'];
                
                        if($statusBarang == "reviewed"){
                            echo '<form method="post">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-2">';
                                        echo '<img src="data:image;base64,' .  base64_encode($gambarBarang)  . '" alt="image" width="80"/>';
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo $namaBarang;
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo 'Rp '.$hargaBarang;
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo $statusBarang;
                                    echo '</div>';
									echo '<div class="col-4">';
										$sqlGetReview = "SELECT review, ratingKah FROM dtransaction WHERE id_barang = $numBarang AND no_nota = $numNota";
										$queryGetReview = mysqli_query($conn, $sqlGetReview);
                    					while($rowss = mysqli_fetch_array($queryGetReview)){
											$review = $rowss['review'];
											$rating = $rowss['ratingKah'];
										}
										echo 'Rating :'.$rating.'<br>';
										echo $review.'<br>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</form>';
						}else if($statusBarang != "accepted" && $statusBarang != "waiting" && $statusBarang != "declined"){
                            echo '<form method="post">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-2">';
                                        echo '<img src="data:image;base64,' .  base64_encode($gambarBarang)  . '" alt="image" width="80"/>';
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo $namaBarang;
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo 'Rp '.$hargaBarang;
                                    echo '</div>';
                                    echo '<div class="col-md-2">';
                                        echo $statusBarang;
                                    echo '</div>';
                                    echo '<div class="col-4">';
										echo '<input type="hidden" name="nomerNota" value='.$nomerNota.' >';
										echo '<input type="hidden" name="nomerBarang" value='.$numBarang.' >';
                                        echo '<input type="submit" class="btn btn-main btn-small btn-round-full btn-icon" name="terima" value=Review></input>' .'<br>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</form>';
                        }else{
                            echo '<div class="row">';
                                echo '<div class="col-md-3">';
                                    echo '<img src="data:image;base64,' .  base64_encode($gambarBarang)  . '" alt="image" width="80"/>';
                                echo '</div>';
                                echo '<div class="col-md-3">';
                                    echo $namaBarang;
                                echo '</div>';
                                echo '<div class="col-md-3">';
                                    echo 'Rp '.$hargaBarang;
                                echo '</div>';
                                echo '<div class="col-md-3">';
                                    echo $statusBarang;
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                echo '</div>';

                echo '</div> <br>';
            }
        ?>
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
    
    <script type="text/javascript">
		function detail(nomerNota) {
    		$.get(
				"ajax.php",
				{
					mode:"detailNotaBuyer",
					nomerNota: nomerNota
				},
				function (data) {
					$('#slot'+nomerNota).html(data);
				}
			)
    	}
    </script>

  </body>
  </html>

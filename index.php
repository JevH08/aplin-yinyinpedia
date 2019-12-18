<?php
	session_start();
	$defaultLink = "rss\PP\avatar.png";
	$conn = mysqli_connect("localhost","root","","yinyinpedia");
	$_SESSION['cekFoto'] = 0;
	if (isset($_SESSION['active']) ){
		if ($_SESSION['tipe']=="pembeli")
		{
			$username = $_SESSION['active'];
			$profile = $_SESSION['profile'];
		}
		else{
			unset($_SESSION['active']);
			unset($_SESSION['tipe']);
			unset($_SESSION['profile']);
			header("Location: login.php");
		}
	}
	if (isset($_POST['barang'])){
		$_SESSION['id_kategori'] = 1;
		header("Location: shop.php");
	}else if (isset($_POST['hewan'])){
		$_SESSION['id_kategori'] = 2;
		header("Location: shop.php");
	}
	// header("Location: shop.php");

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

<section class="product-category section">
		
	<div class="container">
		<div class="row">
			<form method="post">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Shop Category</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-item category-box" >
					<div class="product-thumb" >
						<img class="img-responsive" style="height: 350px" src="images/gambar22.jpg" alt="product-img" />
						
					</div>
					<div class="product-content">
						<button type="submit" class="btn btn-link" name="barang">
							<h2>Items</h2>
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-item category-box" >
					<div class="product-thumb" >
						<img class="img-responsive" style="height: 350px"  src="images/gambar.jpg" alt="product-img" />
						
					</div>
					<div class="product-content">
						<button type="submit" class="btn btn-link" name="hewan">
							<h2>Animals</h2>
						</button>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Popular Tag for Items</h2>
				</div>
			</div>
			<?php $sql = "select * from tagitem order by count_tag desc limit 3";
			$query = mysqli_query($conn,$sql);
			foreach ($query as $row ) {
				$tottag[] = $row["nama_tag"];
			}
			$k = 0;
			$sql2 = "select * from produk_detail where id_kategori = 1 order by rating2 desc"; 
			$query2 = mysqli_query($conn, $sql2); ?>
			<?php foreach ($query2 as $row2): ?>
				<?php if ($row2["status"] == 0): ?>
					<?php
					    $tagproduk = explode(" ", strtolower($row2['tag']));
					    $cek = 0;
					    $hitung = 0;
					    for ($i= 0; $i < count($tagproduk); $i++) { 
					    	for ($j=0; $j < count($tottag); $j++) { 
						        if ($tagproduk[$i] == $tottag[$j]){
						            $cek = 1;
						            $hitung = $hitung + 1;
						            $tag = $tottag[$j];						         
						        }
						    }
					    }
        			?>
        			<?php if ($cek == 1 && $k < 3): ?>
        				<?php $k += 1; ?>
        				<form method="POST">
							<div class="col-md-4">
								<div class="product-item">
									<div class="product-thumb">
										<?php $idproduk2 = $row2["id_produk"]; ?>
										<?php echo '<img src="data:image;base64,' .  base64_encode($row2['gambar'])  . '"style="height: 300px"   class="img-responsive"/>'; ?>
										<div class="preview-meta">
											<ul>
												<li>
													<button type="submit" style="background-color:transparent; border:0px" formaction="produk.php">
														<a href=""><i class="tf-ion-android-cart"></i></a>
													</button>
												</li>
											</ul>
				                      	</div>
									</div>
									<div class="product-content">
										<?php if ($row2["id_produk"] == $idproduk2): ?>
											<button type="submit" class="btn btn-link" name="edit" formaction="produk.php">
												<h4><?= $row2['nama_barang'] ?></h4>
												<p class="price">Rp <?= $row2['harga'] ?></p>
												<p class="price"> Rating : <?php if ($row2['jumlah_pembeli'] !=0)$rate = $row2['rating']/$row2['jumlah_pembeli'];else $rate=0; echo "$rate"; ?> Sold : <?= $row2['sold'] ?></p>
												<p class="price"> Tag : <?= $tag ?> </p>
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
			<!-- while ($row=mysqli_fetch_array($query)) {
				$data[] = $row;
			}
			for ($i=0; $i < Count($data); $i++) { 
				for ($j=$i+1; $j < Count($data); $j++) { 
					if ($data[$i]['count_tag'] < $data[$j]['count_tag']){
						$temp = $data[$i];
						$data[$i] = $data[$j];
						$data[$j] = $temp;
					}
				}
			}
			for ($i=0; $i < Count($data); $i++) { 
				if ($i < 6){
					echo "<div class='col-md-2'>";
					echo "<button type='submit' class='btn btn-main btn-large' name='barang'>";
					echo $data[$i]['nama_tag'];
					echo "</button>";
					echo "</div>";
				}
			} -->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Popular Tag for Animals</h2>
				</div>
			</div>
			<?php $sql = "select * from taganimal order by count_tag desc limit 3";
			$query = mysqli_query($conn,$sql);
			$k = 0;
			foreach ($query as $row ) {
				$tottag[] = $row["nama_tag"];
			}
			$sql2 = "select * from produk_detail where id_kategori = 2 order by rating2 desc"; 
			$query2 = mysqli_query($conn, $sql2); ?>
			<?php foreach ($query2 as $row2): ?>
				<?php if ($row2["status"] == 0): ?>
					<?php
					    $tagproduk = explode(" ", strtolower($row2['tag']));
					    $cek = 0;
					    $hitung = 0;
					    for ($i= 0; $i < count($tagproduk); $i++) { 
					    	for ($j=0; $j < count($tottag); $j++) { 
						        if ($tagproduk[$i] == $tottag[$j]){
						            $cek = 1;
						            $hitung = $hitung + 1;
						            $tag = $tottag[$j];
						         }
						    }
					    }
        			?>
        			<?php if ($cek == 1 && $k < 3): ?>
        				<?php $k += 1; ?>
        				<form method="POST">
							<div class="col-md-4">
								<div class="product-item">
									<div class="product-thumb">
										<?php $idproduk2 = $row2["id_produk"]; ?>
										<?php echo '<img src="data:image;base64,' .  base64_encode($row2['gambar'])  . '"style="height: 300px"   class="img-responsive"/>'; ?>
										<div class="preview-meta">
											<ul>
												<li>
													<button type="submit" style="background-color:transparent; border:0px" formaction="produk.php">
														<a href=""><i class="tf-ion-android-cart"></i></a>
													</button>
												</li>
											</ul>
				                      	</div>
									</div>
									<div class="product-content">
										<?php if ($row2["id_produk"] == $idproduk2): ?>
											<button type="submit" class="btn btn-link" name="edit" formaction="produk.php">
												<h4><?= $row2['nama_barang'] ?></h4>
												<p class="price">Rp <?= $row2['harga'] ?></p>
												<p class="price"> Rating : <?php if ($row2['jumlah_pembeli'] !=0)$rate = $row2['rating']/$row2['jumlah_pembeli'];else $rate=0; echo "$rate"; ?> Sold : <?= $row2['sold'] ?></p>
												<p class="price"> Tag : <?= $tag ?> </p>
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
			
		</div><br>	
		
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Recommendation Items For You</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
			if (isset($_SESSION['active'])){
			$idpembeli = $_SESSION['id'];
				$sql = "select * from tag_pembeli_item";
				$query = mysqli_query($conn,$sql);
				$d = null;
				while ($row=mysqli_fetch_array($query)) {
					if ($row['id_pembeli'] == $idpembeli){
						$d[] = $row;
					}
				}
				if ($d!= null){
					for ($i=0; $i < Count($d) ; $i++) { 
						for ($j=$i+1; $j < Count($d); $j++) { 
							if ($d[$i]['count'] < $d[$j]['count']){
								$temp = $d[$i];
								$d[$i] = $d[$j];
								$d[$j] = $temp;
							}
						}
					}
					for ($i=0; $i < Count($d); $i++) { 
						if ($i < 4){
							$sqlnama = "select * from tagitem";
							$querysql = mysqli_query($conn,$sqlnama);
							while ($row = mysqli_fetch_array($querysql)) {
								if ($row['id_tag']==$d[$i]['id_tag_item']){
									$nametag = $row['nama_tag'];
								}
							}
							echo "<div class='col-md-3'>";
							echo "<button class='btn btn-main btn-large item' id=$nametag>";
							echo $nametag;
							echo "</button>";
							echo "</div>";
						}
					}
				}
			}
			?>
		</div><br><br>
		<div class="row" >
			<div class="col-md-12" id="foritem">
				<br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Recommendation Animals For You</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
			if (isset($_SESSION['active'])){
				$sql = "select * from tag_pembeli_animal";
				$query = mysqli_query($conn,$sql);
				$a = null;
				while ($row=mysqli_fetch_array($query)) {
					if ($row['id_pembeli'] == $idpembeli){
						$a[] = $row;
					}
				}
				
				if ($a != null){
					for ($i=0; $i < Count($a) ; $i++) { 
						for ($j=$i+1; $j < Count($a); $j++) { 
							if ($a[$i]['count'] < $a[$j]['count']){
								$temp = $a[$i];
								$a[$i] = $a[$j];
								$a[$j] = $temp;
							}
						}
					}
					for ($i=0; $i < Count($a); $i++) { 
						if ($i < 4){
							$sqlnama = "select * from taganimal";
							$querysql = mysqli_query($conn,$sqlnama);
							while ($row = mysqli_fetch_array($querysql)) {
								if ($row['id_tag']==$a[$i]['id_tag_animal']){
									$nametag = $row['nama_tag'];
								}
							}
							echo "<div class='col-md-3'>";
							echo "<button class='btn btn-main btn-large animal'  id=$nametag>";
							echo $nametag;
							echo "</button>";
							echo "</div>";
						}
					}
				}
			}
			?>
		</div><br><br>
		<div class="row" >
			<div class="col-md-12" id="foranimal">
				<br><br>
			</div>
		</div>
		<div class="col-md-12">
			<div class="title text-center">
				<h2>Your History</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="tampilanProduk">
				<?php 	if (isset($_SESSION['active'])){ ?>
				<?php $sql = "select * from history order by id_history desc"; $query = mysqli_query($conn, $sql); ?>
				<?php foreach ($query as $rows): ?>
					<?php 	if ($rows['username_user'] == $username) {?>
						<?php 	$sql2 = "select * from produk_detail"; $query2 = mysqli_query($conn,$sql2); ?>
							<?php 	foreach ($query2 as $row2): ?>
								<?php 	if ($row2['id_produk'] == $rows['id_produk'] && $row2["status"] == 0){?>
									<form method="POST">
										<div class="col-md-4">
											<div class="product-item">
												<div class="product-thumb">
													<?php $idproduk2 = $row2["id_produk"]; ?>
													<?php echo '<img src="data:image;base64,' .  base64_encode($row2['gambar'])  . '"style="height: 300px"   class="img-responsive"/>'; ?>
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
													<?php if ($row2["id_produk"] == $idproduk2): ?>
														<button type="submit" class="btn btn-link" name="edit" formaction="produk.php">
															<h4><?= $row2['nama_barang'] ?></h4>
															<p class="price">Rp <?= $row2['harga'] ?></p>
															<p class="price"> Rating : <?php if ($row2['jumlah_pembeli'] !=0)$rate = $row2['rating']/$row2['jumlah_pembeli'];else $rate=0; echo "$rate"; ?> Sold : <?= $row2['sold'] ?></p>
														</button>
													<?php endif ?>
												</div>
											</div>
										</div>
										<input type="hidden" name="idproduk" value="<?php echo $idproduk2 ?>">
									</form>
								<?php 	} ?>
							<?php 	endforeach ?>
					<?php 	} ?>
				<?php endforeach ?>
			<?php 	} ?>
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
    		$('.item').click(function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"lihatitem",
    					tag: $(this).attr("id")
    				},
    				function (data) {
    					$("#foranimal").html("");
    					$("#foritem").html(data);
    				}
    			)
    		})
    		$('.animal').click(function () {
    			$.get(
    				"ajax.php",
    				{
    					mode:"lihatanimal",
    					tag: $(this).attr("id")
    				},
    				function (data) {
    					$("#foritem").html("");
    					$("#foranimal").html(data);
    				}
    			)
    		})
    	})
    </script>

  </body>
  </html>

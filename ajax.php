<?php 
session_start();
$conn = mysqli_connect("localhost","root","","yinyinpedia");
	require_once("db.php");
	if ($_GET['mode']=="tarik"){
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$username = $_GET['username'];
		$q = "update penjual set saldo = 0 where username_penjual = '$username'";
		$query = mysqli_query($conn,$q);
		echo '<ul class="user-profile-list" >';
  		$q = "select * from penjual where username_penjual ='$username'";
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
  		echo "
      	<li ><a id=tarik class='btn btn-main btn-medium btn-round-full'>Tarik</a></li>
      	<script type='text/javascript'>
      		$(document).ready(function () {
          		$('#tarik').click(function () {
          			$.get(
		 				'ajax.php',
		 				{
		 					mode:'tarik',
		 					username: <?php echo '$username'?>
		 				},
		 				function(data){
							$('#profile_details').html(data);
		 				}
		 			);
          		});
      		});
      		
      	</script>
      </ul>";
	}
  else if ($_GET['mode']=="sortpenjual"){
    $filterkategori = $_GET['filterkategori'];
    $idpenjual = $_GET['idpenjual']; 
    if (isset($_GET['rating']))$rating = $_GET['rating'];
    else $rating = 0;
    $kondisi1 = $_GET['kondisi'];
    if ($kondisi1 == null){
      $kondisi1 = "New"; $kondisi2 = "Used";
    }
    else {
      if ($kondisi1 == "New") {
        $kondisi2 = "New";
      }else{
        $kondisi2 = "Used";
      }
    }
    $tag1 = strtolower($_GET['text']);
    $tag = explode(" ", $tag1);
    $max = (int) $_GET['max'];
    $min = (int) $_GET['min'];
    if ($max == null){
      $max = 999999999999999999999999;
    }
    if ($min == null){
      $min = -999999999999999999999999;
    }
      $conn = mysqli_connect("localhost","root","","yinyinpedia");
      if (isset($_GET['by'])){
        if ($_GET['by'] == 1)
        $q1 = "select * from produk_detail order by harga" ;
        else if ($_GET['by'] == 2)
        $q1 = "select * from produk_detail order by harga desc" ;
        else if ($_GET['by'] == 3)
        $q1 = "select * from produk_detail order by id_produk desc" ;
      }
      else 
      {
          $q1 = "select * from produk_detail " ;
      }
      $query = mysqli_query($conn,$q1);
      while ($row = mysqli_fetch_array($query)){
        if ($row["id_penjual"] == $idpenjual){
          $idproduk = $row["id_produk"];
          $tagproduk = explode(" ", strtolower($row['tag']));
          if ($tag1 != null){
            $cek = 0; $hitung=0;
          }
          else $cek = 1;
          for ($i= 0; $i < count($tagproduk); $i++) { 
            for ($j=0; $j < count($tag); $j++) { 
               if ($tagproduk[$i] == $tag[$j]){
                  $cek = 1;
                  $hitung = $hitung + 1;
               }
            }
          }
          if ($row['jumlah_pembeli'] !=0)$rate = $row['rating']/$row['jumlah_pembeli'];
          else $rate=0; 
          if ($cek == 1  && $row['harga'] >= $min && $row['harga']<=$max &&$rate >= $rating && ($row['kondisi'] == $kondisi1 || $row['kondisi']== $kondisi2)){
            $sql1 = "select * from kategori";
            $query1 = mysqli_query($conn,$sql1);
            $cekkota =0;
            while ($row1 = mysqli_fetch_array($query1)){
              if ($row['id_kategori'] == $row1['id_kategori']){
                if ($filterkategori != null && $row1['nama_kategori']==$filterkategori){
                  $cekkota = 1;
                }
                else if ($filterkategori == null){
                  $cekkota = 1;
                }
              }
            }
            if ($cekkota == 1){
              echo"
              <form method='POST'>
                <div class='col-md-4' id= $row[id_produk] >
                  <div class='product-item'>
                    <div class='product-thumb'>
                      <img src='data:image;base64," .  base64_encode($row['gambar'])  . "' style='height: 200px'  class='img-responsive'/>
                      <div class='preview-meta'>
                        <ul>
                          <li>
                            <span  data-toggle='modal' data-target='#product-modal' onclick = 'diskusi( $row[id_produk] )'>
                              <i class='tf-ion-android-chat' ></i>
                            </span>
                          </li>
                          <li>
                            <span  data-toggle='modal' data-target='#product-modal' onclick='hapus( $row[id_produk] )'>
                              <i class='tf-ion-ios-trash' ></i>
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class=product-content>
                        <button type='submit' class='btn btn-link' name='edit' formaction='editproduk.php'>
                          <h4> $row[nama_barang]</h4>
                          <p class=price> $row[harga] </p>
                          <p class=price> Rating :  $rate Sold :  $row[sold] </p>
                        </button>
                    </div>
                  </div>
                </div>
                <input type=hidden name=idproduk value= $idproduk>
              </form>";
            }
          }
        }
      }

  }
  else if ($_GET['mode']=="forgot"){
    $username = $_GET['username'];
    $password = md5(strtolower($username));
    $conn = mysqli_connect("localhost","root","","yinyinpedia");
    $q = "update pembeli set password_user='$password' where username_user ='$username' ";
    $query = mysqli_query($conn,$q);
    $q = "update penjual set password_penjual='$password' where username_penjual ='$username' ";
    $query = mysqli_query($conn,$q);
  }
  else if ($_GET['mode'] == "maximumpembeli"){
    $idkategori =$_GET['kategori'];
    $city = $_GET['city'];
    if (isset($_GET['rating']))$rating = $_GET['rating'];
    else $rating = 0;
    $kondisi1 = $_GET['kondisi'];
    if ($kondisi1 == null){
      $kondisi1 = "New"; $kondisi2 = "Used";
    }
    else {
      if ($kondisi1 == "New") {
        $kondisi2 = "New";
      }else{
        $kondisi2 = "Used";
      }
    }
    $max = (int) $_GET['max'];
    $min = (int) $_GET['min'];
    if ($max == null){
      $max = 999999999999999999999999;
    }
    if ($min == null){
      $min = -999999999999999999999999;
    }

    $conn = mysqli_connect("localhost","root","","yinyinpedia");
    $tag1 = strtolower($_GET['text']);
    $tag = explode(" ", $tag1);

    if ($tag1 != null){
      for ($i=0; $i < count($tag); $i++) { 
        if ($idkategori == 1)
          $q = "select * from tagitem";
        else 
          $q = "select * from taganimal";
        $querys = mysqli_query($conn,$q);
        $update = 2;
        $namatag = $tag[$i];
        while ($rows=mysqli_fetch_array($querys)) {
            if ($rows['nama_tag'] == $namatag){
              $count = $rows['count_tag'];
              $idtag = $rows['id_tag'];
              $update = 1;
            }   
        } 
        if ($update == 1){
          $count = $count + 1;
          if ($idkategori == 1)
            $update = "update tagitem set count_tag=$count where id_tag = $idtag";
          else
            $update = "update taganimal set count_tag=$count where id_tag = $idtag";
          $queryupdate = mysqli_query($conn,$update);
        }else if ($update == 2){
          $namatag = $tag[$i];
           if ($idkategori == 1){
            $insert = "insert into tagitem values('','$namatag',1)";
            $queryinsert = mysqli_query($conn,$insert);
            $idtag = $conn->insert_id;
          }
          else{
            $insert = "insert into taganimal values('','$namatag',1)";
            $queryinsert = mysqli_query($conn,$insert);
            $idtag = $conn->insert_id;
          }
        }
        if (isset($_SESSION['active'])){
          $idpembeli = $_SESSION['id'];
          if ($idkategori == 1){
            $lihat = "select * from tag_pembeli_item";
            $querylihat = mysqli_query($conn,$lihat);
            $counter = -1;
            while ($row = mysqli_fetch_array($querylihat)) {
              if ($row['id_tag_item'] == $idtag && $row['id_pembeli']==$idpembeli){
                $counter = $row['count'];
              }
            }
            if ($counter > -1){
              $counter += 1;
              $sql = "update tag_pembeli_item set count=$counter where id_tag_item = $idtag && id_pembeli=$idpembeli";
              $query = mysqli_query($conn,$sql);
            }else{
              $sql = "insert into tag_pembeli_item values('',$idtag,$idpembeli,1)";
              $query = mysqli_query($conn,$sql);
            }
            
          }else {
            $lihat = "select * from tag_pembeli_animal";
            $querylihat = mysqli_query($conn,$lihat);
            $counter = -1;
            while ($row = mysqli_fetch_array($querylihat)) {
              if ($row['id_tag_animal'] == $idtag && $row['id_pembeli']==$idpembeli){
                $counter = $row['count'];
              }
            }
            if ($counter > -1){
              $counter += 1;
              $sql = "update tag_pembeli_animal set count=$counter where id_tag_animal = $idtag && id_pembeli=$idpembeli";
              $query = mysqli_query($conn,$sql);
            }else{
              $sql = "insert into tag_pembeli_animal values('',$idtag,$idpembeli,1)";
              $query = mysqli_query($conn,$sql);
            }
          }
        }
      }
    }
    if (isset($_GET['by'])){
        if ($_GET['by'] == 1)
        $q1 = "select * from produk_detail where id_kategori = $idkategori order by harga" ;
        else if ($_GET['by'] == 2)
        $q1 = "select * from produk_detail where id_kategori = $idkategori order by harga desc" ;
        else if ($_GET['by'] == 3)
        $q1 = "select * from produk_detail where id_kategori = $idkategori order by id_produk desc" ;
    }
    else 
    {
        $q1 = "select * from produk_detail where id_kategori = $idkategori " ;
    }
    $query = mysqli_query($conn,$q1);
    while($row = mysqli_fetch_array ($query)){

        $idproduk = $row['id_produk']; 
        $tagproduk = explode(" ", strtolower($row['tag']));
        if ($tag1 != null){
          $cek = 0; $hitung=0;
        }
        else $cek = 1;
        for ($i= 0; $i < count($tagproduk); $i++) { 
          for ($j=0; $j < count($tag); $j++) { 
             if ($tagproduk[$i] == $tag[$j]){
                $cek = 1;
                $hitung = $hitung + 1;
             }
          }
        }
        if ($row['jumlah_pembeli'] !=0)$rate = $row['rating']/$row['jumlah_pembeli'];
        else $rate=0; 
        //utk search 2"nya $hitung>=count($tag)
        if ($cek == 1 && $row['status'] == 0 && $row['harga'] >= $min && $row['harga']<=$max &&$rate >= $rating && ($row['kondisi'] == $kondisi1 || $row['kondisi']== $kondisi2)){
          $sql1 = "select * from penjual";
          $query1 = mysqli_query($conn,$sql1);
          $cekkota =0;
          while ($row1 = mysqli_fetch_array($query1)){
            if ($row['id_penjual'] == $row1['id_penjual']){
              if ($city != null && $row1['kota_penjual']==$city){
                $cekkota = 1;
              }
              else if ($city == null){
                $cekkota = 1;
              }
            }
          }
          if ($cekkota == 1){
            echo "
            <form method='POST'>
              <div class='col-md-4'>
                <div class='product-item'>
                  <div class='product-thumb'>
                    
                    <img src='data:image;base64,".base64_encode($row['gambar'])."' style='height: 200px'  class='img-responsive'/>
                    <div class='preview-meta'>
                      <ul>
                        <li>
                          <button type='submit' formaction='produk.php' style='background-color:transparent; border:0px'>
                            <a href=''><i class='tf-ion-android-cart'></i></a>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class='product-content'>
                     
                      <button type='submit' class='btn btn-link' name='edit' formaction='produk.php'>
                        <h4>$row[nama_barang]</h4>
                        <p class='price'>Rp $row[harga] </p>
                        <p class='price'> Rating : $rate Sold : $row[sold] </p>
                      </button>
                  </div>
                </div>
              </div>
              <input type=hidden name=idproduk value= $idproduk>
            </form>";
          }
        }
    }
  }
  else if ($_GET['mode']=="remove"){
    $idcart = $_GET['idcart'];
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value->id == $idcart){
        unset($_SESSION['cart'][$key]);
      }
    }
    $total = 0;
    if (isset($_SESSION['cart'])){
      foreach ($_SESSION['cart'] as $key => $value) {
        echo "<tr class=''>";
        echo "<td class=''>";
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
        echo "<td class=''> $value->jumlah</td>";
        echo "<td class=''>Rp $datacart[harga]</td>";
        $subtotal = $value->jumlah * $datacart['harga'];
        $total = $total +($value->jumlah * $datacart['harga']);
        echo "<td class=''> $subtotal </td>";
        $idcart = $value->id;
        echo "<td class=''>
                  <button class='remove btn btn-main btn-medium btn-round-full  btn-icon' id='$idcart' onclick='removecart($idcart)'>Remove</button>
                </td>";
        echo "</tr>";
      }
    }
    if (count($_SESSION['cart'])==0){
      unset($_SESSION['cart']);
      echo " <tr class=''> 
      <td class=''>Empty</td>
          <td class=''>0</td>
          <td class=''>Rp 0</td>
          <td class=''>Rp 0</td>
          <td class=''>-</td>
          </tr>";
    }

    echo "<tr class=''>
                      <td class=''>
                      </td>
                      <td class=''></td>
                      <td class=''>Total : </td>
                      <td class=''>Rp $total
                      </td>
                      <td class=''></td>
                    </tr>";

  }
  else if($_GET['mode']=='cBoxDelivery'){
    $namaPengiriman = $_GET['namaDelivery'];
    $beratBarang = $_GET['beratTotalBarang'];
    $subtotal = $_GET['subtot'];
    $promo = 0;
    $harga = 0;
    $promo1;
    $promo2;
    $promo3;
    
    $que = "SELECT * FROM jasa_pengiriman WHERE nama_jasa = '$namaPengiriman'";
    $query = mysqli_query($conn,$que);
    while ($row = mysqli_fetch_array($query)) {
      $harga = $row['harga_per_kilo']*$beratBarang;
      $promo1 = $row['promo1'];
      $promo2 = $row['promo2'];
      $promo3 = $row['promo3'];
    }

    if($namaPengiriman == "JNE Reguler"){
      if ($beratBarang > $promo1) {
        $promo = $beratBarang * 100;
        if ($beratBarang > $promo2) {
          $promo = $beratBarang * 200;
          if ($beratBarang > $promo3) {
            $promo = $beratBarang * 300;
          }
        }
      }
    }else if($namaPengiriman == "JNE Trucking"){
      if ($beratBarang > $promo1) {
        $promo = $beratBarang * 150;
        if ($beratBarang > $promo2) {
          $promo = $beratBarang * 250;
          if ($beratBarang > $promo3) {
            $promo = $beratBarang * 300;
          }
        }
      }
    }else if($namaPengiriman == "JNE YES"){
      if ($beratBarang > $promo1) {
        $promo = $beratBarang * 250;
        if ($beratBarang > $promo2) {
          $promo = $beratBarang * 500;
          if ($beratBarang > $promo3) {
            $promo = $beratBarang * 750;
          }
        }
      }
    }else if($namaPengiriman == "J&T Express"){
      if ($beratBarang > $promo1) {
        $promo = $beratBarang * 400;
        if ($beratBarang > $promo2) {
          $promo = $beratBarang * 600;
          if ($beratBarang > $promo3) {
            $promo = $beratBarang * 800;
          }
        }
      }
    }else if($namaPengiriman == "Si Cepat"){
      if ($beratBarang > $promo1) {
        $promo = $beratBarang * 50;
        if ($beratBarang > $promo2) {
          $promo = $beratBarang * 100;
          if ($beratBarang > $promo3) {
            $promo = $beratBarang * 150;
          }
        }
      }
    }
    $total = $subtotal + $harga - $promo;
    $_SESSION['subtotal'] = $subtotal;
    $_SESSION['shipping'] = $harga;
    $_SESSION['promo'] = $promo;
    $_SESSION['total'] = $total;
    echo '<ul class="summary-prices">
    <li>
    <span>Subtotal:</span>
    <span class="price">Rp '.$subtotal.'</span>
    </li>
    <li>
    <span>Shipping:</span>
    <span>Rp '.$harga.'</span>
    </li>
    <li>
    <span>Promo:</span>
    <span>- Rp '.$promo.'</span>
    </li>
    </ul>
    <div class="summary-total">
    <span>Total</span>
    <span>Rp '.$total.' </span>
    </div>';
    }
    else if($_GET['mode']=='acceptOrder'){
      $idDetailBarang = $_GET['idDetailBarang'];
      $queryCekStock = "SELECT p.stock, d.jumlah, d.id_barang FROM dtransaction d, produk_detail p WHERE d.no_detail = '$idDetailBarang' AND d.id_barang = p.id_produk";
      $cariStock = mysqli_query($conn, $queryCekStock);

      while ($row = mysqli_fetch_array($cariStock)) {
        $stockBarang = $row['stock'];
        $jumlahBarang = $row['jumlah'];
        $idBarang = $row['id_barang'];
      }
      if ($stockBarang >= $jumlahBarang){
        $queryUpdateAccept = "UPDATE dtransaction SET status = 'accepted' WHERE no_detail = '$idDetailBarang'";
        $jalan = mysqli_query($conn, $queryUpdateAccept);
        echo 'true';

        $currentStock = $stockBarang - $jumlahBarang;
        $queryUpdateStock = "UPDATE produk_detail SET stock = $currentStock WHERE id_produk = '$idBarang'";
        $jalanUpdate = mysqli_query($conn, $queryUpdateStock);
      }else{
        echo 'false';
      }
    }
    else if($_GET['mode']=='declineOrder'){
      $idDetailBarang = $_GET['idDetailBarang'];
      $jumlahBarang = $_GET['jumlahBarang'];
      $queryUpdateDecline = "UPDATE dtransaction SET status = 'declined' WHERE no_detail = '$idDetailBarang'";
      $jalan = mysqli_query($conn, $queryUpdateDecline);

      $queryGetOldPrice = "SELECT h.subtotal, h.shipping, h.promo, h.total, j.nama_jasa, j.harga_per_kilo, p.harga, p.berat, j.promo1, j.promo2, j.promo3, h.no_nota
                          FROM dtransaction d, htransaction h , produk_detail p, jasa_pengiriman j 
                          WHERE d.no_detail = '$idDetailBarang' AND d.no_nota = h.no_nota AND d.id_barang = p.id_produk AND j.id_jasa = h.id_pengiriman";
      $getOldPrice = mysqli_query($conn, $queryGetOldPrice);
      while ($row = mysqli_fetch_array($getOldPrice)) {
        $delivery = $row['id_pengiriman'];
        $oldSubtotal = $row['subtotal'];
        $oldShipping = $row['shipping'];
        $namaShipping = $row['nama_jasa'];
        $pricePerKg = $row['harga_per_kilo'];
        $oldPromo = $row['promo'];
        $oldTotal = $row['total'];
        $pricePerPiece = $row['harga'];
        $beratPerPiece = $row['berat'];
        $promo1 = $row['promo1'];
        $promo2 = $row['promo2'];
        $promo3 = $row['promo3'];

        $nomerNota = $row['no_nota'];
      }
      echo "<script>alert('.$nomerNota.')</script>";
      if($namaShipping == "JNE Reguler"){
        if ($beratPerPiece > $promo1) {
          $cutPromo = $beratBarang * 100;
          if ($beratPerPiece > $promo2) {
            $cutPromo = $beratBarang * 200;
            if ($beratPerPiece > $promo3) {
              $cutPromo = $beratBarang * 300;
            }
          }
        }
      }else if($namaShipping == "JNE Trucking"){
        if ($beratPerPiece > $promo1) {
          $cutPromo = $beratBarang * 150;
          if ($beratPerPiece > $promo2) {
            $cutPromo = $beratBarang * 250;
            if ($beratPerPiece > $promo3) {
              $cutPromo = $beratBarang * 300;
            }
          }
        }
      }else if($namaShipping == "JNE YES"){
        if ($beratPerPiece > $promo1) {
          $cutPromo = $beratBarang * 250;
          if ($beratPerPiece > $promo2) {
            $cutPromo = $beratBarang * 500;
            if ($beratBarang > $promo3) {
              $cutPromo = $beratBarang * 750;
            }
          }
        }
      }else if($namaShipping == "J&T Express"){
        if ($beratPerPiece > $promo1) {
          $cutPromo = $beratBarang * 400;
          if ($beratPerPiece > $promo2) {
            $cutPromo = $beratBarang * 600;
            if ($beratPerPiece > $promo3) {
              $cutPromo = $beratBarang * 800;
            }
          }
        }
      }else if($namaShipping == "Si Cepat"){
        if ($beratPerPiece > $promo1) {
          $cutPromo = $beratBarang * 50;
          if ($beratPerPiece > $promo2) {
            $cutPromo = $beratBarang * 100;
            if ($beratPerPiece > $promo3) {
              $cutPromo = $beratBarang * 150;
            }
          }
        }
      }
      $newSubtotal = $oldSubtotal - ($pricePerPiece * $jumlahBarang);
      $newShipping = $oldShipping - ($beratPerPiece * $pricePerKg);
      $newPromo = $oldPromo - $cutPromo;
      $newTotal = $newSubtotal + $newShipping - $newPromo;

      $queryUpdateHargaBaru = "UPDATE htransaction SET subtotal = $newSubtotal, shipping = $newShipping, promo = $newPromo, total = $newTotal WHERE no_nota = $nomerNota";
      $updateNewPrice = mysqli_query($conn, $queryUpdateHargaBaru);
    }
    else if($_GET['mode']=='detailNota'){
      $noNota = $_GET['nomerNota'];
      $idSeller = $_GET['idSeller'];
      
      $sqlCetakBarang = "SELECT p.gambar, p.nama_barang, p.harga, d.status, d.review, d.ratingKah FROM htransaction h, dtransaction d, produk_detail p, penjual pen WHERE h.no_nota = d.no_nota AND d.id_barang = p.id_produk AND p.id_penjual = pen.id_penjual AND h.no_nota = $noNota AND pen.id_penjual = $idSeller";
      $queryCetakBarang = mysqli_query($conn, $sqlCetakBarang);

      while($row = mysqli_fetch_array($queryCetakBarang)){
        $gambarBarang = $row['gambar'];
        $namaBarang = $row['nama_barang'];
        $hargaBarang = $row['harga'];
        $statusBarang = $row['status'];
        $review = $row['review'];
        $ratingKah = $row['ratingKah'];
  
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
          echo '<div class="col-md-4">';
            echo 'Rating : '.$ratingKah.'<br>';
            echo 'Comment : '.$review;
          echo '</div>';
        echo '</div>';
      }
    }else if($_GET['mode']=='terimaBarang'){
      $nomorBarang = $_GET['nomorBarang'];
      $sqlUpdateStatusBarangPembeli = 'UPDATE dtransaction SET status = diterima WHERE no_detail = $'.$nomorBarang.'';
      $queryUpdateStatusBarang = mysqli_query($conn, $sqlUpdateStatusBarangPembeli);
    }else if ($_GET['mode'] == "lihatitem"){
      $tag = strtolower($_GET['tag']);
      $sql = "select * from produk_detail where tag like '%$tag%' and id_kategori = 1 order by rating desc";
      $query = mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_array($query)) {
        $data[] = $row;
      }
      $k = 1;
      for ($i=0; $i < count($data); $i++) { 
        if ($k <= 9){
           if ($data[$i]['status'] == 0){
              echo "<form method='POST'>
                    <div class='col-md-4'>
                      <div class='product-item'>
                        <div class='product-thumb'>";
              $idproduk2 = $data[$i]['id_produk'];
              echo '<img src="data:image;base64,' .  base64_encode($data[$i]['gambar'])  . '"style="height: 300px"   class="img-responsive"/>';
              echo "<div class=preview-meta>
                            <ul>
                              <li>
                                <button type='submit' formaction='produk.php' style='background-color:transparent; border:0px'>
                                  <a href=''><i class='tf-ion-android-cart'></i></a>
                                </button>
                              </li>
                            </ul>
                                      </div>
                        </div>
                        <div class=product-content>";   
              echo "<button type=submit class='btn btn-link' name=edit formaction=produk.php>
                              <h4> ".$data[$i]['nama_barang']." </h4>
                              <p class=price>Rp ". $data[$i]['harga'] ."</p>
                              <p class=price> Rating : "; 
                              if ($data[$i]['jumlah_pembeli'] !=0)$rate = $data[$i]['rating']/$data[$i]['jumlah_pembeli'];
                              else $rate=0; 
                              echo "$rate"; 
                              echo " Sold :  ".$data[$i]['sold']." </p>
                            </button>";    
              echo "</div>
                      </div>
                    </div>
                    <input type=hidden name=idproduk value=$idproduk2 >
                  </form>";   
           }
        }
      }
    }else if ($_GET['mode'] == "lihatanimal"){
      $tag = strtolower($_GET['tag']);
      $sql = "select * from produk_detail where tag like '%$tag%' and id_kategori = 2 order by rating desc";
      $query = mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_array($query)) {
        $data[] = $row;
      }
      $k = 1;
      for ($i=0; $i < count($data); $i++) { 
        if ($k <= 9){
           if ($data[$i]['status'] == 0){
              echo "<form method='POST'>
                    <div class='col-md-4'>
                      <div class='product-item'>
                        <div class='product-thumb'>";
              $idproduk2 = $data[$i]['id_produk'];
              echo '<img src="data:image;base64,' .  base64_encode($data[$i]['gambar'])  . '"style="height: 300px"   class="img-responsive"/>';
              echo "<div class=preview-meta>
                            <ul>
                              <li>
                                <button type='submit' formaction='produk.php' style='background-color:transparent; border:0px'>
                                  <a href=''><i class='tf-ion-android-cart'></i></a>
                                </button>
                              </li>
                            </ul>
                                      </div>
                        </div>
                        <div class=product-content>";   
              echo "<button type=submit class='btn btn-link' name=edit formaction=produk.php>
                              <h4> ".$data[$i]['nama_barang']." </h4>
                              <p class=price>Rp ". $data[$i]['harga'] ."</p>
                              <p class=price> Rating : "; 
                              if ($data[$i]['jumlah_pembeli'] !=0)$rate = $data[$i]['rating']/$data[$i]['jumlah_pembeli'];
                              else $rate=0; 
                              echo "$rate"; 
                              echo " Sold :  ".$data[$i]['sold']." </p>
                            </button>";    
              echo "</div>
                      </div>
                    </div>
                    <input type=hidden name=idproduk value=$idproduk2 >
                  </form>";   
           }
        }
      }
    }
 ?>
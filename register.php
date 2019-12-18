<?php 
    session_start();
    $defaultLink = "rss\PP\avatar.png";
    require_once "db.php";
    $cekfoto = $_SESSION['cekFoto'];
    if(isset($_SESSION['active'])){
        unset($_SESSION['active']);
    }
    else if (isset($_POST['register'])){

        if ($_POST['first'] != "" && $_POST['last'] != "" && $_POST['username'] && $_POST['email'] != "" && $_POST['address'] != "" && $_POST['password'] != "" && $_POST['phone'] != "" && $_POST['tipe'] != "" &&$_POST['city']!= ""){
            $first = $_POST['first'];
            $last = $_POST['last'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $pass = $_POST['password'];
            $phone = $_POST['phone'];
            $tipe = $_POST['tipe'];
            $name = $first." ".$last;
            $city = strtolower( $_POST['city']);
            if (isset($_POST['namatoko'])){
                if ($_POST['namatoko']!=""){
                  $namatoko = $_POST['namatoko'];
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    echo "<script type='text/javascript'> alert ('$emailErr') ;</script>";
                  }
                  else {
                      $data = get_all_pembeli();
                      $data1 = get_all_penjual();
                      $cek = true;
                      for ($i=0; $i < count($data); $i++) { 
                          if ($data[$i]["email_user"] == $email || $data[$i]["username_user"] == $username) {
                              $cek = false;
                          }         
                      }
                      for ($i=0; $i < count($data1); $i++) { 
                          if ($data1[$i]["email_penjual"] == $email || $data1[$i]["username_penjual"] == $username || $data1[$i]['nama_toko'] == $namatoko) {
                              $cek = false;
                          }         
                      }
                      if ($cek) {
                        if ($_FILES['imgupload']['tmp_name'] != null){
                          $profile = addslashes(file_get_contents($_FILES['imgupload']['tmp_name']));
                          $_SESSION['cekFoto'] = 0;
                        }
                        else {
                            $profile = addslashes(file_get_contents("gambar/default.png"));
                        }
                        $pass = md5($pass);
                        if ($tipe == "customer") insert_pembeli($username,$name,$pass,$email,$address,$city,$phone,$profile);
                        else insert_penjual($username,$name,$namatoko,$pass,$email,$address,$city,$phone,$profile);
                      }
                  }
                }
                else{
                  $mess = "DATA TIDAK VALID";
                  echo "<script type='text/javascript'> alert ('$mess');</script>";
                }          
            }
            else {
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                echo "<script type='text/javascript'> alert ('$emailErr') ;</script>";
              }
              else {
                  $data = get_all_pembeli();
                  $data1 = get_all_penjual();
                  $cek = true;
                  for ($i=0; $i < count($data); $i++) { 
                      if ($data[$i]["email_user"] == $email || $data[$i]["username_user"] == $username) {
                          $cek = false;
                      }         
                  }
                  for ($i=0; $i < count($data1); $i++) { 
                      if ($data1[$i]["email_penjual"] == $email || $data1[$i]["username_penjual"] == $username) {
                          $cek = false;
                      }         
                  }
                  if ($cek) {
                    if ($_FILES['imgupload']['tmp_name'] != null){
                      $profile = addslashes(file_get_contents($_FILES['imgupload']['tmp_name']));
                      $_SESSION['cekFoto'] = 0;
                    }
                    else {
                        $profile = addslashes(file_get_contents("gambar/default.png"));
                    }
                    $pass = md5($pass);
                    if ($tipe == "customer") insert_pembeli($username,$name,$pass,$email,$address,$city,$phone,$profile);
                    else insert_penjual($username,$name,$namatoko,$pass,$email,$address,$city,$phone,$profile);
                  }
              }
            }
            
            
        }else{
            $mess = "DATA TIDAK VALID";
            echo "<script type='text/javascript'> alert ('$mess');</script>";

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
    img{
        border-radius: 50%;
        background-color: black;
        width: 100px;
        height: 100px;
        margin-left: 41% ;
    }
    #imgupload{
        margin-left: 41% ;
    }
   </style>
   <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewFoto = document.getElementById("openImg");
                    previewFoto.src = e.target.result;
                    <?php 
                        $_SESSION['cekFoto'] = 1;
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

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.php">
              YinYinPedia
          </a>
          <h2 class="text-center">Create Your Account</h2>
          <form class="text-left clearfix" method="post" enctype="multipart/form-data" id=formregister>
          
            <div class="md-form mt-0">
              <div class="col">
                <img src="<?php echo"$defaultLink"?>" alt="Profile Picture" id="openImg"><br>
                <input type="file" id="imgupload" name="imgupload"><br>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name=first  placeholder="First Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name=last  placeholder="Last Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name=username  placeholder="Username">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name=email placeholder="Email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name=address  placeholder="Address">
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  name=password placeholder="Password">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name=phone  placeholder="Phone Number"><br> 
              City
              <select class="browser-default form-control custom-select" name="city">
                    <option disabled selected>City</option>
                    <option value="Aceh">Aceh</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Surakarta">Surakarta</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                    <option value="Solo">Solo</option>
                    <option value="Banjarmasin">Banjarmasin</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Bau Bau">Bau Bau</option>
                    <option value="Tanjung Pinang">Tanjung Pinang</option>
                    <option value="Banten">Banten</option>
                </select> 
            </div>
            <div class="form-group" name=tipe>
              <select class="browser-default custom-select form-control" name=tipe id=tipe>
                <option disabled selected>User Type</option>
                <option value="customer">Customer</option>
                <option value="seller">Seller Toko</option>
              </select>
            </div>
            <div class=form-group id=untuknamatoko>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center" name="register">Register</button>
            </div>
          </form>
          <p class="mt-20">Already hava an account ?<a href="login.php"> Login</a></p>
          <!-- <p><a href="forget-password.php"> Forgot your password?</a></p> -->
        </div>
      </div>
    </div>
  </div>
</section>

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
      $(document).ready(function () {
        $("#tipe").on("change",function(){
          if(this.selectedIndex == 2){
            $("#untuknamatoko").append("<input type='text' class='form-control' name=namatoko id=namatoko placeholder='Nama Toko'>")
          }else {
            $('#namatoko').remove();
          }
        });
      });
    </script>


  </body>
  </html>
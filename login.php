<?php 
    session_start();
    require_once("db.php");
    if(isset($_SESSION['active'])){
        unset($_SESSION['active']);
    }
    if (isset($_POST['signin'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $data = get_a_pembeli($username);
        $data1 = get_a_penjual($username);
        if ($data == null && $data1 == null){
            $mess = "USER TIDAK TERDAFTAR";
            echo "<script type='text/javascript'> alert ('$mess') ;</script>";
        }else{
            if ($data==null){
                $tipe = "penjual";
                $p = $data1[0]['password_penjual'];
                if ($p == $password){
                    $_SESSION['active'] = $username;
                    $_SESSION['id'] = $data1[0]['id_penjual'];
                    $_SESSION['nama_toko'] = $data1[0]['nama_toko'];
                    $_SESSION['tipe'] = "penjual";
                    $_SESSION['profile'] = $data1[0]['profile'];
                    header("Location: homepageseller.php");
                }else{
                    $mess = "PASSWORD SALAH";
                    echo "<script type='text/javascript'> alert ('$mess') ;</script>";
                }
            }else {
                $tipe = "pembeli";
                $p = $data[0]['password_user'];
                if ($p == $password){
                    $_SESSION['active'] = $username;
                    $_SESSION['id'] = $data[0]['id_user'];
                    $_SESSION['tipe'] = "pembeli";
                    $_SESSION['profile'] = $data[0]['profile'];
                    header("Location: index.php");
                }else{
                    $mess = "PASSWORD SALAH";
                    echo "<script type='text/javascript'> alert ('$mess') ;</script>";
                }   
            }
        }
    }
    else if(isset($_POST['coba']))
    {
        header("Location:coba.php");
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

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.php">
              YinYinPedia
          </a>
          <h2 class="text-center">Welcome Back</h2>
          <form class="text-left clearfix" action="" method="post" >
            <div class="form-group">
              <input type="text" class="form-control"  placeholder="Username" name="username" id=username>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center" name="signin">Login</button>
            </div>
          </form>
          <p class="mt-20">New in this site ?<a href="register.php"> Create New Account</a></p>
          <p id=forgot><a href=""> Forgot your password?</a></p>
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
        $(document).ready(function() {
          $('#forgot').click(function () {
            alert("password diganti dengan username huruf kecil");
            $.get(
              "ajax.php",
              {
                mode:"forgot",
                username:$('#username').val()
              },
              function (data) {

              }
            );
          });
        });
    </script>

  </body>
  </html>
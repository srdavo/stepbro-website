<?php 
define('BASE_URL', '/');
include $_SERVER['DOCUMENT_ROOT'] . BASE_URL .'controllers/auth_controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . BASE_URL .'config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . BASE_URL ."config/session.php";

include_once  $_SERVER['DOCUMENT_ROOT'] . BASE_URL .'config/cookies.php';
cookiesRedirect($cookie_uid, "$_SERVER[REQUEST_URI]");

checkSession($cookie_uid);

// if(!isset($_SESSION["id"])){
//     echo "<span style='opacity:0.5;position:absolute;top:0;left:0;z-index:10000;color:white;background:red;'>La sesión No existe </span>";
//   }else{
//     echo "<span style='opacity:0.5;position:absolute;top:0;left:0;z-index:10000;color:white;background:green;'>La sesión Sí existe </span>";
//     echo "<span style='opacity:0.5;position:absolute;top:24px;left:0;z-index:10000;color:white;background:green;'>UserId:".$_SESSION['id']."</span>";
//   }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $_ENV['APP_NAME'] ?></title>
    <script> const BASE_URL = "<?= BASE_URL ?>"</script>
    

    <!-- style and themes -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/theme/theme.css?v=15">
    <link id="theme-style" rel="stylesheet" href="<?= BASE_URL ?>css/theme/colors/black.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="<?= BASE_URL ?>js/theme.js"></script>
    
    <!-- Material Web Components -->
    <script src="<?= BASE_URL?>js/bundle.js"></script>


    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="<?=BASE_URL?>assets/icon.png">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> -->

    <!-- Manifest -->
    <link rel="manifest" href="<?= BASE_URL?>config/site.webmanifest" >

    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Theme selector -->
    <!-- <script src="js/theme-controller.js"></script> -->

    

    <!-- fonts / icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/Flip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/CustomEase.min.js"></script>
  </head>
<body>
<transparent>
  <?php
    if(isset($_SESSION['id'])){
      include_once $_SERVER['DOCUMENT_ROOT'] . BASE_URL .'views/windows/window-settings.php';
    } 
  ?>
</transparent>
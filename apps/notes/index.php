<?php 
include_once '../../views/partials/__header.php'; 
// include_once 'config/cookies.php';
if(!isset($_SESSION["id"])){
  echo "<span style='position:absolute;top:0;left:0;z-index:10000;color:white;background:red;'>La sesión No existe </span>";
}else{
  echo "<span style='position:absolute;top:0;left:0;z-index:10000;color:white;background:green;'>La sesión Sí existe </span>";
  echo "<span style='position:absolute;top:24px;left:0;z-index:10000;color:white;background:green;'>UserId:".$_SESSION['id']."</span>";
}
// cookiesRedirect($cookie_uid);
?>


<main>
  <nav >
    <?php include_once 'views/index/index-__navbar_items.php'; ?>
  </nav>
  <holder>
    <?php include_once 'views/index/index-sections.php'; ?>  
  </holder>
</main>


<?php 
include_once '../../views/partials/__footer.php'; 
?>
<?php 
include_once '../../views/partials/__header.php'; 
include_once '../../config/utilities.php';
if(!isset($_SESSION["id"])){
  echo "<span style='position:absolute;top:0;left:0;z-index:10000;color:white;background:red;'>La sesión No existe </span>";
}else{
  echo "<span style='position:absolute;top:0;left:0;z-index:10000;color:white;background:green;'>La sesión Sí existe </span>";
  echo "<span style='position:absolute;top:24px;left:0;z-index:10000;color:white;background:green;'>UserId:".$_SESSION['id']."</span>";
}
?>

<transparent>
  <?php include_once "views/windows.php"; ?>
</transparent>

<main>
  <nav class="nav-style-3">
    <?php include_once 'views/partials/__navbar_items.php'; ?>
  </nav>
  <holder>
    <!-- <div class="simple-container" style="position:absolute; bottom:16px; right:16px; z-index:1">
      <md-fab label="Iniciar servicio" variant="primary" onclick="toggleWindow('#window-start-operation', '', 1)" data-flip-id="animate">
        <md-icon slot="icon">content_cut</md-icon>
      </md-fab>
    </div> -->
    <?php include_once 'views/sections.php'; include_once 'views/modals/dialogs.php'; ?>  
  </holder>
</main>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    getUserData();
    syncCalories()
  });
</script>


<?php 
include_once '../../views/partials/__footer.php'; 
?>
<?php 
include_once 'views/partials/__header.php'; 
?>

<transparent>
  <?php include_once "views/index/index-windows.php"; ?>
</transparent>
<main class="direction-column">
  <nav class="nav-style-4">
    <?php include_once 'views/index/index-__navbar_items.php'; ?>
  </nav>
  <holder>
    <?php include_once 'views/index/index-sections.php'; ?>  
  </holder>
</main>


<?php 
include_once 'views/partials/__footer.php'; 
?>
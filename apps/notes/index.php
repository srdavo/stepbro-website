<?php 
include_once '../../views/partials/__header.php'; 
?>
<link rel="manifest" href="config/site.webmanifest" >

<transparent>
  <?php include_once 'views/index/index-windows.php'; ?>
</transparent>

<main class="direction-column">
  <nav class="nav-style-5 justify-center">
    <?php include_once 'views/index/index-__navbar_items.php'; ?>
  </nav>
  <holder>
    <?php include_once 'views/index/index-sections.php'; ?>  
  </holder>
</main>


<?php 
include_once '../../views/partials/__footer.php'; 
?>
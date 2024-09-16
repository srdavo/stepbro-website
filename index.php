<?php 
include_once 'views/partials/__header.php'; 
include_once 'config/cookies.php';
cookiesRedirect($cookie_uid);
?>


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
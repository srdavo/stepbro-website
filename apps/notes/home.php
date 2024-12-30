<?php 
include_once '../../views/partials/__header.php'; 
include_once '../../config/utilities.php';
include_once '../../email/email_functions.php';
?>


<transparent>
  <?php include_once "views/windows.php"; ?>
</transparent>

<main>
  <nav class="nav-style-2" id="nav-parent">
    <?php include_once 'views/partials/__navbar_items.php'; ?>
  </nav>
  <holder>
    <!-- <div class="simple-container" style="position:absolute; bottom:16px; right:16px; z-index:1">
      <md-fab label="Iniciar servicio" variant="primary" onclick="toggleWindow('#window-start-operation', '', 1)" data-flip-id="animate">
        <md-icon slot="icon">content_cut</md-icon>
      </md-fab>
    </div> -->
    <?php 
      include_once 'views/modals/dialogs.php'; 
      include_once 'views/sections.php'; 
      ?>  
  </holder>
</main>

<script src="js/notes-functions.js?v=1.7.0"></script>
<script src="js/diary-functions.js?v=1.5.0"></script>
<script src="js/folders-functions.js?v=1.5.0"></script>
<script src="js/drag-functions.js?v=7"></script>
<script src="js/tasks-functions.js?v=7"></script>
<script src="js/rich-text.js?v=7"></script>
<script src="js/register-access.js?v=7"></script>
<script src="js/search-functions.js?v=1.5.0"></script>


<!-- Prubas de neuvo editor de texto -->
<!-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> -->

<script>
  
  document.addEventListener("DOMContentLoaded", function(event) {
      syncFolders();
      syncTasks();
      registerAccess();
      setDefaultMonth();
      startDiary();
  });
</script>


<?php 
include_once '../../views/partials/__footer.php'; 
?>
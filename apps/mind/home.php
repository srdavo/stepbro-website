<?php 
include_once '../../views/partials/__header.php'; 
include_once '../../config/utilities.php';
?>
<script src="../../components/cocounut-chart.js"></script>

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
      include_once 'views/dialogs/dialogs.php'; 
      include_once 'views/sections.php'; 
    ?>  
  </holder>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    // let patientsList = PatientsManager.getPatients();
    // console.log(patientsList);

    // PatientsManager.displayPatientsTable(0, false, PatientsManager.patientsList)

    
  });
</script>

<script src="js/main.js?v=2" type="module"></script>


<!-- <script src="js/patients-functions.js?v=1.0.3"></script> -->
<script src="js/permissions-functions.js?v=1.0.0"></script>
<!-- <script src="js/appointments-functions.js?v=1.0.1"></script> -->



<?php 
include_once '../../views/partials/__footer.php'; 
?>
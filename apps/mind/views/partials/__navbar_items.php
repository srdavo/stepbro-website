<span class="position-relative">

  <button 
    class="nav-button hide-on-mobile" 
    onclick="toggleMenu('menu-app-options')" 
    id="toggler-menu-app-options"
    data-flip-id="animate"
    >
    <md-ripple></md-ripple>
    <span class="icon-holder" >
      <?php 
        if(isset($_SESSION["additional_data"])){
            if($_SESSION["additional_data"]["profile_picture"] != ""){
                $picture = $_SESSION["additional_data"]["profile_picture"];
                echo "<span class='simple-container overflow-hidden border-radius-64 header-account-circle'><img class='width-100' src='$picture'></span>";
            }else{
                echo '
                    <span
                      class="header-account-circle" 
                      id="response-header-account-username-first-letter"
                    ></span>
                ';
            }
        }
      ?>
      
    </span>
    <span>stepbro</span>
  </button> 

  <md-menu id="menu-app-options" style="min-width:264px;" anchor="toggler-menu-app-options">
    <md-menu-item onclick="toggleWindow('#window-settings')" data-flip-id="animate">
      <md-icon slot="start" aria-hidden="true">settings</md-icon>
      <div slot="headline">Configuración</div>
    </md-menu-item>
    <md-menu-item onclick="window.location.href='index'">
      <md-icon slot="start" aria-hidden="true">first_page</md-icon>
      <div slot="headline">Volver a inicio</div>
    </md-menu-item>
  </md-menu>
</span>



<button 
  class="nav-button" active 
  data-section="section-home" 
  onclick="toggleSection('section-home')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">home</span>
  </span>
  <span>Inicio</span>
</button>
<button 
  class="nav-button" 
  data-section="section-patients" 
  onclick="toggleSection('section-patients')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">groups</span>
  </span>
  <span>Pacientes</span>
</button>
<button 
  class="nav-button" 
  data-section="section-appointments" 
  onclick="toggleSection('section-appointments')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">schedule</span>
  </span>
  <span>Citas</span>
</button>


<button 
  class="nav-button label-button quick-action-button top-margin-24 hide-on-mobile"  
  data-section="section-diary"
  >
  <span>Opciones</span>
</button>

<button 
  class="nav-button hide-on-mobile nav-action-button"  
  onclick="ApptsManager.openCreateApptWindow()"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">add</span>
  </span>
  <span>Agendar cita</span>
</button>
<button
  class="nav-button hide-on-mobile nav-action-button"
  onclick="toggleWindow('#window-create-patient')"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">person_add</span>
  </span>
  <span>Nuevo paciente</span>
</button>
<button
  class="nav-button hide-on-mobile nav-action-button"
  id="button-open-trash"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">delete</span>
  </span>
  <span>Abrir papelera</span>
</button>




<div class="simple-container hide-on-mobile grow-1"></div>
<button 
  class="nav-button hide-on-mobile nav-action-button"  
  data-section="section-diary"
  onclick="toggleWindow('#window-send-suggestion')"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">feedback</span>
  </span>
  <span>Hacer sugerencia</span>
</button>


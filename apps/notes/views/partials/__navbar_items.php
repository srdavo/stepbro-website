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
  data-section="section-notes" 
  onclick="toggleSection('section-notes')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">folder_open</span>
  </span>
  <span>Mis notas</span>
</button>

<!-- <button 
  class="nav-button"  
  data-section="section-notes" 
  onclick="toggleSection('section-notes')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">local_library</span>
  </span>
  <span>Lecturas</span>
</button> -->

<button 
  class="nav-button"  
  data-section="section-to_do_list" 
  onclick="toggleSection('section-to_do_list')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">checklist</span>
  </span>
  <span>To do</span>
</button>

<button 
  class="nav-button"  
  data-section="section-diary"
  id="open-diary-nav-button"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">book_4</span>
  </span>
  <span>Diario</span>
</button>


<button 
  class="nav-button label-button quick-action-button top-margin-24 hide-on-mobile"  
  data-section="section-diary"
  >
  <span>Opciones</span>
</button>

<button 
  class="nav-button hide-on-mobile nav-action-button"  
  data-section="section-diary"
  onclick="quickCreateNote(this)"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">edit_square</span>
  </span>
  <span>Crear nota</span>
</button>
<button 
  class="nav-button hide-on-mobile nav-action-button"  
  data-section="section-diary"
  onclick="quickCreateFolder()"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">create_new_folder</span>
  </span>
  <span>Crear carpeta</span>
</button>
<button 
  class="nav-button hide-on-mobile nav-action-button"  
  data-section="section-diary"
  onclick="quickCreateTask()"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">add</span>
  </span>
  <span>Crear tarea</span>
</button>
<button 
  class="nav-button hide-on-mobile nav-action-button"  
  data-section="section-diary"
  onclick="openTrashWindow()"
  data-flip-id="animate"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
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


<!-- <button 
  class="nav-button"
  data-section="section-registers" 
  onclick="toggleSection('section-registers')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">list</span>
  </span>
  <span>Registros</span>
</button>

<button 
  class="nav-button" 
  data-section="section-groups"
  onclick="toggleSection('section-groups')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">nutrition</span>
  </span>
  <span>Alimentos</span>
</button> -->
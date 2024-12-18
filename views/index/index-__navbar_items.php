<button 
  class="nav-button" active 
  data-section="section-index" 
  onclick="toggleSection('section-index')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">home</span>
  </span>
  <span>Inicio</span>
</button>

<button 
  class="nav-button" 
  onclick="window.location.href='mailto:luisdavid.gris@gmail.com'; return false;"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">mail</span>
  </span>
  <span>Contactanos</span>
</button>

<div class="simple-container grow-1"></div>
<?php
      if(isset($_SESSION['id'])){
        echo "
          <button 
            class='nav-button'
            data-flip-id='animate'
            onclick='toggleWindow(\"#window-settings\")'
            >
            <span class='icon-holder'>
            <span class='material-symbols-rounded'>settings</span>
            </span>
            <md-ripple></md-ripple>
            <span class='only-on-mobile'>Configuración</span>
          </button>
        ";
      } else{
        echo "
          <button 
            class='nav-button'
            id='direct-action-header-button'
            data-flip-id='animate' 
            onclick='toggleWindow(\"#window-sb-signup\",\"\",1)'
            >
            <span class='icon-holder only-on-mobile'>
            <span class='material-symbols-rounded'>person_add</span>
            </span>
            <md-ripple></md-ripple>
            Crear cuenta
          </button>
        ";
      }
    ?>



<!-- <button 
  class="nav-button"
  data-section="section-login" 
  onclick="toggleSection('section-login')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">login</span>
  </span>
  <span>Iniciar sesión</span>
</button>

<button 
  class="nav-button"
  data-section="section-signup" 
  onclick="toggleSection('section-signup')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">person_add</span>
  </span>
  <span>Crear cuenta</span>
</button> -->


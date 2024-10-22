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

<div class="simple-container grow-1"></div>
<?php 
  if(!isset($_SESSION["id"])){
    echo '
      <button 
        class="nav-button color-gray" 
        data-section="section-login" 
        onclick="toggleSection(`section-login`)"
        >
        <md-ripple></md-ripple>
        <span class="icon-holder" >
          <span class="material-symbols-rounded">login</span>
        </span>
        <span>Iniciar sesión</span>
      </button>
    ';
  }else{
    echo '
      <button 
        class="nav-button color-gray" 
        data-flip-id="animate"
        onclick="toggleWindow(`#window-settings`, ``, 1)"
        >
        <md-ripple></md-ripple>
        <span class="icon-holder" >
          <span class="material-symbols-rounded">settings</span>
        </span>
        <span class="only-on-mobile">Configuración</span>
      </button>
    ';
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


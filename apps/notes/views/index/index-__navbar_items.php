<div class="simple-container grow-1 justify-between-wide-screen h-padding-16 max-width-1200">
  <div class="simple-container grow-0-1">
    <button 
      class="nav-button stepbro" active 
      data-section="section-index" 
      onclick="toggleSection('section-index')"
      >
      <md-ripple></md-ripple>
      <span class="icon-holder only-on-mobile">
        <span class="material-symbols-rounded">home</span>
      </span>
      stepbro
    </button>
  </div>
  <div class="simple-container grow-0-1 gap-8">
    <!-- <button 
      class="nav-button"
      data-section="section-pricing" 
      onclick="toggleSection('section-pricing')"
      >
      <span class="icon-holder only-on-mobile">
        <span class="material-symbols-rounded">payments</span>
      </span>
      <md-ripple></md-ripple>
      Precios
    </button> -->
    

    <?php
      if(isset($_SESSION['id'])){
        echo "
          <button 
            class='nav-button'
            id='direct-action-header-button'
            onclick='window.location=\"home\"'
            >
            <span class='icon-holder only-on-mobile'>
            <span class='material-symbols-rounded'>arrow_circle_right</span>
            </span>
            <md-ripple></md-ripple>
            <span>Ir a app</span>
          </button>
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
            data-flip-id='animate' 
            onclick='toggleWindow(\"#window-sb-login\",\"\",1)'
            >
            <span class='icon-holder only-on-mobile'>
            <span class='material-symbols-rounded'>login</span>
            </span>
            <md-ripple></md-ripple>
            Iniciar sesión
          </button>
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
    
  </div>

  

  <!-- <button 
    class="nav-button" active 
    data-section="section-index" 
    onclick="toggleSection('section-index')"
    >
    <md-ripple></md-ripple>
    <span class="icon-holder" >
      <span class="material-symbols-rounded">home</span>
    </span>
    Inicio
  </button> -->

  
</div>

<!-- <button 
  class="nav-button" active 
  data-section="section-index" 
  onclick="toggleSection('section-index')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">home</span>
  </span>
  Inicio
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
  Crear cuenta
</button>  -->


<!-- <button 
  class="nav-button"
  data-section="section-quicknotes" 
  onclick="toggleSection('section-quicknotes')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded"><i class='bx bx-note'></i></span>
  </span>
  Quick Notes
</button> 


<button 
  class="nav-button"
  data-section="section-courses" 
  onclick="toggleSection('section-courses')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded"><i class='bx bx-notepad'></i></span>
  </span>
  Courses
</button> 



<button 
  class="nav-button"
  data-section="section-readinglist" 
  onclick="toggleSection('section-readinglist')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded"><i class='bx bx-book-reader'></i></span>
  </span>
  Reading List
</button> 


<button 
  class="nav-button"
  data-section="section-todolist" 
  onclick="toggleSection('section-todolist')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded"><i class='bx bx-list-check'></i></span>
  </span>
  To do list
</button> 

<button 
  class="nav-button"
  data-section="section-diary" 
  onclick="toggleSection('section-diary')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded"><i class='bx bx-book'></i></span>
  </span>
  Diary
</button>  -->

<script>
  const directActionButton = document.getElementById('direct-action-header-button');
  document.addEventListener("DOMContentLoaded", function(event) {
    const activeSection = document.querySelector("#section-index");

    // Escucha el evento de scroll
    activeSection.addEventListener('scroll', function() {
      // Obtén el valor de scroll
      const scrollValue = activeSection.scrollTop;

      if (scrollValue > 270) {
        directActionButton.setAttribute("directActionOn", ""); 
      } else {
        directActionButton.removeAttribute("directActionOn"); 
      }
    });
   

  });
  
</script>




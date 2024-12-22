<section id="section-index" active class="landing-page">

  <!-- title row 1  -->
  <div class="simple-container direction-column gap-24 align-center justify-center main-title-parent" style="height:300px">
    <!-- <span class="display-large bricolage weight-600 text-center">
      stepbro Notes
    </span> -->
    <div class="simple-container direction-column gap-8">
      <span class="main-title text-center">stepbro Notes</span>
    <span class="headline-small weight-500 outline-text text-center max-width-800">Tu espacio para notas, listas de tareas y proyectos, siempre accesible en todos tus dispositivos</span>
    </div>

    <?php
      if(isset($_SESSION['id'])){
        echo "
          <button 
            class='style-1 primary-container on-primary-container-text'
            onclick='window.location=\"home\"'
            >
            <md-ripple></md-ripple>
            Comenzar
          </button>
        ";
      } else{
        echo "
            <button 
              class='style-1 primary-container on-primary-container-text'
              data-flip-id='animate'
              onclick='toggleWindow(\"#window-sb-signup\",undefined,1)'
              >
              <md-ripple></md-ripple>
              Comenzar
            </button>
        ";
      }
    ?>
    
    
  </div>

  <!-- image row 2 -->
  <div class="simple-container justify-center">
    <div class="simple-container" light-mode hide-on-mobile>
      <img 
        src="assets/sb_notes_landing_img_2.png" 
        alt="stepbro notes example"
        class="main-image"
      >

    </div>
    <div class="simple-container" dark-mode hide-on-mobile>
      <img 
        src="assets/sb_notes_landing_img_2_dark.png" 
        alt="stepbro notes example"
        class="main-image"
      >

    </div>
    <div class="simple-container" light-mode only-on-mobile>
      <img 
        src="assets/sb_notes_landing_img_mobile_light.png" 
        alt="stepbro notes example"
        class="main-image"
      >
    </div>
    <div class="simple-container" dark-mode only-on-mobile>
      <img 
        src="assets/sb_notes_landing_img_mobile_dark.png" 
        alt="stepbro notes example"
        class="main-image"
      >
    </div>
    
  </div>

  <!-- feature title row 3 -->
  <div class="simple-container justify-center top-margin-64 bottom-margin-32">
    <div class="simple-container direction-column grow-1 max-width-800">
      <span class="display-large bricolage weight-500 text-center on-background-text">Tan simple como bien hecha</span>
    </div>
  </div>

  <!-- feature row 4 -->
  <div class="simple-container justify-center">
    <div class="simple-container direction-column grow-1 max-width-1200 user-select-none">
      <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-template-rows: repeat(2, 1fr);
        gap: 8px;
        ">
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">folder_open</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">Sistema de carpetas</span>
            <p class="body-large text-wrap-pretty">Organiza todas tus notas de forma elegante y eficiente con un sistema de carpetas. Perfecto para tener todas tus ideas, proyectos y tareas separadas de manera visualmente agradable, como en un sistema operativo.</p>
          </div>
        </div>
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">edit_note</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">Notas rápidas</span>
            <p class="body-large text-wrap-pretty">Toma notas al instante, sin preocuparte por guardarlas. Al entrar en la aplicación, tendrás un recuadro listo para escribir, y cada palabra se guarda automáticamente mientras escribes. Ideal para esos momentos de prisa.</p>
          </div>
        </div>
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">encrypted</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">Diario encriptado</span>
            <p class="body-large text-wrap-pretty">Tu espacio personal y privado para escribir tus pensamientos diarios. Protegido por un PIN y encriptado, asegura que solo tú tengas acceso a tus entradas más personales.</p>
          </div>
        </div>
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">list</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">To do List</span>
            <p class="body-large text-wrap-pretty">Un sistema de listas de tareas simple y funcional, con estados como pendiente, en progreso y completado. Organiza y marca tus objetivos fácilmente, con la posibilidad de añadir fechas límite.</p>
          </div>
        </div>
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">devices</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">Multiplataforma</span>
            <p class="body-large text-wrap-pretty">Usable en cualquier dispositivo, ya sea que prefieras una computadora, tablet o teléfono. Además, puedes instalarla como una Progressive Web App (PWA) para tenerla siempre a mano.</p>
          </div>
        </div>
        <div class="content-box padding-32 direction-row hover-scale-small light-color">
          <div class="simple-container"><md-icon class="primary-container-text filled pretty small">palette</md-icon></div>
          <div class="simple-container direction-column gap-8 grow-1">
            <span class="headline-small  weight-500">Personalización</span>
            <p class="body-large text-wrap-pretty">Personaliza tu experiencia cambiando la paleta de colores y el estilo de navegación. Haz que la aplicación se sienta verdaderamente tuya, con un look que se adapta a tus gustos.</p>
          </div>
        </div>
        

      </div>
    </div>
  </div>

  <div class="simple-container grow-1 top-margin-64 light-color align-center">
    <div class="content-box light-color align-center">
      <md-text-button href="<?= BASE_URL ?>">Ir a página principal de stepbro</md-text-button>

    </div>
  </div>

    
   
  

  
</section>
<style>
  .main-title-parent{
    min-height:324px;
  }

  .landing-page .main-title{
    font-size:80px;
    font-family: "Bricolage Grotesque", system-ui !important;
    color:var(--md-sys-color-on-background);
    user-select: none;
    font-weight:600;
    line-height:0.88;
  } 
  .landing-page .main-image{
    width:100%;
    border-radius:64px;
    background: var(--md-sys-color-surface-container-low)
  }


  [only-on-mobile]{display:none;}
  [hide-on-mobile]{display:flex;}
  [hide-on-mobile][dark-mode]{display:none;}
  @media only screen and (max-width: 680px){
    [only-on-mobile]{display:flex;}
    [hide-on-mobile]{display:none;}

    .main-title-parent{
      min-height:80%;
    }

    .landing-page .main-image{
      border-radius:16px;
    }
  }

  @media only screen and (max-width: 680px) and (prefers-color-scheme: light){
    [only-on-mobile][dark-mode]{display:none ;}
  }
  @media only screen and (min-width: 680px) and (prefers-color-scheme: dark){
    [hide-on-mobile][dark-mode]{display:flex;}
    [hide-on-mobile][light-mode]{display:none;}
  }
  @media only screen and (max-width: 680px) and (prefers-color-scheme: dark){
    [only-on-mobile][light-mode]{display:none;}
  }

</style>

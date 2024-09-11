<section id="section-home" active>
  
  <!-- <div class="content-box minimal direction-row justify-between align-center on-background-text">
    <div class="simple-container">
      <span class="headline-medium">Inicio</span>
    </div>
    <div class="simple-containe">
      <md-filled-button 
        
        data-flip-id="animate"
        onclick="toggleWindow('#window-add-register', 1 ,1)"
        >
        <md-icon slot="icon">add</md-icon>
        Registrar calorias
      </md-filled-button>
    </div>
    <span class="justify-right" style="display:flex; position: relative;">
      <md-icon-button id="toggler-menu-basic-options" onclick="toggleMenu('menu-basic-options')">
        <md-icon>more_vert</md-icon>
      </md-icon-button>
      <md-menu id="menu-basic-options" anchor="toggler-menu-basic-options" style="min-width:200px;">

        <md-menu-item onclick="toggleDialog('dialog-account')">
          <div slot="headline">Cuenta</div>
          <md-icon slot="start">account_circle</md-icon>
        </md-menu-item>
        <md-menu-item onclick="toggleDialog('dialog-logout-confirmation')">
          <div slot="headline">Cerrar sesión</div>
          <md-icon slot="start">logout</md-icon>
        </md-menu-item>

      </md-menu>
    </span>
  </div> -->



  <div class="content-box border-radius-32 justify-center align-center primary-container on-primary-container-text overflow-auto grow-1">
    <div class="simple-container direction-column">
      <span class="headline-small">Hoy</span>
      <span id="response-total-day-calories" class="display-large weight-600 dm-sans" style="font-size:18vw; line-height:18vw">0</span>
      <div class="simple-container">
        <span class="body-medium dm-sans weight-600">Kcal</span>
      </div>
      

    </div>

    <md-filled-button 
      class="big"
      data-flip-id="animate"
      onclick="toggleWindow('#window-register-calories', 1 ,1)"
      >
      <md-icon slot="icon">add</md-icon>
      Registrar calorias
    </md-filled-button>
  </div>

  <!-- <div class="simple-container justify-right">
    
  </div> -->

  

  



  
</section>
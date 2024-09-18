<section id="section-login" class="padding-8 t-padding-0">
  <div class="simple-container direction-column gap-8 grow-1 border-radius-24 overflow-auto scrollbar-hidden">
    <div class="content-box justify-center align-center height-100 gap-16">
      <!-- <span class="display-small">Iniciar sesión</span> -->
      <div class="content-box light-color gap-16" id="parent-login" style="max-width:360px;">
        <div class="simple-container gap-8 direction-column">
          <div class="content-divisor">
            <h1 class="headline-small bricolage weight-600 on-background-text data-line incresed">
              stepbro
            </h1>
          </div>
          <div class="simple-container direction-column">
            <h1 class="display-small on-background-text weight-500">Bienvenido</h1>
            <h2 class="headline-small">Inicia sesión</h2>
          </div>
        </div>
        <md-outlined-text-field
          id="input-login-user"
          label="Usuario o correo" 
          type="email">
        </md-outlined-text-field>
        <md-outlined-text-field 
          id="input-login-password"
          label="Contraseña" 
          type="password">
        </md-outlined-text-field>
        
        <div class="simple-container direction-column justify-right gap-8">
          <div class="simple-container justify-right">
            <md-filled-button onclick="logIn()"><md-icon slot="icon">login</md-icon>Iniciar sesión</md-filled-button>
          </div>
          <!-- <div class="simple-container direction-row justify-right">
            <span onclick="toggleWindow('#window-forgot-password')" data-flip-id="animate" class="label-small data-line interactive">
              <md-ripple></md-ripple>Olvidé mi contraseña
            </span>
          </div> -->
          <div class="simple-container direction-row justify-right">
            <span onclick="toggleSection('section-signup')" data-flip-id="animate" class="label-small data-line interactive">
              <md-ripple></md-ripple>Crear una cuenta
            </span>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  
  
</section>


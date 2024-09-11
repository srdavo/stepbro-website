<section id="section-login" class="vh-center">
  <div class="content-box light-color gap-16" id="parent-login" style="max-width:360px;">
    <!-- Parit logo -->
    <div class="simple-container gap-8 direction-column">

    
      <div class="content-divisor">
        <h1 class="headline-small weight-600 on-background-text data-line incresed">
          <svg xmlns="http://www.w3.org/2000/svg" width="33" height="21" viewBox="0 0 33 21" fill="none">
            <rect y="0.632812" width="20" height="20" rx="10" fill="var(--md-sys-color-on-background)"/>
            <rect x="22.2178" y="0.632812" width="10.1613" height="20" rx="5.08065" fill="var(--md-sys-color-on-background)"/>
          </svg>
          Cocounut
        </h1>
      </div>
      <div class="simple-container direction-column">
        <h1 class="display-small on-background-text weight-500">Bienvenido</h1>
        <h2 class="body-large">Inicia sesión</h2>
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
    
    <!-- <div class="simple-container">
      <md-assist-chip label="Olvide mi contraseña"></md-assist-chip>
    </div> -->
    <div class="simple-container direction-column justify-right gap-8">
      <div class="simple-container justify-right">
        
        <md-filled-button onclick="logIn()"><md-icon slot="icon">login</md-icon>Iniciar sesión</md-filled-button>
      </div>
      <div class="simple-container direction-row justify-right">
        
        <span onclick="toggleWindow('#window-forgot-password')" data-flip-id="animate" class="label-small data-line interactive">
          <md-ripple></md-ripple>Olvidé mi contraseña
        </span>
        
      </div>
    </div>
    
    

  </div>
  
</section>


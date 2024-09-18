<section id="section-signup" class="vh-center">

  <div class="content-box gap-16" id="parent-signup" style="max-width:360px;">
    <h1 class="display-small v-margin">Crear cuenta</h1>
    <md-outlined-text-field 
      id="input-signup-user"
      label="Correo" 
      type="email">
    </md-outlined-text-field>
    <md-outlined-text-field 
      id="input-signup-password"
      label="Contraseña" 
      type="password">
    </md-outlined-text-field>
    <md-outlined-text-field 
      id="input-signup-password_repeat"
      label="Confirma la contraseña" 
      type="password">
    </md-outlined-text-field>
    <div class="simple-container justify-right">
      <md-filled-button onclick="signUp()">Aceptar</md-filled-button>
    </div>
  </div>

</section>
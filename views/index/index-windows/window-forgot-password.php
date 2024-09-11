<script src="js/reset-password-functions.js?v=1"></script>
<window id="window-forgot-password" data-flip-id="animate">
  <div class="content-box minimal padding-16">
    <md-icon-button onclick="toggleWindow()">
      <md-icon>close</md-icon>
    </md-icon-button>
  </div>
  <holder>
    <div class="simple-container direction-column gap-16">
      <div class="simple-container direction-column gap-8">
        <md-icon class="pretty small">vpn_key_alert</md-icon>
        <span class="headline-medium">Olvidé mi contraseña</span>
      </div>
      
      <md-outlined-text-field
        id="input-forgot-password-email"
        label="Escribe tu correo electrónico" 
        type="email">
      </md-outlined-text-field>
    </div>
    
    <div class="simple-container justify-right v-margin">
      <md-filled-button onclick="sendPasswordResetCode()">Enviar código </md-filled-button>
    </div>
  </holder>
</window>


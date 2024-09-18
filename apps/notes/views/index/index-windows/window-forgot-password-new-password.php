<window class="dialog" id="window-forgot-password-new-password">
  <holder class="padding-24">
    <div class="simple-container direction-column">
      <h1 class="headline-medium">
        Nueva contraseña
      </h1>
      <span class="label-large v-margin" style="opacity:0.8">
        Escribe tu nueva contraseña
      </span>
    </div>
    
    <div class="simple-container direction-column">
      <md-outlined-text-field
        class="v-margin"
        id="input-forgot-password-new-password"
        label="Nueva contraseña" 
        type="password">
      </md-outlined-text-field>
      <md-outlined-text-field
        class="v-margin"
        id="input-forgot-password-new-password-confirmation"
        label="Confirma tu nueva contraseña" 
        type="password">
      </md-outlined-text-field>
    </div>
    
    <div class="simple-container justify-right">
      <md-filled-button onclick="updatePassword()">Actualizar contraseña</md-filled-button>
    </div>
  </holder>
</window>
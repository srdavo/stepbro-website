<window class="dialog" id="window-forgot-password-code-confirmation">
  <holder class="padding-24">
    <h1 class="headline-medium">
      Código de confirmación
    </h1>
    <span class="label-large v-margin" style="opacity:0.8">
      Hemos enviado un correo electrónico a <span class="primary-text" id="modify-forgot-password-email">...</span> con instrucciones para restablecer tu contraseña. Revise su bandeja de entrada y spam.
    </span>
    <md-outlined-text-field
      class="v-margin"
      id="input-forgot-password-reset-code"
      label="Código de confirmación" 
      type="text"
      maxlength="8">
    </md-outlined-text-field>

    <div class="simple-container justify-right">
      <md-filled-button onclick="validatePasswordResetCode()">Validar código</md-filled-button>
    </div>
  </holder>
</window>
<window 
    id="window-sb-signup"
    class="increased box-shadow-none"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16 b-padding-0">
        <md-icon-button onclick="toggleWindow(); resetFormSteps();">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <form
            id="signup-form"
            onsubmit="signUp(event)" 
            class="simple-container direction-column height-auto grow-1 overflow-hidden h-padding-4"
            >
            <div class="simple-container direction-column grow-1 width-100 height-100 align-center" data-form-step-1>
                <div class="simple-container justify-center grow-1 gap-24 direction-column width-100 max-width-600" >
                    <span class="display-small bricolage weight-500 on-background-text" style="white-space:nowrap">
                        Crea tu cuenta
                    </span>
                    <div class="simple-container direction-column position-relative" >
                        <label for="user-login-email" class="input-pretty-label headline-medium weight-500">Correo</label>
                        <input 
                            name="user-email" 
                            placeholder="Escribe tu correo" 
                            class="pretty prepared"
                            id="user-signup-email"
                        >
                        <md-filled-button type="button" onclick="validateFormStep1()" class="input-pretty-button">Continuar</md-filled-button>
                    </div>
                    <div class="simple-container bottom-margin-64">
                            <md-filled-tonal-button type="button" onclick="changeWindow('#window-sb-login')" class="solid-light">Ya tengo una cuenta</md-filled-tonal-button>
                    </div>
                </div>
            </div>

            <div class="simple-container direction-column grow-1 width-100 height-100 align-center" data-form-step-2>
                <div class="simple-container justify-center grow-1 gap-8 direction-column width-100 max-width-600 bottom-margin-64" >
                    <span class="display-small bricolage weight-500 on-background-text" >
                        Configura tu contraseña
                    </span>
                    <div class="simple-container direction-column position-relative">
                        <input 
                            type="password" 
                            placeholder="Escribe una contraseña" 
                            class="pretty"
                            id="user-signup-password"
                        >
                    </div>

                    <div class="simple-container direction-column position-relative">

                        <input 
                            type="password" 
                            placeholder="Confirma tu contraseña" 
                            class="pretty bottom-prepared"
                            id="user-signup-password-repeat"
                        >
                        <md-filled-button type="submit" class="input-pretty-button">Confirmar</md-filled-button>
                    </div>
                    
                </div>
            </div>
        </form>
        
    </holder>
</window>
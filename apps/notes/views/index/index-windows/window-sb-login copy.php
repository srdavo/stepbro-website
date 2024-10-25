<window 
    id="window-sb-login"
    class="increased box-shadow-none"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow(); ">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder class="align-center">
        <div class="simple-container justify-center grow-1 gap-24 direction-column width-100 max-width-600">
            <div class="simple-container">
                
            </div>
            <span class="display-medium bricolage weight-500 on-background-text">
                Crea tu cuenta
            </span>
            <form class="simple-container direction-column gap-8">
                <div class="simple-container direction-column position-relative">
                    <label for="user-login-email" class="input-pretty-label headline-medium weigh-500">Correo</label>
                    <input 
                        type="email" 
                        placeholder="Escribe tu correo" 
                        class="pretty prepared"
                        id="user-login-email"
                    >
                    <md-filled-button type="button" class="input-pretty-button">Continuar</md-filled-button>
                </div>
            </form>
            <div class="simple-container bottom-margin-64">
                    <md-filled-tonal-button class="solid-light">Ya tengo una cuenta</md-filled-tonal-button>
            </div>
        </div>
        
    </holder>
</window>
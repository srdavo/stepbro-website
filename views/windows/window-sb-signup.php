<window 
    id="window-sb-signup"
    class="increased box-shadow-none"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16 b-padding-0">
        <md-icon-button onclick="toggleWindow(); ">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <div class="simple-container direction-column grow-1 width-100 height-100 align-center">
            <div class="simple-container justify-center grow-1 gap-24 direction-column width-100 max-width-600">
                <span class="display-small bricolage weight-500 on-background-text" style="white-space:nowrap">
                    Crea tu cuenta
                </span>
                <form class="simple-container direction-column gap-8">
                    <div class="simple-container direction-column position-relative">
                        <label for="user-login-email" class="input-pretty-label headline-medium weight-500">Correo</label>
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
        </div>

        <div class="simple-container direction-column grow-1 width-100 height-100 align-center">
            <div class="simple-container justify-center grow-1 gap-24 direction-column width-100 max-width-600">
    
                <form class="simple-container direction-column gap-8">
                    <div class="simple-container direction-column position-relative">
                        <label for="user-login-email" class="input-pretty-label headline-medium weight-500">Contraseña</label>
                        <input 
                            type="password" 
                            placeholder="Escribe una contraseña" 
                            class="pretty top-prepared"
                            id="user-login-email"
                        >
                    </div>

                    <div class="simple-container direction-column position-relative">
                        <label for="user-login-email" class="input-pretty-label headline-medium weight-500">Repite la contraseña</label>

                        <input 
                            type="password" 
                            placeholder="Confirma tu contraseña" 
                            class="pretty prepared"
                            id="user-login-email"
                        >
                        <md-filled-button type="button" class="input-pretty-button">Confirmar</md-filled-button>
                    </div>
                </form>

            </div>
        </div>
        
    </holder>
</window>
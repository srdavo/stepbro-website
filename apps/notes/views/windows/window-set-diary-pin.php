<window 
    id="window-set-diary-pin"
    class="increased "
    data-flip-id="animate"
    >
    <div class="simple-container padding-16 b-padding-0">
        <md-icon-button onclick="toggleWindow();">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder class="on-background-text gap-16">
        <div class="simple-container grow-1 justify-center align-center">
            <div class="simple-container direction-column width-100 max-width-600 gap-16">
                <div class="simple-container align-center justify-center">
                    <md-icon class="pretty filled secondary-container on-secondary-container-text">book</md-icon>
                </div>
                <span class="display-small weight-600 bricolage text-center">
                    Bienvenido(a) a tu <span class="primary-text">Diario</span>
                </span>
                <span class="headline-small outline-text text-center">
                    Tu diario es un espacio privado donde puedes escribir tus pensamientos, emociones y experiencias. 
                </span>
                <div class="simple-container direction-column">
                    <div class="content-box direction-row light-color align-center v-margin-large bottom-margin-8">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">encrypted</md-icon></div>
                        <div class="simple-container grow-1">
                            <span class="body-large">
                                Para proteger tu privacidad, deberás configurar un pin de acceso.
                            </span>
                        </div>
                    </div>
                    <div class="simple-container direction-column">
                        <md-filled-button trailing-icon class="big" onclick="toggleOvermessage('#overmessage-set-diary-pin'); document.getElementById('diary-set-access-pin').focus({ preventScroll: true })">
                            <md-icon slot="icon">arrow_forward</md-icon>
                            Comenzar
                        </md-filled-button>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- <div class="simple-container direction-column">
            <div class="simple-container align-center gap-8">
                <md-icon class="pretty small">lock</md-icon>
                <span class="display-small bricolage weight-600">Diario</span>
            </div>
            <span class="body-large outline-text">Ingresa el pin de tu diario para acceder</span>
        </div>
        <input type="password" placeholder="Ingresa tu pin del diario" id="diary-access-pin" pattern="[0-9]*">
        <div class="simple-container justify-right">
            <md-filled-button>Comprobar</md-filled-button>
        </div> -->

        <!-- <button onclick="toggleOvermessage('#overmessage-set-diary-pin')">overmessage</button> -->
    </holder>

    <div class="overmessage" id="overmessage-set-diary-pin">
        <div class="simple-container">
            <md-text-button onclick="toggleOvermessage()">
                <md-icon slot="icon">arrow_back</md-icon>
                Volver
            </md-text-button>
        </div>
        <div class="simple-container grow-1 justify-center align-center-0 on-background-text">
            <div class="simple-container direction-column gap-16 width-100 max-width-600">
                <div class="simple-container direction-column">
                    <div class="simple-container direction-column gap-8">
                        <md-icon class="pretty small">lock</md-icon>
                        <span class="display-small bricolage weight-600">Configura tu Pin</span>
                    </div>
                    <span class="body-large outline-text">Ingresa un pin para proteger tu diario</span>
                </div>
                <form onsubmit="saveDiaryPin(event)" id="set-diary-pin-form" class="simple-container direction-column gap-16">
                    <input type="password" inputmode="numeric" placeholder="0000" id="diary-set-access-pin" pattern="[0-9]*" maxlength="4">
                    <div class="simple-container justify-right">
                        <md-filled-button>Continuar</md-filled-button>
                    </div>
                </form>
                
            </div>
            

        </div>
    </div>
    
</window>
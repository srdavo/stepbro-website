<window
    id="window-send-suggestion"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow();">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder class="gap-16">
        <div class="simple-container direction-column">
            <span class="display-small bricolage weight-600">Enviar sugerencia</span>
            <span class="body-large outline-text">¿Tienes alguna sugerencia para mejorar la aplicación? ¡Envíanosla!</span>
        </div>
        <form onsubmit="sendSuggestion(event)" id="send-suggestion-form" class="simple-container direction-column gap-16">
            <md-outlined-text-field 
                type="textarea" 
                label="Escribe tu sugerencia" 
                style="min-height:180px;"
                id="send-suggestion-suggestion"    
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button>
                    <md-icon slot="icon">send</md-icon>
                    Enviar
                </md-filled-button>
            </div>
        </form>
    </holder>

</window>

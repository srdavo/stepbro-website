<window 
    id="window-diary-pin"
    class="increased slim h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow();">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder class="on-background-text gap-16">
        <div class="simple-container direction-column">
            <div class="simple-container align-center gap-8">
                <md-icon class="pretty small">lock</md-icon>
                <span class="display-small bricolage weight-600">Diario</span>
            </div>
            <span class="body-large outline-text">Ingresa el pin de tu diario para acceder</span>
        </div>
        <form onsubmit="validateDiaryPin(event)" id="validate-diary-pin-form" class="simple-container direction-column gap-16">
            <input type="password" inputmode="numeric" placeholder="Ingresa tu pin del diario" id="diary-validate-access-pin" pattern="[0-9]*">
            <div class="simple-container justify-right">
                <md-filled-button>Comprobar</md-filled-button>
            </div>
        </form>
       

    </holder>
    
</window>
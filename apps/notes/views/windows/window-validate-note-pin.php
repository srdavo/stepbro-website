<window 
    id="window-validate-note-pin"
    class="increased slim h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow();">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder class="on-background-text gap-16">

        <div class="simple-container direction-column gap-8">
            <div class="simple-container align-center gap-8">
                <md-icon class="pretty small filled">lock</md-icon>
                <span class="display-small bricolage weight-600">Nota bloqueada</span>
            </div>
            <span class="body-large outline-text" style="text-wrap-style:pretty">
                Para desbloquear esta nota necesitas ingresar tu pin del diario
            </span>
        </div>
        <form id="validate-open-encrypt-note-pin-form" class="simple-container direction-column gap-16">
            <input type="password" id="validate-open-encrypt-note-pin-input" inputmode="numeric" placeholder="Ingresa tu pin del diario para desbloquear" pattern="[0-9]*">
            <div class="simple-container justify-right">
                <md-filled-button>Desbloquear</md-filled-button>
            </div>
        </form>
       

    </holder>
</window>
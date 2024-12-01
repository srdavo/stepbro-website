<window 
    id="window-decrypt-note"
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
                <md-icon class="pretty small filled">lock_open</md-icon>
                <span class="display-small bricolage weight-600">Desbloquear nota</span>
            </div>
            <span class="body-large outline-text" style="text-wrap-style:pretty">
                Al desbloquear la nota, esta se desencriptará y podrá ser vista por cualquier persona.
            </span>
        </div>
        <form id="validate-decrypt-note-pin-form" class="simple-container direction-column gap-16">
            <input type="password" id="validate-decrypt-note-pin-input" inputmode="numeric" placeholder="Ingresa tu pin del diario para desbloquear" pattern="[0-9]*">
            <div class="simple-container justify-right">
                <md-filled-button>Desbloquear<md-icon slot="icon">lock_open</md-icon></md-filled-button>
            </div>
        </form>
       

    </holder>


    
</window>
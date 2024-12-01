<window 
    id="window-encrypt-note"
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
                <md-icon class="pretty small filled">encrypted_add</md-icon>
                <span class="display-small bricolage weight-600">Bloquear nota</span>
            </div>
            <span class="body-large outline-text" style="text-wrap-style:pretty">
                Al bloquear la nota, esta se encriptará y no podrá ser vista por nadie más que por ti.
            </span>
        </div>
        <form id="validate-encrypt-note-pin-form" class="simple-container direction-column gap-16">
            <input type="password" id="validate-encrypt-note-pin-input" inputmode="numeric" placeholder="Ingresa tu pin del diario para bloquear" pattern="[0-9]*">
            <div class="simple-container justify-right">
                <md-filled-button>Bloquear nota<md-icon slot="icon">lock</md-icon></md-filled-button>
            </div>
        </form>
       

    </holder>

    <!-- <div class="overmessage" id="overmessage-set-encrypted-note-name">
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
                        <md-icon class="pretty small">edit_note</md-icon>
                        <span class="display-small bricolage weight-600">Nombra esta nota</span>
                    </div>
                    <span class="body-large outline-text">
                        Al bloquear la nota necesitarás un nombre para identificarla.
                    </span>
                </div>
                <form onsubmit="saveDiaryPin(event)" id="set-diary-pin-form" class="simple-container direction-column gap-16">
                    <input type="password" inputmode="numeric" placeholder="0000" id="diary-set-access-pin" pattern="[0-9]*" maxlength="4">
                    <div class="simple-container justify-right">
                        <md-filled-button>Continuar</md-filled-button>
                    </div>
                </form>
                
            </div>
            

        </div>
    </div> -->
    
</window>
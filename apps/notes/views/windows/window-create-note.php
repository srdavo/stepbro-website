<window 
    id="window-create-note"
    class="increased h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <span class="display-medium bricolage weight-600" style="text-wrap:nowrap">
            Crear nota
        </span>
        
        <form 
            id="create-note-form" 
            onsubmit="createNote(event)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >

            <md-outlined-text-field 
                id="create-note-content"
                type="textarea" 
                label="Nota"
                style="height:100%"
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button type="submit">Crear</md-filled-button>
            </div>

        </form>
        
        

    </holder>

</window>
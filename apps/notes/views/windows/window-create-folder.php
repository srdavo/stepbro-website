<window
    id="window-create-folder"
    class=""
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        
        <span class="simple-container direction-column gap-8 display-medium bricolage weight-600" style="line-height:40px">
            <md-icon class="pretty small filled">folder</md-icon>
            Crear carpeta
        </span>

        <form 
            id="create-folder-form" 
            onsubmit="createFolder(event, this)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >
            <md-outlined-text-field 
                id="create-folder-name" 
                label = "Nombre de la carpeta"
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button type="submit">Crear</md-filled-button>
            </div>
        </form>

    </holder>
</window>
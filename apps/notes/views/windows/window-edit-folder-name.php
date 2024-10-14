<window
    id="window-edit-folder-name"
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
            Cambiar nombre
        </span>

        <form 
            id="edit-folder-name-form" 
            onsubmit="editFolderName(event)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >
            <md-outlined-text-field 
                id="edit-folder-name" 
                label = "Nombre de la carpeta"
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button 
                    type="submit"
                    id="button-edit-folder-name"
                    data-parent-folder-id=""
                    >
                    Guardar
                </md-filled-button>
            </div>
        </form>

    </holder>
</window>
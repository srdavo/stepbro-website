<window
    id="window-create-task"
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
            <md-icon class="pretty small filled">task</md-icon>
            Crear tarea
        </span>

        <form 
            id="create-folder-form" 
            onsubmit="createTask(event)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >
            <md-outlined-text-field 
                id="create-task-name" 
                label = "Nombre de la tarea"
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button 
                    type="submit"
                    id="button-create-task"
                    data-parent-folder-id=""
                    >
                    Crear
                </md-filled-button>
            </div>
        </form>

    </holder>
</window>
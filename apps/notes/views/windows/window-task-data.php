<window 
    id="window-task-data"
    class="increased slim h-auto on-background-text"
    data-flip-id="animate"
    >
    <div class="simple-container gap-8 padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small window-title">Tarea</span>
    </div>
    <holder>
        <div class="simple-container direction-column align-center justify-center gap-16 bottom-margin-24">
            <md-icon class="pretty filled">task_alt</md-icon>
            <span class="headline-small">Tarea</span>
        </div>
        <form class="simple-container direction-column gap-16">
            <md-outlined-text-field 
                label="Nombre"
                id="edit-task-name"
            ></md-outlined-text-field>
            <md-outlined-select
                id="edit-task-status"
                >
                <md-select-option value="Pendiente">Pendiente</md-select-option>
                <md-select-option value="Activo">En progreso</md-select-option>
                <md-select-option value="Terminado">Completada</md-select-option>
            </md-outlined-select>
            <div class="simple-container justify-right">
                <md-filled-button type="button">Guardar cambios</md-filled-button>
            </div>
        </form>
    </holder>
</window>
<window 
    id="window-edit-task"
    class="increased slim mini h-auto on-background-text"
    data-flip-id="animate"
    >
    <div class="simple-container gap-8 padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small window-title">Editar tarea</span>
        <md-icon-button 
            type="button"
            data-button-delete-task
            data-tooltip="Eliminar"
            id = "delete-task"
            >
            <md-icon>delete</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <!-- <div class="simple-container direction-column align-center justify-center gap-16 bottom-margin-24">
            <md-icon class="pretty filled">task_alt</md-icon>
            <span class="headline-small">Tarea</span>
        </div> -->
        <form
            id="edit-task-form"
            onsubmit="editTask(event)"
            class="simple-container direction-column gap-16"
            >
            <div class="simple-container direction-column gap-16" id="create-task-check-empty">
                <md-outlined-text-field 
                    label="Nombre"
                    id="edit-task-name"
                ></md-outlined-text-field>
            </div>
            <md-outlined-text-field
                id = "edit-task-description"
                label = "Descripción (opcional)"
                type = "textarea"
                style="min-height:124px"
            ></md-outlined-text-field>
            <md-outlined-select id="edit-task-status">
                <md-select-option value="Pendiente">Pendiente</md-select-option>
                <md-select-option value="Activo">En progreso</md-select-option>
                <md-select-option value="Terminado">Completada</md-select-option>
            </md-outlined-select>
            <div class="simple-container direction-column gap-8">
                <span class="label-large">Fecha límite:</span>
                <input type="date" id="edit-task-limit-date">
            </div>

            <div class="simple-container justify-right">
                <md-filled-button id="button-edit-task" data-task_id data-created_at>Guardar cambios</md-filled-button>
            </div>
        </form>
    </holder>
</window>
<window
    id="window-create-task"
    class="increased slim mini h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow(); unCheckLimitDateTaskCheckbox()">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        
        <span class="simple-container direction-column gap-8 display-medium bricolage weight-600" style="line-height:40px">
            <md-icon class="pretty small filled">task</md-icon>
            Crear tarea
        </span>

        <form 
            id="create-task-form" 
            onsubmit="saveTask(event)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >
            <div class="simple-container direction-column gap-16" id="create-task-check-empty">
                <md-outlined-text-field 
                    id = "create-task-name" 
                    label = "Nombre de la tarea"
                ></md-outlined-text-field>
            </div>
            <md-outlined-text-field
                id = "create-task-description"
                label = "Descripción (opcional)"
                type = "textarea"
                style="min-height:124px"
            ></md-outlined-text-field>
            
            <div class="simple-container direction-column">
                <div class="content-box direction-row width-auto light-color padding-16 v-padding-8 bottom-margin-8">
                    <md-checkbox 
                        onclick="toggleLimitDateTask()"
                        id="create-taks-set-date-limit-checkbox"
                        >
                    </md-checkbox>
                    <span class="body-large">Fecha límite</span>
                </div>
                <div class="simple-container direction-column gap-4 task-limit-date-container">
                    <span class="label-large">Fecha límite:</span>
                    <input type="date" id="create-task-limit-date" class="task-limit-date">
                </div>
            </div>

            <!-- <div class="content-box flex-wrap width-auto align-center justify-between direction-row gap-8 padding-16">
                <div class="simple-container gap-8">
                    <md-checkbox></md-checkbox>
                    <span class="body-large">Fecha límite</span>
                </div>
                
                <div class="simple-container direction-column task-limit-date-container">
                    <input type="date">
                </div>
            </div> -->

            

            <div class="simple-container justify-right gap-16">
                    

                <md-filled-button 
                    type="submit"
                    id="button-create-task"
                    data-parent-task-id=""
                    >
                    Crear tarea
                </md-filled-button>
            </div>
        </form>

    </holder>
</window>
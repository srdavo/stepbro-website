<window
    id="window-appt-data"
    data-flip-id="animate"
    class="increased semi-slim h-auto"
    >
    <div class="simple-container padding-16 justify-between flex-wrap align-center gap-8">
        <div class="simple-container gap-8 align-center">
            <md-icon-button onclick="toggleWindow()"><md-icon>close</md-icon></md-icon-button>
            <span class="headline-small on-background-text">Cita</span>
        </div>
        <div class="simple-container gap-8">
            <!-- <md-text-button>
                <md-icon slot="icon">delete</md-icon>
                Eliminar
            </md-text-button> -->
        </div>
    </div>
    <holder class="on-background-text gap-16">
        <div class="content-box light-color border-radius-16 padding-16 gap-8">
            <span class="label-normal outline-text">Paciente</span>
            <div class="simple-container gap-8">
                <span class="body-large data-line hover-outline cursor-pointer" name="patient-name"><span class="outline-text"><i>Nombre del paciente</i></span></span>
                <span class="data-line body-large simple-container align-center cursor-pointer light-color"><md-ripple></md-ripple><md-icon class="dynamic outline-text">arrow_outward</md-icon></span>
            </div>
        </div>

        <form 
            id="form-edit-appt"
            class="simple-container direction-column gap-16"
            >

            <div class="simple-container gap-16 flex-wrap">                
                <div class="simple-container direction-column gap-8 grow-1 basis-normal">
                    <span class="label-normal outline-text left-margin-8">Datos generales</span>
                    <md-filled-text-field 
                        label="Cobro por la cita"
                        type="number"
                        name="appt-cost"
                        prefix-text="$"
                        >
                    </md-filled-text-field>
                    <md-filled-text-field
                        name="appt-concept" 
                        label="Concepto de la cita"
                        >
                    </md-filled-text-field>
                    <md-filled-select
                        name="appt-status" 
                        label="Estado de la cita"
                        >
                        <md-select-option value="1">
                            <div slot="headline">Cita pendiente</div>
                        </md-select-option>
                        <md-select-option value="2">
                            <div slot="headline">Cita completada</div>
                        </md-select-option>
                        <md-select-option value="3">
                            <div slot="headline">Cita cancelada</div>
                        </md-select-option>
                    </md-filled-select>
                </div>

                <div class="simple-container direction-column gap-8 grow-1 basis-normal">
                    <span class="label-normal outline-text left-margin-8">Fecha y hora</span>
                    <input type="date" name="appt-date">
                    <input type="time" name="appt-time">
                </div>
            </div>
            <div class="simple-container justify-between align-center">
                <div class="simple-container gap-8">
                    
                    <md-icon-button 
                        type="button"
                        onclick="TrashManager.openConfirmationDialog('appt')"
                        >
                        <md-icon>delete</md-icon>
                    </md-icon-button>

                    <md-icon-button type="button"><md-icon>history</md-icon></md-icon-button>
                </div>
                <div class="simple-container">
                    <md-filled-button>Guardar cambios</md-filled-button>
                </div>
            </div>
        </form>
    </holder>
</window>
<window 
    id="window-create-appt"
    data-flip-id="animate"
    class="increased slim h-auto"
    >
    <div class="simple-container padding-16 align-center gap-8">
        <md-icon-button onclick="toggleWindow()"><md-icon>close</md-icon></md-icon-button>
        <!-- <span class="headline-small on-background-text">Agendar cita</span> -->
    </div>
    <holder class="on-background-text">
        <form 
            onsubmit="ApptsManager.createAppt(event)" 
            id="form-create-appt"
            class="simple-container direction-column gap-16"
            >

            <div class="simple-container gap-8 align-center bottom-margin-8">
                <md-icon class="pretty small filled">calendar_add_on</md-icon>
                <headline class="headline-medium">Agendar cita</headline>
            </div>

            <md-filled-select
                label="Selecciona un paciente"
                id="create-appt-patients_option_list"
                name="appt-patient"
                >
                <md-select-option value="1">
                    <div slot="headline">David</div>
                </md-select-option>
                <md-select-option value="2">
                    <div slot="headline">Luis</div>
                </md-select-option>
            </md-filled-select>

            <div class="simple-container direction-column gap-8">
                <span class="label-normal outline-text left-margin-8">Fecha y hora</span>
                <input type="date" name="appt-date">
                <input type="time" name="appt-time">
            </div>

            <div class="simple-container justify-right">
                <md-filled-button>Agendar cita</md-filled-button>
            </div>

            

            <!-- <md-filled-text-field
                id="datepicker-test"
                labe="Fecha"
                type="date"
            ></md-filled-text-field> -->

        </form>
    </holder>
</window>
<window
    id="window-create-patient"
    data-flip-id="animate"
    class="on-background-text"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()"><md-icon>close</md-icon></md-icon-button>
    </div>
    <holder>
        <span class="headline-medium bottom-margin-8">Registrar paciente</span>
        <form 
            onsubmit="PatientsManager.createPatient(event)" 
            class="simple-container gap-16 direction-column"
            id="form-create-patient"
            >
            <md-outlined-text-field 
                label="Nombre" 
                id="create-patient_name"
                name="patient-name"
            ></md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button type="submit">Registrar</md-filled-button>
            </div>
        </form>
    </holder>
</window>
<section id="section-home" active>
    <div class="simple-container gap-8 flex-wrap">
        
        <!-- <md-filled-button 
            onclick="toggleWindow('#window-create-patient')" 
            data-flip-id="animate"
            >
            Registrar paciente
        </md-filled-button> -->

        <md-outlined-button
            onclick="toggleWindow('#window-test-cfo')"
            data-flip-id="animate"
            >
            <md-icon slot="icon">experiment</md-icon>
            Registrar paciente para otro            
        </md-outlined-button>

        <md-outlined-button
            onclick="toggleWindow('#window-test-create_permission')"
            data-flip-id="animate"
            >
            <md-icon slot="icon">experiment</md-icon>
            Asignar permisos      
        </md-outlined-button>

        <md-outlined-button
            onclick='toggleWindow("#window-appt-data")'
            data-flip-id="animate"
            >
            Información de cita
        </md-outlined-button>
    </div>

    <div class="simple-container">
        <div class="content-box direction-row padding-16 gap-16 cursor-pointer user-select-none on-background-text">
            <md-ripple></md-ripple>
            <div class="simple-container body-large">
                <md-icon class="dynamic">circle</md-icon>
            </div>
            <div class="simple-container direction-column grow-1 gap-4">
                <span class="label-medium">28 Dic, 3:00 PM</span>
                <span class="body-large">Luis David Elizarraraz Mondaca</span>
            </div>
        </div>
    </div>
</section>
<section id="section-patients" class="align-center">
    <div class="simple-container direction-column width-100 gap-16">

        <div class="simple-container justify-between align-center align-center gap-8 flex-wrap">
            <span class="headline-small on-background-text dm-sans">Pacientes</span>
            <div class="simple-container gap-8">
                <md-filled-tonal-button class="solid"><md-icon slot="icon">search</md-icon>Búscar</md-filled-tonal-button>
                <md-filled-button><md-icon slot="icon">person_add</md-icon>Agregar paciente</md-filled-button>
            </div>
            <!-- <span class="body-large dm-sans outline-text">
                Aquí podrás ver la lista de pacientes que tienes registrados en tu cuenta.
            </span> -->
        </div>
        <!-- <div class="simple-container gap-8 flex-wrap">
            <div class="content-box basis-small grow-1 overflow-hidden gap-0 outline-1-light-inset">
                <span class="label-large">Pacientes activos</span>
                <span class="headline-large dm-sans weight-bold">24</span>
                <md-icon class="absolute-card">self_improvement</md-icon>
            </div>
            <div class="content-box basis-small grow-1 overflow-hidden gap-0 outline-1-light-inset">
                <span class="label-large">Pacientes dados de alta</span>
                <span class="headline-large dm-sans weight-bold">32</span>
                <md-icon class="absolute-card">sentiment_very_satisfied</md-icon>
            </div>
            <div class="content-box basis-small grow-1 overflow-hidden gap-0 outline-1-light-inset">
                <span class="label-large">Pacientes inactivos</span>
                <span class="headline-large dm-sans weight-bold">8</span>
                <md-icon class="absolute-card">person_off</md-icon>
            </div>
        </div> -->

        <!-- <div class="simple-container gap-8">
            <button 
                class="w-nav-button style-2"
                data-w-section="w-section-patients-active"
                active
                >
                <md-ripple></md-ripple>
                <md-icon>self_improvement</md-icon>
                <span>Activos</span>
            </button>
            <button 
                class="w-nav-button style-2"
                data-w-section="w-section-patients-discharged"
                >
                <md-ripple></md-ripple>
                <md-icon>sentiment_very_satisfied</md-icon>
                <span>De alta</span>
            </button>
            <button 
                class="w-nav-button style-2"
                data-w-section="w-section-patients-unactive"
                >
                <md-ripple></md-ripple>
                <md-icon>person_off</md-icon>
                <span>Inacivos</span>
            </button>
        </div> -->

        <div class="simple-container direction-column gap-8">
            <table id="response-container-patients_table" class="style-2"></table>
        </div>
        
    </div>
</section>
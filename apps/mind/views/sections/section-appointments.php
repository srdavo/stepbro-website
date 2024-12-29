<section id="section-appointments">
    <div class="simple-container direction-column width-100 gap-16">

        <div class="simple-container justify-between align-center align-center gap-8 flex-wrap">
            <span class="headline-small on-background-text dm-sans">Citas</span>
            <div class="simple-container gap-8">
                <md-filled-tonal-button class="solid"><md-icon slot="icon">search</md-icon>Búscar</md-filled-tonal-button>
                <md-filled-button onclick="ApptsManager.openCreateApptWindow()" data-flip-id="animate"><md-icon slot="icon">add</md-icon>Agendar cita</md-filled-button>
            </div>
        </div>

        <div class="simple-container direction-column gap-8">
            <table id="response-container-appts-table" class="style-2"></table>
        </div>


    </div>
</section>
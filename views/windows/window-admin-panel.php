<window 
    id="window-admin-panel"
    class="increased full-size"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-text-button onclick="toggleWindow()"><md-icon slot="icon">exit_to_app</md-icon>Salir del panel</md-text-button>
    </div>
    <holder>
        <div class=" simple-container direction-column grow-1 align-center on-background-text gap-16">
            <div class="w-nav simple-container direction-column width-100 max-width-1200 overflow-hidden gap-16">
                <div class="simple-container gap-8">
                    <button 
                        class="w-nav-button style-2"
                        data-w-section="w-section-admin-panel-users"
                        onclick="toggleWSection('w-section-admin-panel-users', this)"
                        active
                        >
                        <md-ripple></md-ripple>
                        <md-icon>home</md-icon>
                        <span>Inicio</span>
                    </button>
                    <button 
                        class="w-nav-button style-2"
                        data-w-section="w-section-admin-panel-app-access"
                        onclick="toggleWSection('w-section-admin-panel-app-access', this)"
                        >
                        <md-ripple></md-ripple>
                        <md-icon>open_in_phone</md-icon>
                        <span>Accesos</span>
                    </button>
                    <button 
                        class="w-nav-button style-2"
                        data-w-section="w-section-admin-panel-suggestions"
                        onclick="toggleWSection('w-section-admin-panel-suggestions', this)"
                        >
                        <md-ripple></md-ripple>
                        <md-icon>feedback</md-icon>
                        <span>Sugerencias</span>
                    </button>
                </div>
                <div class="simple-container direction-column v-margin-large">
                    <span class="display-small dm-sans weight-500 on-background-text">Panel de administrador</span>
                    <span class="body-large dm-sans outline-text">
                        Bienvenido al panel de administrador. Aquí podrás gestionar los usuarios y sus datos.
                    </span>
                </div>
            </div>
            <div 
                class="w-section simple-container direction-column width-100 max-width-1200 overflow-hidden gap-16" 
                id="w-section-admin-panel-users"
                active
                >

                <div class="simple-container gap-8 flex-wrap">
                    <div class="content-box basis-normal grow-1 overflow-hidden rounded gap-0 outline-1-light-inset">
                        <span class="body-large">Usuarios totales</span>
                        <span class="display-large weight-bold" id="response-admin-panel-total-users">...</span>
                        <md-icon class="absolute-card" aria-hidden="true">person_add</md-icon>
                    </div>
                </div>
                
                <div class="simple-container direction-column overflow-auto padding-1">
                    <table 
                        class="style-2"
                        id="response-users-table"
                    >
                    </table>
                    <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                    <div class="simple-container" id="pagination-users-table"></div>  
                </div>
                
                    
            </div>
            <div
                class="w-section simple-container direction-column width-100 max-width-1200 overflow-hidden gap-16" 
                id="w-section-admin-panel-app-access"
                >
                <div class="simple-container gap-8 flex-wrap">
                    <div class="content-box basis-normal grow-1 overflow-hidden rounded gap-0 outline-1-light-inset cursor-pointer">
                        <md-ripple></md-ripple>
                        <span class="body-large">Accesos totales</span>
                        <span class="display-large weight-bold" id="response-admin-panel-total-access">...</span>
                        <md-icon class="absolute-card" aria-hidden="true">open_in_phone</md-icon>
                    </div>
                </div>

                <div class="simple-container direction-column overflow-auto padding-1">
                    <table 
                        class="style-2"
                        id="response-admin-panel-access-table"
                    >
                    </table>
                    <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                    <div class="simple-container" id="pagination-admin-panel-access-table"></div>  
                </div>

            </div>
            <div
                class="w-section simple-container direction-column width-100 max-width-1200 overflow-hidden gap-16" 
                id="w-section-admin-panel-suggestions"
                >
                <div class="simple-container gap-8 flex-wrap">
                    <div class="content-box basis-normal grow-1 overflow-hidden rounded gap-0 outline-1-light-inset cursor-pointer">
                        <md-ripple></md-ripple>
                        <span class="body-large">Sugerencias totales</span>
                        <span class="display-large weight-bold" id="response-admin-panel-total-suggestions">...</span>
                        <md-icon class="absolute-card" aria-hidden="true">feedback</md-icon>
                    </div>
                </div>

                <div class="simple-container direction-column overflow-auto padding-1">
                    <table 
                        class="style-2"
                        id="response-admin-panel-suggestions-table"
                    >
                    </table>
                    <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                    <div class="simple-container" id="pagination-admin-panel-suggestions-table"></div>  
                </div>
            </div>
            
        </div>

    </holder>
</window>
<script src="<?= BASE_URL ?>js/admin-functions.js"></script>
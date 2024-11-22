<window 
    id="window-admin-panel"
    class="increased full-size"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-text-button onclick="toggleWindow()"><md-icon slot="icon">exit_to_app</md-icon>Salir del panel</md-text-button>
    </div>
    <holder>
        <div class="simple-container grow-1 justify-center">
            <div class="simple-container direction-column width-100 max-width-1200 overflow-hidden">
                <span class="display-small dm-sans weight-500 text-center">Panel de administrador</span>
                <span class="body-large dm-sans outline-text text-center">
                    Bienvenido al panel de administrador. Aquí podrás gestionar los usuarios y sus datos.
                </span>
                
                <div class="simple-container overflow-auto">
                    <table 
                        class="top-margin-32 style-2"
                        id="response-users-table"
                    >
                    </table>
                    <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                    <div class="simple-container" id="pagination-users-table"></div>  
                </div>
                
                    
            </div>
        </div>

    </holder>
</window>
<script src="<?= BASE_URL ?>js/admin-functions.js"></script>
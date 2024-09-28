<window 
    id="window-sb"
    class="dialog" 
    data-flip-id="animate"
    >
    <div class="content-box minimal padding-16">
        <md-icon-button onclick="toggleWindow()">
        <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <span class="headline-medium">Cuenta</span>
        <span class="body-large on-surface-background">Bienvenido(a) <?= $_SESSION["user"]; ?></span>  
        <span class="simple-container direction-column top-margin-16">
            <div class="simple-container direction-column gap-8">
                <md-text-button onclick="changeWindow('#window-settings')"><md-icon slot="icon">settings</md-icon>Configuración</md-text-button>
                <md-text-button href="<?= BASE_URL?>"><md-icon slot="icon">exit_to_app</md-icon>Volver a inicio</md-text-button>
            </div>
        </span>
    </holder>
</window>
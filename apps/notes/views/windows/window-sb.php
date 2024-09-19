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
        <span class="simple-container top-margin-16">
        <md-outlined-button href="<?= BASE_URL?>"><md-icon slot="icon">exit_to_app</md-icon>Volver a inicio</md-outlined-button>
        </span>
    </holder>
</window>
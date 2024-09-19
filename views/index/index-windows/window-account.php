<window class="dialog" id="window-account" data-flip-id="animate">
  <div class="content-box minimal padding-16">
    <md-icon-button onclick="toggleWindow()">
      <md-icon>close</md-icon>
    </md-icon-button>
  </div>
  <holder>
    <span class="headline-medium">Cuenta</span>
    <span class="body-large on-surface-background">Bienvenido(a), <?= $_SESSION["user"]; ?></span>  
    <span class="simple-container top-margin-16">
      <md-outlined-button href="<?= BASE_URL?>controllers/logout.php"><md-icon slot="icon">logout</md-icon>Cerrar sesión</md-outlined-button>
    </span>
  </holder>
</window>
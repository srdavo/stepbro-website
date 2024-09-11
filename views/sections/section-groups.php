<section id="section-groups">
    <div class="content-box grow-1 secondary-container on-tertiary-container-text align-center justify-center">

      <md-icon class="pretty">plumbing</md-icon>
      <span class="headline-small">En construcción</span>
      <span class="justify-right" style="display:flex; position: relative;">
        <md-icon-button id="toggler-menu-basic-options" onclick="toggleMenu('menu-basic-options')">
          <md-icon>more_vert</md-icon>
        </md-icon-button>
        <md-menu id="menu-basic-options" anchor="toggler-menu-basic-options" style="min-width:200px;">

          <md-menu-item onclick="toggleDialog('dialog-account')">
            <div slot="headline">Cuenta</div>
            <md-icon slot="start">account_circle</md-icon>
          </md-menu-item>
          <md-menu-item onclick="toggleDialog('dialog-logout-confirmation')">
            <div slot="headline">Cerrar sesión</div>
            <md-icon slot="start">logout</md-icon>
          </md-menu-item>

        </md-menu>
      </span>
    </div>
</section>
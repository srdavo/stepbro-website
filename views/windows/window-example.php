<window id="window-example" data-flip-id="animate" class="increased slim">
  <div class="content-box minimal padding-16">
    <md-icon-button onclick="toggleWindow()">
      <md-icon>close</md-icon>
    </md-icon-button>
  </div>
  
  <holder>
    <h1 class="headline-small">Ventana de ejemplo</h1>
    <md-filled-button onclick="toggleDialog('dialog-createSomething')"><md-icon slot="icon">add</md-icon>Abrir modal</md-filled-button>
  </holder>
</window>
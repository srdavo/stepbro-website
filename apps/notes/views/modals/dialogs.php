<md-dialog id="dialog-createSomething">
  <div slot="headline">Crear</div>
  <form id="form" slot="content" method="dialog">
    <div class="simple-container direction-column gap-8">
      <md-filled-text-field label="Nombre" role="presentation" inputmode="" type="text" autocomplete=""></md-filled-text-field>
      <md-filled-text-field label="Apellido" role="presentation" inputmode="" type="text" autocomplete=""></md-filled-text-field>

    </div>
  </form>
  <div slot="actions">
    
    <md-text-button form="form" value="cancel">cancel</md-text-button>
    <md-filled-tonal-button form="form" value="create">Crear</md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-account" style="min-width: calc(-1600px + 100vw)">
  <div slot="headline">Cuenta</div>
  <form id="form-dialog-account" slot="content" method="dialog">
    <md-list style="border-radius:16px;">
      <md-list-item>
        <md-icon slot="start">tag</md-icon>
        <div slot="headline" id="response-account-id">...</div>
      </md-list-item>
      <md-list-item>
        <md-icon slot="start">mail</md-icon>
        <div slot="headline" id="response-account-email">...</div>
      </md-list-item>
    </md-list>
    <div class="simple-container direction-column gap-8 v-margin">

      <md-outlined-text-field 
        id="modify-account-username"
        label="Nombre de usuario" 
        role="presentation"
        style="margin-top:8px;"
        >
      </md-outlined-text-field>
    </div>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-account" value="cancel">Cancelar</md-text-button>
    <md-filled-tonal-button form="form-dialog-account" onclick="modifyUserData()" value="save">Guardar</md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-logout-confirmation">
  <div slot="headline">Cerrar sesión</div>
  <md-icon slot="icon" aria-hidden="true">logout</md-icon>
  <form id="form-dialog-logout-confirmation" slot="content" method="dialog">
    ¿Estas seguro de que quieres cerrar sesión?
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-logout-confirmation" value="cancel">Cancelar</md-text-button>
    <md-filled-tonal-button value="save" onclick="logOut()">Cerrar sesión</md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-delete-calorie-log-confirmation">
  <div slot="headline">Eliminar</div>
  <md-icon slot="icon" aria-hidden="true">delete</md-icon>
  <form id="form-dialog-delete-calorie-log-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quierer eliminar este registro?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-calorie-log-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-calorie-log" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete</md-icon>
      Confirmar
    </md-filled-tonal-button>
  </div>
</md-dialog>
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

<!-- <md-dialog id="dialog-account" style="min-width: calc(-1600px + 100vw)">
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
</md-dialog> -->

<!-- <md-dialog id="dialog-logout-confirmation">
  <div slot="headline">Cerrar sesión</div>
  <md-icon slot="icon" aria-hidden="true">logout</md-icon>
  <form id="form-dialog-logout-confirmation" slot="content" method="dialog">
    ¿Estas seguro de que quieres cerrar sesión?
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-logout-confirmation" value="cancel">Cancelar</md-text-button>
    <md-filled-tonal-button value="save" onclick="logOut()">Cerrar sesión</md-filled-tonal-button>
  </div>
</md-dialog> -->

<md-dialog id="dialog-delete-note-confirmation">
  <div slot="headline">Eliminar nota</div>
  <md-icon slot="icon" aria-hidden="true">delete</md-icon>
  <form id="form-dialog-delete-note-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar esta nota?<br>
    Esto moverá la nota a la papelera.
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-note-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-note" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-delete-note-forever-confirmation">
  <div slot="headline">Eliminar permanentemente</div>
  <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
  <form id="form-dialog-delete-note-forever-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar <span class="weight-600">permanentemente</span> esta nota?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-note-forever-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-note-forever" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-restore-note-confirmation">
  <div slot="headline">Recuperar nota</div>
  <md-icon slot="icon" aria-hidden="true">notes</md-icon>
  <form id="form-dialog-restore-note-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres recuperar esta nota?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-restore-note-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-button id="button-confirm-restore-note" value="confirm">
      <md-icon slot="icon" aria-hidden="true">restore</md-icon>
      Recuperar
    </md-filled-button>
  </div>
</md-dialog>


<md-dialog id="dialog-delete-folder-confirmation">
  <div slot="headline">Eliminar carpeta</div>
  <md-icon slot="icon" aria-hidden="true">folder_delete</md-icon>
  <form id="form-dialog-delete-folder-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar esta carpeta?<br>
    Esto moverá la carpeta a la papelera.
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-folder-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-folder" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-restore-folder-confirmation">
  <div slot="headline">Recuperar carpeta</div>
  <md-icon slot="icon" aria-hidden="true">folder</md-icon>
  <form id="form-dialog-restore-folder-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres recuperar esta carpeta?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-restore-folder-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-button id="button-confirm-restore-folder" value="confirm">
      <md-icon slot="icon" aria-hidden="true">restore</md-icon>
      Recuperar
    </md-filled-button>
  </div>
</md-dialog>

<md-dialog id="dialog-delete-folder-forever-confirmation">
  <div slot="headline">Eliminar permanentemente</div>
  <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
  <form id="form-dialog-delete-folder-forever-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar <span class="weight-600">permanentemente</span> esta carpeta?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-folder-forever-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-folder-forever" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-delete-task-confirmation">
  <div slot="headline">Eliminar tarea</div>
  <md-icon slot="icon" aria-hidden="true">task</md-icon>
  <form id="form-dialog-delete-task-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar esta tarea?<br>
    Esto moverá la tarea a la papelera.
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-task-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-task" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-restore-task-confirmation">
  <div slot="headline">Recuperar tarea</div>
  <md-icon slot="icon" aria-hidden="true">task</md-icon>
  <form id="form-dialog-restore-task-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres recuperar esta tarea?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-restore-task-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-button id="button-confirm-restore-task" value="confirm">
      <md-icon slot="icon" aria-hidden="true">restore</md-icon>
      Recuperar
    </md-filled-button>
  </div>
</md-dialog>

<md-dialog id="dialog-delete-task-forever-confirmation">
  <div slot="headline">Eliminar permanentemente</div>
  <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
  <form id="form-dialog-delete-task-forever-confirmation" slot="content" method="dialog">
    ¿Estás seguro de que quieres eliminar <span class="weight-600">permanentemente</span> esta tarea?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-delete-task-forever-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button id="button-confirm-delete-task-forever" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete_forever</md-icon>
      Eliminar
    </md-filled-tonal-button>
  </div>
</md-dialog>
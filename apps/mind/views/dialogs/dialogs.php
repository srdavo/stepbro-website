<md-dialog id="dialog-move-to-trash-confirmation">
  <div slot="headline">Mover a papelera</div>
  <md-icon slot="icon" aria-hidden="true">delete</md-icon>
  <form id="form-dialog-move-to-trash-confirmation" slot="content" method="dialog">
    ¿Estás seguro(a) de que quieres mover esta <span name="item-name"></span> a la papelera?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-move-to-trash-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button name="button-confirm-move-to-trash" class="delete" value="confirm">
      <md-icon slot="icon" aria-hidden="true">delete</md-icon>
      Mover a papelera
    </md-filled-tonal-button>
  </div>
</md-dialog>


<md-dialog id="dialog-recover-from-trash-confirmation">
  <div slot="headline">Recuperar</div>
  <md-icon slot="icon" aria-hidden="true">restart_alt</md-icon>
  <form id="form-dialog-recover-from-trash-confirmation" slot="content" method="dialog">
    ¿Estás seguro(a) de que quieres recuperar esta <span name="item-name"></span>?<br>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-recover-from-trash-confirmation" value="cancel" role="presentation">Cancelar</md-text-button>
    <md-filled-tonal-button name="button-confirm-recover-from-trash" class="" value="confirm">
      <md-icon slot="icon" aria-hidden="true">restart_alt</md-icon>
      Recuperar
    </md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-appt-data" class="width-100 max-width-800-m-24 ">
  <div slot="headline">
    <md-icon-button form="form-dialog-appt-data" value="cancel"><md-icon>close</md-icon></md-icon-button>
    <span slot="headline">Cita</span>
  </div>
  <form id="form-dialog-appt-data" slot="content" method="dialog" class="on-background-text">
    <div class="simple-container gap-16 flex-wrap">

      <!-- name column -->
      <div class="content-box light-color border-radius-16 padding-16 gap-8">
        <span class="label-normal outline-text">Paciente</span>
        <div class="simple-container gap-8">
          <span class="body-large data-line hover-outline cursor-pointer" name="patient-name"><span class="outline-text"><i>Nombre del paciente</i></span></span>
          <span class="data-line body-large simple-container align-center cursor-pointer light-color"><md-ripple></md-ripple><md-icon class="dynamic outline-text">arrow_outward</md-icon></span>
        </div>
      </div>

      <!-- second row column 1 -->
      <div class="simple-container direction-column gap-8 grow-1 basis-normal">

        <span class="label-normal outline-text left-margin-8">Datos generales</span>
        <div class="content-box border-radius-16 padding-16 gap-4">
          <span class="label-normal outline-text user-select-none">Cobro por cita</span>
          <span class="body-large" name="appt-cost">$0.00</span>
        </div>
        <div class="content-box border-radius-16 padding-16 gap-4">
          <span class="label-normal outline-text user-select-none">Concepto de la cita</span>
          <span class="body-large" name="appt-concept">...</span>
        </div>
        <div class="content-box border-radius-16 padding-16 gap-4">
          <span class="label-normal outline-text user-select-none">Estado de la cita</span>
          <span class="body-large" name="appt-status">...</span>
        </div>

      </div>
      <!-- second row column 2 -->
      <div class="simple-container direction-column gap-8 grow-1 basis-normal">

        <span class="label-normal outline-text left-margin-8">Fecha y hora</span>
        <div class="content-box border-radius-16 padding-16 gap-4">
          <span class="label-normal outline-text user-select-none">Fecha de la cita</span>
          <span class="body-large" name="appt-date">...</span>
        </div>
        <div class="content-box border-radius-16 padding-16 gap-4">
          <span class="label-normal outline-text user-select-none">Hora de la cita</span>
          <span class="body-large" name="appt-time">...</span>
        </div>

      </div>
    </div>
  </form>
  <div slot="actions" class="flex-wrap">
    <md-filled-tonal-button class="delete"><md-icon slot="icon">delete_forever</md-icon>Eliminar permanentemente</md-filled-tonal-button>
    <md-filled-button name="button-recover" ><md-icon slot="icon">restart_alt</md-icon>Recuperar cita</md-filled-button>
  </div>
</md-dialog>
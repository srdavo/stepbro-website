<window 
    id="window-add-register" 
    data-flip-id="animate" 
    class="increased slim"
    >
  <div class="content-box minimal padding-16">
    <md-icon-button onclick="toggleWindow()">
      <md-icon>close</md-icon>
    </md-icon-button>
  </div>
  
    <holder class="gap-16">
        <div class="simple-container align-center direction-column gap-16">
            <md-icon class="pretty filled">list_alt_add</md-icon>
            <span class="headline-medium on-background-text">Registarar calorias</span>
        </div>
        <form id="edit-role-form" class="simple-container direction-column gap-16 v-margin">
            <md-outlined-text-field id="edit-role-name" label="Nombre del rol"></md-outlined-text-field>
            <md-outlined-text-field id="edit-role-description" label="Descripción" type="textarea" style="min-height:160px;"></md-outlined-text-field>
            <md-outlined-text-field id="edit-role-salary" label="Salario" placeholder="0.00" type="number" pattern="[0-9]*">
                <md-icon slot="leading-icon" aria-hidden="true">attach_money</md-icon>
            </md-outlined-text-field>
            <div class="simple-container justify-right">
                <md-filled-button data-role-id="" id="edit-role-button">Guardar cambios</md-filled-button>
            </div>
        </form>
    </holder>
</window>
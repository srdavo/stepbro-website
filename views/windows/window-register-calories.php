<window
    id="window-register-calories"
    class="increased slim h-auto"
    data-flip-id="animate"
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
        <form id="register-calories-form" onsubmit="registerCalories(event)" class="simple-container direction-column gap-16 v-margin">
            <md-outlined-text-field 
                id="register-calories-calories" 
                label="Cantidad de calorias" 
                type="number"
                pattern="[0-9]*">
            </md-outlined-text-field>
            <md-outlined-text-field id="register-calories-description" label="Descripción" type="textarea" style="min-height:160px;"></md-outlined-text-field>
            
            <div class="simple-container gap-8 flex-wrap top-margin-8">
                <md-outlined-text-field id="register-calories-date" label="Fecha" type="date" class="grow-1"></md-outlined-text-field>
                <md-outlined-text-field id="register-calories-time" label="Hora" type="time" class="grow-1"></md-outlined-text-field>
            </div>
            
            
            <div class="simple-container justify-right">
                <md-filled-button data-role-id="" id="register-calories-button">
                    <md-icon slot="icon">ramen_dining</md-icon>    
                    Registrar
                </md-filled-button>
            </div>
        </form>
    </holder>
</window>
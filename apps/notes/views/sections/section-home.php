<section id="section-home" active>
  
    <div class="content-box border-radius-32 secondary-container on-secondary-container-text overflow-auto grow-1 padding-0">
        
        <div class="simple-container justify-between align-center padding-24">
            <div class="simple-container"><span class="headline-large">Inicio</span> </div>
            <div class="simple-container">
                <md-filled-button
                    onclick="toggleWindow('#window-create-note', '', 1)"
                    data-flip-id="animate"
                    >
                    <md-icon slot="icon">edit_square</md-icon>
                    Crear nota
                </md-filled-button>
            </div>
        </div>

        <div class="simple-container direction-column primary-container grow-1 padding-24 border-radius-32 align-center justify-center">
           <span class="headline-small weight-600">Bienvenido a la aplicación de notas.</span> 
           <span class="body-large">Aplicacion demo para demostración de sistema.</span> 
           <button 
                class="nav-button color-gray" 
                data-flip-id="animate"
                onclick="toggleWindow(`#window-settings`, ``, 1)"
                >
                <md-ripple></md-ripple>
                <span class="icon-holder" >
                <span class="material-symbols-rounded">account_circle</span>
                </span>
                <span>Mi cuenta</span>
            </button>
        </div>

    


    </div>

</section>
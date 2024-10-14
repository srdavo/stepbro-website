<window
    id="window-move-item"
    class="increased mini"
    data-flip-id="animate"
>
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <div class="simple-container hide-on-mobile">
        <md-icon-button toggle onclick="toggleWindowFullSize()" data-tooltip="Pantalla completa">
            <md-icon>expand_content</md-icon>
            <md-icon slot="selected">collapse_content</md-icon>
        </md-icon-button>
        </div>
    </div>
    <div class="simple-container direction-column" id="progress-indicator-move-file" style="min-height:4px"></div>
    <holder>
        
        <!-- <div class="content-box padding-16 gap-4">
            <span class="label-normal">Mover</span>
            <span class="body-large data-line">Nombre del archivo</span>
            <span class="body-large outline-text data-line">Ubicación actuál: Universidad/Semestre 5/Parcial 1/ Matemáticas</span>
        </div> -->
        <div class="simple-container v-margin direction-column">
            <div class="simple-container gap-8  data-line">
                <span class="body-large">Mover "<span id="modify-move-item-name"></span>"</span>
                <span class="body-large outline-text">#<span id="modify-move-item-id"></span></span>
            </div>
            <span class="headline-large">Selecciona la nueva ubicación</span>
        </div>

        <!-- <span class="simple-container direction-column gap-8 display-medium bricolage weight-600" style="line-height:40px">
            <md-icon class="pretty small filled">drive_file_move</md-icon>
            Mover 
        </span>
        <span class="body-large outline-text">Selecciona la nueva ubicación del archivo</span> -->
        <div class="simple-container direction-column">
            <div class="file-system-item">        
                <div class="file-data">
                    <div 
                        class="file-name-container"
                        data-file-id="0"
                        data-file-type="folder"
                        >
                        <md-ripple></md-ripple>
                        <div class="loader-container">
                            
                        </div>
                        <md-icon class="pretty small transparent">snippet_folder</md-icon>
                        <span class="file-name">Carpeta principal</span>
                    </div>
                    <div class="dynamic-options">
                        <md-text-button onclick="moveSelectedItem(0)">
                            <md-icon slot="icon">arrow_forward</md-icon>
                            Mover
                        </md-text-button>
                    </div>
                </div>
                <div class="file-content"></div>
            </div>
        </div>
        <div 
            class="simple-container grow-1 direction-column" 
            data-file-system-parent 
            id="move-item-file-system-container"
        ></div>
        

    </holder>
</window>
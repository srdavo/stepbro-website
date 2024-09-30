<section id="section-notes">
    <div class="simple-container justify-between">
        <span class="headline-large">Notas</span>
        <md-outlined-button onclick="toggleWindow('#window-create-folder')" data-flip-id="animate">
            <md-icon slot="icon">add</md-icon>
            <span>Crear carpeta</span>
        </md-outlined-button>
    </div>

    <div class="simple-container gap-8 grow-1" id="main-folders-parents-container">
        <div
            id="main-folders-container" 
            class="content-box light-color folders-parent"
            >
            <div class="folders-list">
                <div class="folder" active>
                    <md-ripple></md-ripple>
                    <md-icon>folder</md-icon>
                    <span>Universidad</span>
                </div>
                <div class="folder">
                    <md-ripple></md-ripple>
                    <md-icon>folder</md-icon>
                    <span>Compras</span>
                </div>
                <div class="folder">
                    <md-ripple></md-ripple>
                    <md-icon>folder</md-icon>
                    <span>Ideas</span>
                </div>
                <div class="folder">
                    <md-ripple></md-ripple>
                    <md-icon>folder</md-icon>
                    <span>Luis David Elizarraraz Mondaca</span>
                </div>
            </div>
            <div class="simple-container direction-column">
                <div class="folder">
                    <md-ripple></md-ripple>
                    <md-icon>create_new_folder</md-icon>
                    <span>Crear carpeta</span>
                </div>
            </div>
        </div>
        
        <div class="content-box grow-1 align-center justify-center note-parent">
            <div class="simple-container align-center direction-column gap-8">
                <md-icon class="pretty">folder_open</md-icon>
                <span class="body-large bricolage weight-500">Selecciona una nota para comenzar a editarla</span>
            </div>
        </div>
    </div>

    <!-- <div class="simple-container top-margin-8 direction-column overflow-auto scrollbar-hidden">
        <div id="response-notes-table" class="simple-container gap-8 direction-column"></div>
        <div class="simple-container width-100 container-info-empty-table"></div>
        <div class="simple-container" id="pagination-notes-table"></div>
    </div> -->

</section>
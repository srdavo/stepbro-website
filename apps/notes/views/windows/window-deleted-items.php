<window 
    id="window-deleted-items"
    class="increased on-background-text integrated"
    data-flip-id="animate"
    >
    <holder>
        <div class="w-section-holder simple-container grow-1 gap-16 overflow-hidden">
            <div class="w-nav w-nav-parent simple-container direction-column">
                <div class="simple-container gap-8 bottom-margin-16">
                    <md-icon-button onclick="toggleWindow()">
                        <md-icon>close</md-icon>
                    </md-icon-button>
                    <span class="simple-container align-center headline-small window-title">Papelera</span>
                </div>
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-deleted-notes"
                    onclick="if(toggleWSection('w-section-deleted-notes')){displayDeletedNotes()}"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>restore_from_trash</md-icon>
                    <span>Notas eliminadas</span>
                </button>
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-deleted-folders"
                    onclick="if(toggleWSection('w-section-deleted-folders')){displayDeletedFolders()}"
                    
                    >
                    <md-ripple></md-ripple>
                    <md-icon>folder_delete</md-icon>
                    <span>Carpetas eliminadas</span>
                </button>
            </div>

            <div class="w-section simple-container justify-center align-center direction-column grow-1 gap-8 overflow-auto scrollbar-hidden on-background-text" active id="w-section-trash-home">
                <div class="content-box border-radius-56 align-center padding-64" style="max-width:500px">
                    <div class="simple-container direction-column align-center gap-8">
                        <md-icon class="pretty filled">delete</md-icon>
                        <span class="display-small bricolage weight-600">Papelera</span>
                    </div>
                    <p class="headline-small text-center v-margin" style="max-width:400px">
                        Aquí encontrarás todas las notas y carpetas que has eliminado. Puedes restaurarlas o eliminarlas permanentemente.
                    </p>
                    <div class="simple-container direction-column gap-8 top-margin-16">
                        <md-outlined-button class="solid-high" onclick="openDeletedNotesWindow()">
                            <md-icon slot="icon">notes</md-icon>
                            Ver notas eliminadas
                        </md-outlined-button>
                        <md-outlined-button class="solid-high" onclick="openDeletedFoldersWindow()">
                            <md-icon slot="icon">folder</md-icon>
                            Ver carpetas eliminadas
                        </md-outlined-button>
                    </div>    
                </div>
                
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" id="w-section-deleted-notes">
                <div 
                    id="response-deleted-notes-container"
                    class="simple-container direction-column gap-8"
                    >
                </div>
                <div class="simple-container width-100 container-info-empty-table"></div>
                <div class="simple-container" id="pagination-deleted-notes-container"></div>
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" id="w-section-deleted-folders">
                <div 
                    id="response-deleted-folders-container"
                    class="simple-container direction-column gap-8"
                    >
                </div>
                <div class="simple-container width-100 container-info-empty-table"></div>
                <div class="simple-container" id="pagination-deleted-folders-container"></div>
            </div>
        </div>
        
    </holder>

</window>
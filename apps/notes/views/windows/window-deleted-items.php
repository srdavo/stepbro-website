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
                    active
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

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" active id="w-section-deleted-notes">
                    <!-- <div class="simple-container align-center gap-8">
                        <md-icon class="pretty small">restore_from_trash</md-icon>
                        <span class="headline-small v-margin">Notas eliminadas</span>
                    </div>     -->
            
            
                <!-- <div class="simple-container gap-8 overflow-auto scrollbar-hidden" style="min-height:40px">
                    <select class="no-reset">
                        <option>Ordenar por: Fecha de eliminación</option>
                        <option>Ordenar por: Fecha de creación</option>
                    </select>
                    <select class="no-reset">
                        <option>Ascendente</option>
                        <option>Descendente</option>
                    </select>
                </div> -->
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
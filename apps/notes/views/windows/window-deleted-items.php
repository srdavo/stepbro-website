<window 
    id="window-deleted-items"
    class="increased on-background-text integrated"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16 gap-8 only-on-mobile">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small">Papelera</span>
    </div>
    <holder>
        <div class="w-section-holder simple-container grow-1 gap-16 overflow-hidden">
            <div class="w-nav w-nav-parent simple-container direction-column">
                <div class="simple-container gap-8 bottom-margin-16 hide-on-mobile">
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
                    <md-icon>notes</md-icon>
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
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-deleted-tasks"
                    onclick="if(toggleWSection('w-section-deleted-tasks')){displayDeletedTasks()}"
                    
                    >
                    <md-ripple></md-ripple>
                    <md-icon>task</md-icon>
                    <span>Tareas eliminadas</span>
                </button>
                <!-- <div class="simple-container grow-1 hide-on-mobile"></div>
                <button
                    class="w-nav-button hide-on-mobile"
                    data-w-section="w-section-trash-home"
                    onclick="toggleWindowFullSize()"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>aspect_ratio</md-icon>
                    <span>Pantalla completa</span>
                </button> -->
            </div>

            <div class="w-section simple-container justify-center align-center direction-column grow-1 gap-8 overflow-auto scrollbar-hidden on-background-text" active id="w-section-trash-home">
                    <div class="simple-container direction-column align-center gap-8">
                        <md-icon class="pretty filled error-container on-error-container-text">delete</md-icon>
                        <span class="display-small bricolage weight-600">Papelera</span>
                    </div>
                    <p class="headline-small outline-text text-center v-margin max-width-400">
                        Aquí encontrarás todas las notas y carpetas que has eliminado. Puedes restaurarlas o eliminarlas permanentemente.
                    </p>
                    <div class="simple-container direction-column gap-8 top-margin-16 hide-on-mobile">
                        <md-filled-tonal-button class="solid-high" onclick="openDeletedNotesWindow()">
                            <md-icon slot="icon">notes</md-icon>
                            Ver Notas eliminadas
                        </md-filled-tonal-button>
                        <md-filled-tonal-button class="solid-high" onclick="openDeletedFoldersWindow()">
                            <md-icon slot="icon">folder</md-icon>
                            Ver Carpetas eliminadas
                        </md-filled-tonal-button>
                        <md-filled-tonal-button class="solid-high" onclick="openDeletedTasksWindow()">
                            <md-icon slot="icon">task</md-icon>
                            Ver Tareas eliminadas
                        </md-filled-tonal-button>
                    </div>    
                
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" id="w-section-deleted-notes">
                <div class="simple-container only-on-mobile">
                    <span class="headline-medium on-background-text">Notas eliminadas</span>
                </div>
                <div 
                    id="response-deleted-notes-container"
                    class="simple-container direction-column gap-8"
                    >
                </div>
                <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                <div class="simple-container" id="pagination-deleted-notes-container"></div>
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" id="w-section-deleted-folders">
                <div class="simple-container only-on-mobile">
                    <span class="headline-medium on-background-text">Carpetas eliminadas</span>
                </div>
                <div 
                    id="response-deleted-folders-container"
                    class="simple-container direction-column gap-8"
                    >
                </div>
                <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                <div class="simple-container" id="pagination-deleted-folders-container"></div>
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8 overflow-auto scrollbar-hidden" id="w-section-deleted-tasks">
                <div class="simple-container only-on-mobile">
                    <span class="headline-medium on-background-text">Tareas eliminadas</span>
                </div>
                <!-- <div class="simple-container grow-1 align-center justify-center">
                    <span class="headline-small outline-text user-select-none">Próximamente</span>
                </div> -->
                <div 
                    id="response-deleted-tasks-container"
                    class="simple-container direction-column gap-8"
                    >
                </div>
                <div class="simple-container width-100 container-info-empty-table grow-1"></div>
                <div class="simple-container" id="pagination-deleted-tasks-container"></div>
            </div>
        </div>
        
    </holder>

</window>
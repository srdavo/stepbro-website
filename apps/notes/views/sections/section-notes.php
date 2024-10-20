<section id="section-notes">
    <div class="simple-container justify-between">
        <div class="simple-container">
            <span class="headline-large">Notas</span>
        </div>
        <div class="simple-container gap-8">
            <div class="simple-container hide-on-mobile" id="folders-view-selector-parent">
                <span 
                    class="view-selector" 
                    data-folders-view-type="column" 
                    onclick="changeFoldersView(this)"
                    data-tooltip="Vista de columnas"
                    active
                    >
                    <md-ripple></md-ripple>
                    <md-icon>view_column</md-icon>
                </span>
                <span 
                    class="view-selector" 
                    data-folders-view-type="grid" 
                    onclick="changeFoldersView(this)"
                    data-tooltip="Vista de lista"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>grid_view</md-icon>
                </span>
            </div>

            <span class="position-relative">
                <md-filled-tonal-icon-button 
                    onclick="toggleMenu('menu-notes-options')" 
                    class="solid"
                    id="toggler-menu-notes-options"
                    data-tooltip="Papelera"
                    >
                    <md-icon>delete_sweep</md-icon>
                </md-filled-tonal-icon-button>
                <md-menu id="menu-notes-options" style="min-width:264px;" anchor="toggler-menu-notes-options">
                    <md-menu-item onclick="openDeletedNotesWindow()" data-flip-id="animate">
                        <md-icon slot="start" aria-hidden="true">restore_from_trash</md-icon>
                        <div slot="headline">Notas eliminadas</div>
                    </md-menu-item>
                    <md-menu-item onclick="openDeletedFoldersWindow()" data-flip-id="animate">
                        <md-icon slot="start" aria-hidden="true">folder_delete</md-icon>
                        <div slot="headline">Carpetas eliminadas</div>
                    </md-menu-item>
                    
                </md-menu>
            </span>
            

            <md-outlined-button onclick="toggleCreateFolderWindow()" data-flip-id="animate">
                <md-icon slot="icon">add</md-icon>
                <span>Crear carpeta</span>
            </md-outlined-button>
        </div>
        
    </div>

    <div class="simple-container gap-8 grow-1 overflow-auto" id="main-folders-parents-container">
        <div
            id="main-folders-container" 
            class="content-box light-color folders-parent"
            >
            <div class="folders-list grow-1">
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
            <div class="simple-container direction-column folders-list height-max-content">
                <div 
                    class="folder" 
                    data-flip-id="animate"
                    onclick="toggleCreateFolderWindow()"
                    >
                    <md-ripple></md-ripple>
                    <div class="loader-container"></div>
                    <md-icon>create_new_folder</md-icon>
                    <span>Crear carpeta</span>
                </div>
                <div
                    class="folder"
                    onclick="createNoteInsideFolder(this)"
                    >
                    <md-ripple></md-ripple>
                    <div class="loader-container"></div>
                    <md-icon>edit_square</md-icon>
                    <span>Crear nota</span>
                </div>
            </div>
        </div>
        
        <div
            id="folders-note-parent" 
            class="content-box grow-1 note-parent"
            >
            <div class="simple-container justify-center align-center grow-1 direction-column gap-8" data-default-view>
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

<template id="template-folders-parent">
    <div class="content-box light-color folders-parent">    
        <div class="folders-list grow-1"></div>
        <div class="folders-list height-max-content overflow-visible">
            <div class="folder" onclick="removeSingleFolderParent(this)">
                <md-ripple></md-ripple>
                <md-icon>close</md-icon>
                <span>Cerrar carpeta</span>
            </div>
            <div 
                class="folder" 
                onclick="createFolderFromFolder(this)"
                data-flip-id="animate"
                >
                <md-ripple></md-ripple>
                <div class="loader-container"></div>
                <md-icon>create_new_folder</md-icon>
                <span>Crear carpeta</span>
            </div>
            <div
                class="folder"
                onclick="createNoteInsideFolder(this)"
                >
                <md-ripple></md-ripple>
                <div class="loader-container"></div>
                <md-icon>edit_square</md-icon>
                <span>Crear nota</span>
            </div>
            <span class="position-relative">
                <div
                    class="folder more-options-button"
                    data-flip-id="animate"
                    onclick="toggleMenu(undefined, this)"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>more_vert</md-icon>
                    <span>Más opciones</span>
                </div>
                <md-menu class="md-menu" style="min-width:264px;" anchor="closest('div.folder')">
                    <md-menu-item 
                        data-button-folder-info 
                        data-flip-id="animate"
                        >
                        <md-icon slot="start">info</md-icon>
                        <div slot="headline">Información</div>
                    </md-menu-item>
                    <md-menu-item 
                        data-button-edit-folder-name 
                        data-flip-id="animate"
                        >
                        <md-icon slot="start">bookmark_manager</md-icon>
                        <div slot="headline">Cambiar nombre</div>
                    </md-menu-item>
                    <md-menu-item 
                        data-button-move-folder 
                        data-flip-id="animate"
                        >
                        <md-icon slot="start">drive_file_move</md-icon>
                        <div slot="headline">Mover carpeta</div>
                    </md-menu-item>
                    <md-menu-item onclick="toggleDeleteFolderDialog(this)" data-flip-id="animate">
                        <md-icon slot="start">folder_delete</md-icon>
                        <div slot="headline">Eliminar carpeta</div>
                    </md-menu-item>
                </md-menu>
            </span>
            
        </div>
    </div>
</template>

<template id="template-note-default-view">
    <div class="simple-container justify-center align-center grow-1 direction-column gap-8" data-default-view>
        <md-icon class="pretty">folder_open</md-icon>
        <span class="body-large bricolage weight-500 on-background-text">Selecciona una nota para comenzar a editarla</span>
    </div>
</template>

<template id="template-note-editor">
    <form onsubmit="createNote(event, this)" class="simple-container direction-column grow-1" data-note-editor-parent>
        <div class="simple-container bottom-margin-8 justify-between">
            <div class="simple-container">
                <md-icon-button type="button" onclick="closeNoteEditor(this)"><md-icon>close</md-icon></md-icon-button>
            </div>
            <div class="simple-container gap-8">
                <md-icon-button 
                    type="button" 
                    data-flip-id="animate"
                    data-button-open-info
                    onclick="toggleWindow('#window-item-info', 'absolute', 1)"
                    data-tooltip="Información"
                    >
                    <md-icon>info</md-icon>
                </md-icon-button>
                <md-icon-button 
                    type="button" 
                    data-button-move-note
                    data-flip-id="animate"
                    data-tooltip="Mover"
                    >
                    <md-icon>drive_file_move</md-icon>
                </md-icon-button>
                <md-icon-button 
                    type="button"
                    data-button-delete-note
                    data-tooltip="Eliminar"
                    >
                    <md-icon>delete</md-icon>
                </md-icon-button>
            </div>
        </div>
        <div class="content-box light-color padding-8 direction-row gap-0 flex-wrap">
            <md-icon-button type="button" onclick="execCmd('undo')" role="presentation" value=""><md-icon aria-hidden="true">undo</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('redo')" role="presentation" value=""><md-icon aria-hidden="true">redo</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('bold')" role="presentation" value=""><md-icon aria-hidden="true">format_bold</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('italic')" role="presentation" value=""><md-icon aria-hidden="true">format_italic</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('underline')" role="presentation" value=""><md-icon aria-hidden="true">format_underlined</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('justifyLeft')" role="presentation" value=""><md-icon aria-hidden="true">format_align_left</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('justifyCenter')" role="presentation" value=""><md-icon aria-hidden="true">format_align_center</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('justifyRight')" role="presentation" value=""><md-icon aria-hidden="true">format_align_right</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('insertOrderedList')" role="presentation" value=""><md-icon aria-hidden="true">format_list_numbered</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('insertUnorderedList')" role="presentation" value=""><md-icon aria-hidden="true">format_list_bulleted</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h1>')" role="presentation" value=""><md-icon aria-hidden="true">format_h1</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h2>')" role="presentation" value=""><md-icon aria-hidden="true">format_h2</md-icon></md-icon-button>
            <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h3>')" role="presentation" value=""><md-icon aria-hidden="true">format_h3</md-icon></md-icon-button>
        </div>
        <div class="editor" contenteditable="true" aria-placeholder="Escribe tu nota aquí..." ></div>
        <div class="simple-container justify-right top-margin-16">
            <md-icon class="pretty small ui-confirm-note-changes">cloud_done</md-icon>
            <!-- <md-filled-button type="submit" role="presentation" value="">Guardar</md-filled-button> -->
        </div>
    </form>
</template>

<template id="template-item-parent">
    <div    
        data-item-parent
        onclick="displayFolderContent(4, this)" 
        data-folder-id="4" 
        data-folder-created-at="2024-09-30 00:03:36" 
        data-folder-name="Ideas" 
        data-item-type="folder" 
        class="folder"
        >
        <div class="loader-container"></div>
        <md-ripple></md-ripple>
        <md-icon class="primary-text" data-item-icon>folder</md-icon>
        <span data-item-name>Ideas</span>
    </div>
</template>
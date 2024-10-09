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
                    active
                    >
                    <md-ripple></md-ripple>
                    <md-icon>view_column</md-icon>
                </span>
                <span 
                    class="view-selector" 
                    data-folders-view-type="grid" 
                    onclick="changeFoldersView(this)"
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
                    >
                    <md-icon>more_vert</md-icon>
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
                    <md-icon>create_new_folder</md-icon>
                    <span>Crear carpeta</span>
                </div>
                <div
                    class="folder"
                    onclick="createNoteInsideFolder(this)"
                    >
                    <md-ripple></md-ripple>
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
        <div class="folders-list height-max-content">
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
                <md-icon>create_new_folder</md-icon>
                <span>Crear carpeta</span>
            </div>
            <div
                class="folder"
                onclick="createNoteInsideFolder(this)"
                >
                <md-ripple></md-ripple>
                <md-icon>edit_square</md-icon>
                <span>Crear nota</span>
            </div>
            <div
                class="folder"
                data-flip-id="animate"
                onclick="toggleWindow('#window-folder-info', 'absolute', 1)"
                >
                <md-ripple></md-ripple>
                <md-icon>info</md-icon>
                <span>Información</span>
            </div>
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
    <form onsubmit="createNote(event, this)" class="simple-container direction-column grow-1">
        <div class="simple-container bottom-margin-8 justify-between">
            <div class="simple-container">
                <md-icon-button type="button" onclick="closeNoteEditor(this)"><md-icon>close</md-icon></md-icon-button>
            </div>
            <div class="simple-container gap-8">
                <md-icon-button 
                    type="button" 
                    onclick="message('Esto dará la opción demover de carpeta la nota')"
                    data-tooltip="Mover"
                    >
                    <md-icon>drive_file_move</md-icon>
                </md-icon-button>
                <md-icon-button 
                    type="button" 
                    onclick="message('Esto abrira una ventana para pregunatar confirmación de eliminación')"
                    data-tooltip="Eliminar"
                    button-delete-note
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
            <md-filled-button type="submit" role="presentation" value="">Guardar</md-filled-button>
        </div>
    </form>
</template>


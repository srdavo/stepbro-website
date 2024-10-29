<section id="section-diary">

    <div class="quick-note-main-parent on-background-text">
        <div class="quick-note-editor-parent" >
            <div class="clickeable-to-open" onclick="toggleQuickNoteEditor()"></div>
            <md-ripple></md-ripple>
            <div class="simple-container direction-column quick-note-title">
                <span class="display-small bricolage weight-600">Mi diario</span>
                <span id="diary-date" class="date-container outline-text"></span>
            </div>
            <div class="editor-toolbar">
                <md-filled-tonal-icon-button type="button" onclick="toggleQuickNoteEditor()"><md-icon>close</md-icon></md-filled-tonal-icon-button>
                <md-icon-button type="button" onclick="execCmd('undo')"><md-icon>undo</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('redo')"><md-icon>redo</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('bold')"><md-icon>format_bold</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('italic')"><md-icon>format_italic</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('underline')"><md-icon>format_underlined</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyLeft')"><md-icon>format_align_left</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyCenter')"><md-icon>format_align_center</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyRight')"><md-icon>format_align_right</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('insertOrderedList')"><md-icon>format_list_numbered</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('insertUnorderedList')"><md-icon>format_list_bulleted</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h1>')"><md-icon>format_h1</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h2>')"><md-icon>format_h2</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h3>')"><md-icon>format_h3</md-icon></md-icon-button>
            </div>
            <div 
                id="create-diary-content" 
                class="editor" 
                contenteditable="true" 
                aria-placeholder="¿Cómo te ha ido hoy?"    
            ></div>
            <md-icon class="pretty small ui-confirm-note-changes">cloud_done</md-icon>
        </div>
        <md-filled-tonal-button 
            class="scroll-to-quick-notes hide-on-editor-open" 
            id="diary-open-button"
            data-flip-id="animate" 
            onclick="toggleCheckDiaryNotes()"
            active
            >
            <md-icon slot="icon">auto_stories</md-icon>
            Contenido del diario
        </md-filled-tonal-button>

    </div>

  
    <!-- <div 
        class="content-box light-color direction-column grow-1 on-background-text editor-parent" 
        style="width:100%; max-width:600px; max-height:500px;"
        >
        <span class="display-small text-center">Mi Diario</span>
        <span id="diary-date"></span>
        <div 
                    class="folder" 
                    data-flip-id="animate"
                    onclick="toggleCheckDiaryNotes()"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>create</md-icon>
                    <span>Contenido del diario</span>
                </div>


        
            <div class="content-box top-margin-16 padding-8 direction-row gap-0 border-radius-24 flex-wrap">
                <md-icon-button type="button" onclick="execCmd('undo')"><md-icon>undo</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('redo')"><md-icon>redo</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('bold')"><md-icon>format_bold</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('italic')"><md-icon>format_italic</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('underline')"><md-icon>format_underlined</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyLeft')"><md-icon>format_align_left</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyCenter')"><md-icon>format_align_center</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('justifyRight')"><md-icon>format_align_right</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('insertOrderedList')"><md-icon>format_list_numbered</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('insertUnorderedList')"><md-icon>format_list_bulleted</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h1>')"><md-icon>format_h1</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h2>')"><md-icon>format_h2</md-icon></md-icon-button>
                <md-icon-button type="button" onclick="execCmd('formatBlock', false, '<h3>')"><md-icon>format_h3</md-icon></md-icon-button>
            </div>
            <div 
                id="create-diary-content" 
                class="editor" 
                contenteditable="true" 
                aria-placeholder="Escribe como te ha ido en el Día"
                onclick="resizeEditor(this)"
            ></div>
            <div class="simple-container justify-right top-margin-16">
                <md-icon class="pretty small ui-confirm-note-changes">cloud_done</md-icon>

            </div>

        

    </div> -->

</section>
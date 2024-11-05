<section id="section-home" active class="gap-24" style="margin:auto;">
    <div class="simple-container only-on-mobile-soft hide-on-editor-open" style="position:absolute; left:24px; z-index:2;" id="parent-menu-app-options-mobile" active>
        <md-icon-button onclick="toggleMenu('menu-app-options-mobile')" id="toggler-menu-app-options-mobile"><md-icon>more_vert</md-icon></md-icon-button>
        <md-menu id="menu-app-options-mobile" style="min-width:264px; z-index:5;" anchor="toggler-menu-app-options-mobile">
            <md-menu-item onclick="toggleWindow('#window-settings', '', 1)" data-flip-id="animate">
                <md-icon slot="start" aria-hidden="true">settings</md-icon>
                <div slot="headline">Configuración</div>
            </md-menu-item>
            <md-menu-item onclick="openTrashWindow()" data-flip-id="animate">
                <md-icon slot="start" aria-hidden="true">delete</md-icon>
                <div slot="headline">Papelera</div>
            </md-menu-item>
            <md-menu-item onclick="location.reload()">
                <md-icon slot="start" aria-hidden="true">refresh</md-icon>
                <div slot="headline">Recargar App</div>
            </md-menu-item>
            <md-menu-item onclick="window.location.href='index'">
                <md-icon slot="start" aria-hidden="true">first_page</md-icon>
                <div slot="headline">Volver a inicio</div>
            </md-menu-item>
        </md-menu>
    </div>

    <div class="quick-note-main-parent on-background-text">
        <div class="quick-note-editor-parent" data-note-id >
            <div class="clickeable-to-open" onclick="toggleQuickNoteEditor()"></div>
            <md-ripple></md-ripple>
            <div class="simple-container direction-column quick-note-title">
                <span class="display-small bricolage weight-600">Nota rápida</span>
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
                id="create-note-content" 
                class="editor" 
                contenteditable="true" 
                aria-placeholder="Escribe tu nota aquí..."    
            ></div>
            <md-icon class="pretty small ui-confirm-note-changes">cloud_done</md-icon>
        </div>
        <!-- <md-filled-tonal-button class="scroll-to-quick-notes" onclick="scrollQuickNotesToView()"><md-icon slot="icon">arrow_downward</md-icon>Mis notas rápidas</md-filled-tonal-button> -->
   </div>
   <!-- <div class="simple-container direction-column gap-8" id="home-quick-notes-container" style="min-height:100%;">
        
        <div class="content-box light-color grow-1">
            <span class="display-medium on-background-text width-100 text-center">Mis notas rápidas</span>
        </div>
   </div> -->


    <!-- <div class="simple-container direction-column grow-1 align-center width-100" data-quick-notes-editor>   
        
        <div class="quick-note-editor-parent">
            <div class="editor-toolbar">
                <md-filled-tonal-icon-button type="button" onclick="toggleHomeEditorSize(this)"><md-icon>close</md-icon></md-filled-tonal-icon-button>
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
                class="editor" 
                contenteditable="true" 
                aria-placeholder="Escrube tu nota aquí..."
                onclick="toggleHomeEditorSize(this)"
            ></div>
        </div>
        <script>
            function toggleHomeEditorSize(originButton){
                if(originButton.classList.contains('editor')){
                    originButton.closest('.quick-note-editor-parent').setAttribute('active', '');

                    ;
                }else{
                    const editor = document.querySelector("#section-home .editor");
                    // setTimeout(() => {
                        // const editorHeight = editor.clientHeight;
                        // console.log('Editor height:', editorHeight);
                        // editor.style.maxHeight = 29 + 'px';
                    // }, 700)

                    // state = Flip.getState('[data-quick-notes-editor], [data-quick-notes-container]');
                    // 
                    // applyAnimation(state, '[data-quick-notes-editor]', false);
                    // applyAnimation(state, '[data-quick-notes-container]', true, false);'

                    setTimeout(() => {
                        editor.innerHTML = "";
                    }, 400);

                    
                    originButton.closest('.quick-note-editor-parent').toggleAttribute('active');
                }
                
            }
            function loadQuickNote(originButton){
                const content = originButton.querySelector('[data-quick-note-content]').innerHTML;
                const editor = document.querySelector("#section-home .editor");
                
                
                toggleHomeEditorSize(editor)
                // setTimeout(() => {
                    // state = Flip.getState('[data-quick-notes-editor]');
                    editor.innerHTML = content;
                    // applyAnimation(state, '[data-quick-notes-editor]', false);

                // }, 400);
                
            }

        </script>
    </div> -->

    <!-- <div class="simple-container direction-column gap-8">
        <span class="headline-large bricolage weight-500 on-background-text">Notas rápidas</span>
    
        <div class="simple-container flex-wrap width-100 gap-8" data-quick-notes-container>
            <div class="content-box card style-detailed" onclick="loadQuickNote(this)">
                <md-ripple></md-ripple>
                <div data-quick-note-content>
                    <span class="body-large">The computed values of ‘overflow-x’ and ‘overflow-y’ are the same as their specified values, except that some combinations with ‘visible’ are not possible: if one is specified as ‘visible’ and the other is ‘scroll’ or ‘auto’, then ‘visible’ is set to ‘auto’. The computed value of ‘overflow’ is equal to the computed value of ‘overflow-x’ if ‘overflow-y’ is the same; otherwise it is the pair of computed values of ‘overflow-x’ and ‘overflow-y’.</span>
                </div>
            </div>

            <div class="content-box card style-detailed" onclick="loadQuickNote(this)">
                <md-ripple></md-ripple>
                <div data-quick-note-content>
                    <span class="body-large"><span class="headline-medium weight-600">In my particular scenario.</span> <br>Where removing position: relative or using wrappers was not possible, this was the only solution that worked, although it did also require adding a lot of ugly margins to child elements inside the element which I wanted to set overflow-x: hidden on to compensate for the hacky padding. This saved me, though, so thanks!</span>
                </div>
            </div>

            <div class="content-box card style-detailed" onclick="loadQuickNote(this)">
                <md-ripple></md-ripple>
                <div data-quick-note-content>
                    <span class="body-large"><span class="headline-medium weight-600">In my particular scenario.</span> <br>Where removing position: relative or using wrappers was not possible, this was the only solution that worked, although it did also require adding a lot of ugly margins to child elements inside the element which I wanted to set overflow-x: hidden on to compensate for the hacky padding. This saved me, though, so thanks! The computed values of ‘overflow-x’ and ‘overflow-y’ are the same as their specified values, except that some combinations with ‘visible’ are not possible: if one is specified as ‘visible’ and the other is ‘scroll’ or ‘auto’, then ‘visible’ is set to ‘auto’. The computed value of ‘overflow’ is equal to the computed value of ‘overflow-x’ if ‘overflow-y’ is the same; otherwise it is the pair of computed values of ‘overflow-x’ and ‘overflow-y’ The computed values of ‘overflow-x’ and ‘overflow-y’ are the same as their specified values, except that some combinations with ‘visible’ are not possible: if one is specified as ‘visible’ and the other is ‘scroll’ or ‘auto’, then ‘visible’ is set to ‘auto’. The computed value of ‘overflow’ is equal to the computed value of ‘overflow-x’ if ‘overflow-y’ is the same; otherwise it is the pair of computed values of ‘overflow-x’ and ‘overflow-y’ The computed values of ‘overflow-x’ and ‘overflow-y’ are the same as their specified values, except that some combinations with ‘visible’ are not possible: if one is specified as ‘visible’ and the other is ‘scroll’ or ‘auto’, then ‘visible’ is set to ‘auto’. The computed value of ‘overflow’ is equal to the computed value of ‘overflow-x’ if ‘overflow-y’ is the same; otherwise it is the pair of computed values of ‘overflow-x’ and ‘overflow-y’</span>
                </div>
            </div>
            
            
        </div>
    </div> -->
    <!-- <div 
        class="content-box light-color direction-column grow-1 on-background-text border-radius-32 editor-parent" 
        style="width:100%; max-width:600px; max-height:500px;
            box-shadow: var(--md-sys-color-surface-container-lowest) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.06) 0px 42px 30px 0px
        "
        >
        <span class="display-small">Nota rápida</span>
        <form
            id="create-note-form" 
            onsubmit="createNote(event, this)"
            class="simple-container direction-column grow-1"
            >
  
        
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
                id="create-note-content" 
                class="editor" 
                contenteditable="true" 
                aria-placeholder="Escribe tu nota aquí..."
                onclick="resizeEditor(this)"
            ></div>
            <div class="simple-container justify-right top-margin-16">
                <md-icon class="pretty small ui-confirm-note-changes">cloud_done</md-icon>
            </div>

        </form>

        

    </div> -->

</section>
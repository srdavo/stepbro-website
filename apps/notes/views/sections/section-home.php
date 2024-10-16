<section id="section-home" active class="align-center" style="max-width:800px; margin:auto;">
  
    <!-- <div class="content-box border-radius-32 secondary-container on-secondary-container-text overflow-auto grow-1 padding-0">
        
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

    


    </div> -->
    <!-- <md-filled-button
        onclick="toggleWindow('#window-create-note', '', 1)"
        data-flip-id="animate"
        >
        <md-icon slot="icon">edit_square</md-icon>
        Crear nota
    </md-filled-button> -->
    <!-- <md-outlined-button onclick="toggleWindow('#window-move-item'); loadFileSystem('file-system-1');" data-flip-id="animate">Navegador de archivos</md-outlined-button> -->
    <!-- <div class="content-box testbar" onclick="testSize(this)" style="width:100px;"> -->
        <!-- <md-ripple></md-ripple> -->
    <!-- </div>
    <script>
        function testSize(originButton){
            state = Flip.getState('.testbar');
            originButton.style.width = '500px';
            applyAnimation(state, '.testbar', true);
        }
    </script> -->
    <div class="simple-container direction-column align-center width-100 gap-24">        
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
                aria-placeholder="Nota rápida"
                onclick="toggleHomeEditorSize(this)"
            ></div>
        </div>
        <script>
            function toggleHomeEditorSize(originButton){
                if(originButton.classList.contains('editor')){
                    originButton.closest('.quick-note-editor-parent').setAttribute('active', '');
                }else{
                    originButton.closest('.quick-note-editor-parent').toggleAttribute('active');
                }
            }

        </script>
    </div>

    <div class="simple-container">
        <div class="content-box"></div>
        <div class="content-box"></div>
        <div class="content-box"></div>
        <div class="content-box"></div>
    </div>
    
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
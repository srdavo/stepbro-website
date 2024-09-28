<window 
    id="window-create-note"
    class="increased h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
    </div>
    <holder>
        <span class="display-medium bricolage weight-600" style="text-wrap:nowrap">
            Crear nota
        </span>

        <div class="toolbar">
        <button onclick="execCmd('bold')"><i class='bx bx-bold'></i></button>
            <button onclick="execCmd('italic')"><i class='bx bx-italic'></i></button>
            <button onclick="execCmd('underline')"><i class='bx bx-underline'></i></button>
            <button onclick="execCmd('justifyLeft')"><i class='bx bx-align-left'></i></button>
            <button onclick="execCmd('justifyCenter')"><i class='bx bx-align-justify'></i></button>
            <button onclick="execCmd('justifyRight')"><i class='bx bx-align-right'></i></button>
            <button onclick="execCmd('insertOrderedList')"><i class='bx bx-list-ol'></i></button>
            <button onclick="execCmd('insertUnorderedList')"><i class='bx bx-list-ul'></i></button>
            <button onclick="execCmd('undo')"><i class='bx bx-subdirectory-left'></i></button>
            <button onclick="execCmd('redo')"><i class='bx bx-subdirectory-right' style='color:#ffffff' ></i></button>
            <button onclick="execCmd('formatBlock', false, '<h1>')"><i class='bx bx-heading'></i></button>
            <button onclick="execCmd('formatBlock', false, '<h2>')"><i class='bx bx-font-size'></i></button>
        </div>
        
        <form 
            id="create-note-form" 
            onsubmit="createNote(event)"
            class="simple-container direction-column gap-16 v-margin grow-1"
            >

            <!-- <div 
                id="create-note-content" 
                class="editor" 
                contenteditable="true" 
                placeholder="Escribe tu nota aquí..." 
                label = "Nota"
            ></div> -->
<!-- 
            <md-outlined-text-field 
                id="create-note-content"
                type="textarea" 
                label="Nota"
                style="height:100%"
            ></md-outlined-text-field>-->
            <div class="simple-container justify-right">
                <md-filled-button type="submit">Crear</md-filled-button>
            </div>

        </form>
        
        

    </holder>

</window>
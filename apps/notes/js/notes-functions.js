function syncNotes(){
    // displayNotes();
}
// global variables 
let timeOut;
let idNote = null;
let noteStatus = 1;
let timeoutPromise = null; 
let note = document.getElementById("create-note-content");
let quickNoteId = null;

note.addEventListener("input", () => {
    clearTimeout(timeOut);
    timeOut = setTimeout(() => {
        let noteContent = note.innerHTML;
        saveNote(noteContent,true);
    },950);
});

async function saveNote(content, isQuickNote = false){
    const parentId = "#window-create-note";
    if(!checkEmpty(parentId, "input")){return;}
    const data = {
        op: "save_note",
        content: content.replace(/'/g, "\\'"),
        id: isQuickNote ? note.getAttribute("data-note-id") : idNote,
        status: noteStatus
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        // console.log(result);
        if (result) {
            if (result.id) {
                if(isQuickNote){
                    note.setAttribute("data-note-id", result.id);
                    if (typeof result.id === 'number') {
                        createUiNote(result.id, 0, cleanHTMLContent(content));
                    } else {
                        updateNoteUiName(result.id, content);
                    }
                }
                else {   
                    idNote = result.id;
                    
                } 
                
                //form.querySelector(".editor").innerHTML = "";
                //form.closest(".editor-parent").removeAttribute("active");
                // message("Nota guardada", "success");
                uiConfirmNoteChanges();
                syncNotes();
                
                // toggleWindow();
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }


}
function uiConfirmNoteChanges(){
    const uiIndicator = document.querySelector("section[active] .ui-confirm-note-changes");
    uiIndicator.setAttribute("active", "");
    uiIndicator.addEventListener("animationend", () => {uiIndicator.removeAttribute("active")}, {once: true})
}

// Boton Code
/*
async function createNote(event, form){
    event.preventDefault();
    const parentId = "#window-create-note";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "create_note",
        content: document.getElementById("create-note-content").innerHTML
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        console.log(result);
        toggleButton(parentId, false);
        if (result) {
            if (result.id) {
                form.querySelector(".editor").innerHTML = "";
                form.closest(".editor-parent").removeAttribute("active");
                message("Nota creada", "success");
                syncNotes();
                
                // toggleWindow();
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
*/
async function getNotes(page = 0){
    const data = {
        op: "get_notes",
        page:page,
    }
    const url = `controllers/notes.controller.php`
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json'}
        });
        if (response.ok) {
            const result = await response.json();
            if(result.success){ 
                // console.log(result);
                return result;
            } else { 
                message(`Hubo un error: ${result.message}`, "error"); 
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

async function displayNotes(page = 0){
    const result = await getNotes(page);
    if(!result){return;}

    const container = document.getElementById("response-notes-table");
    container.nextElementSibling.innerHTML = ``;

    if(!result.data || result.data.length === 0){
        container.nextElementSibling.innerHTML = `
            <div class="content-box on-background-text align-center info-table-empty">
                <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                <span class="headline-small">No hay registros</span>
            </div>
        `;
        return;
    }

    container.innerHTML = `
        ${result.data.map(note => `
            
            <div class="content-box">
                ${note.content.replace(/\n/g, '<br>')}
            </div>
            
        `).join("")}
    `;
    displayNotesPagination(result.total_rows, result.limit, page);
}
function displayNotesPagination(totalRows, limit, currentPage = 0){
    const container = document.getElementById("pagination-notes-table");
    const pageCount = Math.ceil(totalRows / limit);
    if(pageCount <= 1){container.innerHTML = "";return;}

    let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
    for (let i = 0; i < pageCount; i++) {
        if (i === currentPage) {
            paginationHTML += `<md-filled-tonal-icon-button onclick='displayNotes(${i})'><md-icon class="filled">counter_${i+1}</md-icon></md-filled-tonal-icon-button>`;
        } else {
            paginationHTML += `<md-icon-button onclick='displayNotes(${i})'>${i + 1}</md-icon-button>`;
        }
    }
    paginationHTML += `</span>`;
    container.innerHTML = paginationHTML;
}

function resizeEditor(editor){
    const editorParent = editor.closest(".editor-parent");
    editorParent.setAttribute("active", "");

    // editorParent.style.maxWidth = "1000px";
    // editorParent.style.maxHeight = "100%";
}

async function getNoteContent(noteId){
    const data = {
        op: "get_note_content",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json'}
        });
        if (response.ok) {
            const result = await response.json();
            if(result.success){ 
                return result;
            } else { 
                message(`Hubo un error: ${result.message}`, "error"); 
                return false;
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}


async function displayNoteContent(noteId, originButton){
    // 0. Check if note should ask for pin (if it's encrypted)
    const noteStatus = originButton.getAttribute("data-note-status");
    if(noteStatus == 2 && encryptedNoteOpen == false){
        openEncryptedNote(noteId);
        return;
    }
    if(noteStatus == 2 && encryptedNoteOpen == true){
        encryptedNoteOpen = false;
    }

    // 1. Manage the visually active button from the folders list
    if(!manageActiveFolderSelector(originButton)){return;}

    // 2. Get the note content from DB with the loader included
    const loaderContainer = originButton.querySelector(".loader-container");
    if(loaderContainer){toggleLoaderIndicator(loaderContainer);}
    const note = await getNoteContent(noteId);
    if(loaderContainer){toggleLoaderIndicator(loaderContainer);}
    if(!note){return;}

    if (timeoutPromise) {await timeoutPromise; }

    // 3. Load the note editor to its container
    setNoteEditorContent(note);
    function execCmd(command, showUI = false, value = null) {
        document.execCommand(command, showUI, value);
    }
    

    // 4. Manage the folders parent (folder columns)
    const currentFoldersParent = originButton.closest(".folders-parent");
    removeFoldersParent(currentFoldersParent);
    manageReducedFoldersParent(currentFoldersParent);
    reduceAllFoldersParent();

    // 5. Set the data attributes of the note to the note editor
    setNoteDataAttributes(originButton);
}
function setNoteDataAttributes(originNoteButton){
    const noteId = originNoteButton.getAttribute("data-note-id");
    const noteName = originNoteButton.getAttribute("data-note-name");
    const noteCreatedAt = originNoteButton.getAttribute("data-note-created-at");
    const noteStatus = originNoteButton.getAttribute("data-note-status");

    const noteEditor = document.getElementById("folders-note-parent").querySelector("[data-note-editor-parent]");
    noteEditor.setAttribute("data-note-id", noteId);
    noteEditor.setAttribute("data-note-name", noteName);
    noteEditor.setAttribute("data-note-created-at", noteCreatedAt);
    noteEditor.setAttribute("data-item-type", "note");
    noteEditor.setAttribute("data-note-status", noteStatus);

    noteEditor.querySelector("[data-button-open-info]").onclick = function(){ 
        toggleNoteInfoWindow({
            id: noteId,
            name: noteEditor.getAttribute("data-note-name"),
            created_at: noteCreatedAt
        }) 
    }
    noteEditor.querySelector("[data-button-move-note]").onclick = function(){ toggleMoveItemWindow(this, 'note') }
    noteEditor.querySelector("[data-button-delete-note]").onclick = function(){ toggleDeleteNoteDialog(noteId) }
    setEncryptButtonAction(noteEditor.querySelector("[data-button-encrypt-note]"), noteStatus, noteId);
    if(noteStatus == 2){noteEditor.querySelector("[data-button-delete-note]").disabled = true;}
    // noteEditor.querySelector("[data-buttton-encrypt-note").onclick = function(){ openEncryptNoteWindow(); }
}
function toggleNoteInfoWindow(noteData){
    document.getElementById("response-info-item-name").textContent = noteData.name;
    document.getElementById("response-info-item-type").textContent = "Nota";
    document.getElementById("response-info-item-id").textContent = noteData.id;
    document.getElementById("response-info-item-created-at").textContent = noteData.created_at;

    toggleWindow('#window-item-info', 'absolute')
}
function setNoteEditorContent(note){
    const container = document.getElementById("folders-note-parent");
    container.innerHTML = "";
    const noteEditor = document.getElementById("template-note-editor").content.cloneNode(true);  
    noteEditor.querySelector("form > .editor").innerHTML = note.data[0].content; 
    container.appendChild(noteEditor);

    // Start the Rich text editor, format buttons, etc
    // const quill = startQuill("#templated-note-editor");
    // document.getElementById("main-note-editor-toggler-bold").onclick = function(){ editorToggleBold(quill) };
    container.addEventListener("mouseup", updateButtonStates);
    container.addEventListener("keyup", updateButtonStates);

    // const deleteButton = container.querySelector("[button-delete-note]");
    // deleteButton.onclick = function(){ toggleDeleteNoteDialog(note.data[0].id) };

    // code to save notes
    let editor = container.querySelector("form > .editor");
    idNote = note.data[0].id
    noteStatus = note.data[0].status;
    editor.addEventListener("input", () => {
        clearTimeout(timeOut); 

        timeoutPromise = new Promise((resolve) => {
            timeOut = setTimeout( () => {

                let noteContent = editor.innerHTML;

                saveNote(noteContent);   
                updateNoteUiName(idNote, noteContent);                
                resolve();
            }, 500);
        });
    });
}
function updateNoteUiName(noteId, noteContent){
    const activeNoteButton = document.querySelector(`.folder[data-note-id="${noteId}"]`);
    // console.log(activeNoteButton);
    if(!activeNoteButton){return;}
    const nameElement = activeNoteButton.querySelector("span:last-child");
    if(!nameElement){return;}

    newNoteName = cleanHTMLContent(noteContent);
    nameElement.textContent = newNoteName;
    activeNoteButton.setAttribute("data-note-name", newNoteName);
    const noteEditor = document.getElementById("folders-note-parent").querySelector("[data-note-editor-parent]");
    if(noteEditor){noteEditor.setAttribute("data-note-name", newNoteName);}
}




function setNoteDefaultView(){
    const container = document.getElementById("folders-note-parent");
    if(container.querySelector("[data-default-view]") && !(container.querySelector("[data-default-view]").nextElementSibling)){ return; }
    const noteDefaultView = document.getElementById("template-note-default-view").content.cloneNode(true);
    container.innerHTML = "";
    container.appendChild(noteDefaultView);
}
function checkNoteEditorContent(){
    const container = document.getElementById("folders-note-parent");
    if(container.querySelector("[data-default-view]")){ return false; }else{ return true; }
}
function closeNoteEditor(originButton){
    removeActiveFolderSelector(originButton)
    const container = document.getElementById("folders-note-parent");
    container.innerHTML = "";
    setNoteDefaultView();

    const currentFoldersParent = document.getElementById("folders-note-parent");
    removeFoldersParent(currentFoldersParent);
    manageReducedFoldersParent(currentFoldersParent);
}

// function manageNoteParentContent(){
//     const container = document.getElementById("folders-note-parent");

//     // const noteDefaultView = document.getElementById("template-note-default-view").content.cloneNode(true);
//     // container.innerHTML = "";
//     // container.appendChild(noteDefaultView);
// }


// Aunque se puede repetir código, estas funciones serán para mantener la creación de notas separado de el autoguardado y otras cosas.
async function createNote(originFolderId = 0){
    // Lo único que hará esta función es crear la nota, sin contenido ni nada, solo crear su existencia en la base de datos.
    const data = {
        op: "create_note_inside_folder",
        parent_folder_id: originFolderId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                return result.id
                message("Nota creada", "success");
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
function createUiNote(noteId = 0, originFolderId = 0, noteTitle = ''){
    if(originFolderId == 0 ){
        newNoteParent = document.getElementById("main-folders-container");
    }else{
        const activeItem = document.querySelector(`#main-folders-parents-container .folder[data-folder-id="${originFolderId}"]`);
        newNoteParent =  activeItem.closest(".folders-parent").nextElementSibling;
    }
    if(!newNoteParent || !newNoteParent.classList.contains("folders-parent")){return false;}

    const itemTemplate = document.getElementById("template-item-parent").content.cloneNode(true);
    const newNote = itemTemplate.querySelector("[data-item-parent]");
    newNote.setAttribute("data-note-id", noteId);
    newNote.setAttribute("data-note-name", (noteTitle == "") ? "Nota sin nombre" : noteTitle);
    newNote.setAttribute("data-note-created-at", new Date().toLocaleString());
    newNote.setAttribute("data-item-type", "note");
    newNote.setAttribute("data-item-status", "1");
    newNote.setAttribute("data-flip-id", "animate");

    newNote.querySelector("[data-item-name]").innerHTML = (noteTitle == "") ? "<i class='outline-text'>Nota sin nombre</i>" : noteTitle;
    newNote.querySelector("[data-item-icon]").textContent = "notes";
    newNote.querySelector("[data-item-icon]").className = "";

    newNote.onclick = function() { displayNoteContent(noteId, this); };
    
    newNote.setAttribute("openning", "");
    newNote.addEventListener("animationend", () =>{newNote.removeAttribute("openning")}, {once: true})
    
    
    newNoteParent.querySelector(".folders-list").appendChild(newNote);
    newNote.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    return newNote;
}

async function createNoteInsideFolder(originButton){
    if(!originButton){return}
    originButton.setAttribute("disabled", "");

    const loaderContainer = originButton.querySelector(".loader-container");
    if(loaderContainer){toggleLoaderIndicator(loaderContainer);}

    if(originButton.classList.contains("nav-button")){
        currentFoldersParent = document.getElementById("main-folders-container");
    }else{
        currentFoldersParent = originButton.closest(".folders-parent");
    }
    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    if(previousFoldersParent && previousFoldersParent.classList.contains("folders-parent")){
        originFolderId = previousFoldersParent.querySelector(".folder[active]").getAttribute("data-folder-id");
    }else{
        originFolderId = 0;
    }
    noteId = await createNote(originFolderId);
    newNote = createUiNote(noteId, originFolderId);
    displayNoteContent(noteId, newNote)

    originButton.removeAttribute("disabled");
    if(loaderContainer){toggleLoaderIndicator(loaderContainer);}
    return true;
}
function cleanHTMLContent(content) {
    // Elimina las clases de los elementos
    content = content.replace(/\s*class="[^"]*"/g, '');

    // Reemplaza &nbsp; y otras entidades comunes de espacio en blanco
    content = content.replace(/&nbsp;/g, ' ').replace(/\s+/g, ' ');

    // Caso 1: Si comienza con una etiqueta HTML
    if (content.startsWith("<")) {
        const firstClosingTagIndex = content.indexOf(">");
        if (firstClosingTagIndex !== -1) {
            const afterFirstTag = content.slice(firstClosingTagIndex + 1);
            const secondTagIndex = afterFirstTag.indexOf("<");
            if (secondTagIndex !== -1) {
                const firstTagContent = afterFirstTag.slice(0, secondTagIndex).trim();
                return firstTagContent;
            } else {
                return afterFirstTag.trim();
            }
        }
    }

    // Caso 2: Si comienza con texto plano
    const firstTagIndex = content.indexOf("<");
    if (firstTagIndex !== -1) {
        return content.slice(0, firstTagIndex).trim();
    }

    // Si no hay etiquetas HTML, devuelve el contenido tal como está
    return content.trim();
}



// Las siguientes funciones son para la eliminación de notas
function toggleDeleteNoteDialog(noteId){
    document.getElementById("button-confirm-delete-note").onclick = function(){ deleteNote(noteId) };
    toggleDialog("dialog-delete-note-confirmation");
}
async function deleteNote(noteId){
    const data = {
        op: "delete_note",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                message("Nota eliminada", "success");
                setNoteDefaultView();
                removeUiNote(noteId);
                toggleDialog();
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
function removeUiNote(noteId = 0){
    if(noteId == 0){return false;}
    const note = document.querySelector(`.folder[data-note-id="${noteId}"]`);
    const noteParent = note.closest(".folders-parent");
    note.setAttribute("removing", "");
    note.addEventListener("animationend", () => {note.remove();}, {once: true})
    manageReducedFoldersParent(noteParent);
}


// Las siguientes funciones son para la muestra de notas eliminadas
function openDeletedNotesWindow(){
    // toggleWindow("#window-deleted-items");
    toggleWSection('w-section-deleted-notes');
    displayDeletedNotes();
}
function toggleDeletedNoteContentView(originButton){
    // esta función es la que permite al usuario abrir el contenido de las notas eliminadas
    // state = Flip.getState(".deleted-item:not([active])");
    originButton.closest("[main-deleted-item-container]").nextElementSibling.toggleAttribute("active");
    // originButton.closest(".deleted-item").toggleAttribute("active");
    // applyAnimation(state, `.deleted-item:not([active])`);

}
async function getDeletedNotes(page = 0){
    const data = {
        op: "get_deleted_notes",
        page:page,
    }
    const url = `controllers/notes.controller.php`
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json'}
        });
        if (response.ok) {
            const result = await response.json();
            if(result.success){ 
                return result;
            } else { 
                message(`Hubo un error: ${result.message}`, "error"); 
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
async function displayDeletedNotes(page = 0){
    const result = await getDeletedNotes(page);
    if(!result){return;}
    

    const container = document.getElementById("response-deleted-notes-container");
    
    container.nextElementSibling.innerHTML = ``;
    if(!result.data || result.data.length === 0){
        container.nextElementSibling.innerHTML = `
            <div class="content-box light-color on-background-text align-center justify-center">
                <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                <span class="headline-small text-center">No hay <span class="primary-text">notas</span> eliminadas</span>
            </div>
        `;
        return;
    }

    
    container.innerHTML = `
        ${result.data.map(note => {
            noteName = (cleanHTMLContent(note.content) == "") ? "<i class='outline-text'>Nota sin nombre</i>" : cleanHTMLContent(note.content);

            return `
                <div class="deleted-item">
                    
                    <div class="simple-container grow-1 justify-between" main-deleted-item-container>
                        <div class="simple-container gap-8">    
                            <md-icon-button toggle onclick="toggleDeletedNoteContentView(this)">
                                <md-icon >notes</md-icon>
                                <md-icon slot="selected">arrow_drop_up</md-icon>
                            </md-icon-button>

                                
                            <span style="padding-top:12px;">${noteName}</span>
                        </div>
                        <div>
                            <md-icon-button 
                                onclick="toggleDeleteNoteForeverDialog(${note.id}, this)" 
                                data-tooltip="Eliminar permanentemente"
                                title="Eliminar permanentemente"
                                class="tooltip-left"
                                >
                                <md-icon>delete_forever</md-icon>
                            </md-icon-button>
                            <md-icon-button 
                                onclick="toggleRestoreNoteDialog(${note.id}, this)" 
                                data-tooltip="Recuperar"
                                title="Recuperar"
                                class="tooltip-left"
                                >
                                <md-icon>restore</md-icon>
                            </md-icon-button>
                        </div>
                    </div>
                    <div class="deleted-item-content-container">
                        <div class="deleted-item-content">
                            ${note.content}
                        </div>
                    </div>
                    
                </div>
            `;
        }).join("")}
    `;

    displayDeletedNotesPagination(result.total_rows, result.limit, page);
}
function displayDeletedNotesPagination(totalRows, limit, currentPage = 0){
    const container = document.getElementById("pagination-deleted-notes-container");
    const pageCount = Math.ceil(totalRows / limit);
    if(pageCount <= 1){container.innerHTML = "";return;}

    let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
    for (let i = 0; i < pageCount; i++) {
        if (i === currentPage) {
            paginationHTML += `<md-filled-tonal-icon-button onclick='displayDeletedNotes(${i})'><md-icon class="filled">counter_${i+1}</md-icon></md-filled-tonal-icon-button>`;
        } else {
            paginationHTML += `<md-icon-button onclick='displayDeletedNotes(${i})'>${i + 1}</md-icon-button>`;
        }
    }
    paginationHTML += `</span>`;
    container.innerHTML = paginationHTML;
}

// Las siguientes funciones son para la recuperación de notas eliminadas
function toggleRestoreNoteDialog(noteId, originButton){
    document.getElementById("button-confirm-restore-note").onclick = function(){ restoreDeletedNote(noteId, originButton) };
    toggleDialog("dialog-restore-note-confirmation");
}
async function restoreDeletedNote(noteId, originButton){
    const data = {
        op: "restore_deleted_note",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                message("Nota restaurada", "success");
                removeDeletedNoteFromUi(originButton);
                createUiNote(result.item_id, result.folder_id, originButton.closest(".deleted-item").querySelector("span").textContent);
                toggleDialog();
                toggleWindow();
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
function removeDeletedNoteFromUi(originButton){
    state = Flip.getState(".deleted-item:not([active])");
    originButton.closest(".deleted-item").remove();
    applyAnimation(state, ".deleted-item:not([active])");
}

// Las siguientes funciones son para la eliminación permanente de notas
function toggleDeleteNoteForeverDialog(noteId, originButton){
    document.getElementById("button-confirm-delete-note-forever").onclick = function(){ deleteNoteForever(noteId, originButton) };
    toggleDialog("dialog-delete-note-forever-confirmation");
}
async function deleteNoteForever(noteId, originButton){
    const data = {
        op: "delete_note_forever",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                message("Nota eliminada permanentemente", "success");
                removeDeletedNoteFromUi(originButton);
                toggleDialog();
            } else {
                message(`Hubo un error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}


// las siguientes funciones son para manejar la interfaz de las notas rápidas
function toggleQuickNoteEditor(){
    const quickNoteEditorParent = document.querySelector("section[active] .quick-note-editor-parent");

    // const quickNoteEditorParent = document.querySelector("#section-home .quick-note-editor-parent");
    if(!quickNoteEditorParent){return;}

    state = Flip.getState("section[active] .quick-note-editor-parent");
    quickNoteEditorParent.toggleAttribute("active");

    document.querySelectorAll(".hide-on-editor-open").forEach(element => {
        element.toggleAttribute("active");
    });


    applyAnimation(state, "section[active] .quick-note-editor-parent", false, true, true);

    if(quickNoteEditorParent.hasAttribute("active")){
        const editor = quickNoteEditorParent.querySelector(".editor");
        editor.focus();
        const range = document.createRange();
        const selection = window.getSelection();
        range.selectNodeContents(editor);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
    }else{
        resetQuickNoteEditor();
    }

}

function resetQuickNoteEditor(){
    note.innerHTML = "";
    note.removeAttribute("data-note-id");
}




function scrollQuickNotesToView(){
    document.getElementById("home-quick-notes-container").scrollIntoView({behavior: "smooth"});
}

async function quickCreateNote(originButton){
    toggleSection('section-notes');
    await createNoteInsideFolder(originButton);
}


// Las siguientes funciones son para la encriptación de notas


async function setEncryptButtonAction(button = false, noteStatus, noteId){
    if(!button) return false;    
    if(hasPin == ""){hasPin = await checkDiaryPin(); console.log("Al usuario aun no le cargaba el pin")}
    if(hasPin){
        if(noteStatus == 2){
            button.onclick = function(){
                openDecryptNoteWindow(noteId);
            }
            button.innerHTML = `<md-icon class='filled'>lock</md-icon>`;
            button.setAttribute("data-tooltip", "Nota bloqueada");
            button.setAttribute("title", "Nota bloqueada");
        }else{
            button.onclick = function(){ 
                console.log("El usuario ya tiene pin");
                openEncryptNoteWindow(noteId);
            }
            button.innerHTML = `<md-icon>encrypted_add</md-icon>`;
            button.setAttribute("data-tooltip", "Bloquear nota");
            button.setAttribute("title", "Bloquear nota");
        }

        
    }else{
        button.onclick = function(){ 
            message("Configura tu pin del Diario para utilizar esta función", "");
            // openSetEncryptPinWindow(); 
        }
    }
}

function openEncryptNoteWindow(noteId){
    toggleWindow("#window-encrypt-note", "absolute");
    document.getElementById("validate-encrypt-note-pin-input").focus();
    document.getElementById("validate-encrypt-note-pin-form").onsubmit = function(event){ 
        validateEncryptNotePin(event, noteId) 
    };
}
function openDecryptNoteWindow(noteId){
    toggleWindow("#window-decrypt-note", "absolute", 1);
    document.getElementById("validate-decrypt-note-pin-input").focus();
    document.getElementById("validate-decrypt-note-pin-form").onsubmit = function(event){ 
        validateEncryptNotePin(event, noteId, "decrypt") 
    };
}

async function encryptNote(noteId){
    const data = {
        op: "encrypt_note",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                return true;
            } else {
                message(`Hubo un error: ${result.message}`, "error");
                if(result.error){throw new Error(result.error)};
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
    return false;
}
async function decryptNote(noteId){
    const data = {
        op: "decrypt_note",
        note_id: noteId,
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if (result.success) {
                return true;
            } else {
                message(`Hubo un error: ${result.message}`, "error");
                if(result.error){throw new Error(result.error)};
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
    return false;
}

let encryptedNoteOpen = false
async function validateEncryptNotePin(event, noteId = false, action = "validate"){
    if(!noteId){return false;}
    event.preventDefault();
    var parentId = "#validate-encrypt-note-pin-form";
    if(action == "open"){parentId = "#validate-open-encrypt-note-pin-form";}
    if(action == "decrypt"){parentId = "#validate-decrypt-note-pin-form";}
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    pin = document.getElementById("validate-encrypt-note-pin-input").value
    if(action == "open"){pin = document.getElementById("validate-open-encrypt-note-pin-input").value}
    if(action == "decrypt"){pin = document.getElementById("validate-decrypt-note-pin-input").value}

    const data = {
        op: "validate_diary_pin",
        pin: pin
    }
    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                toggleWindow();
                if(action == "validate"){
                    message("Nota bloqueada", "success");
                    if(await encryptNote(noteId) == true){
                        updateNoteFrontEnd(noteId, 2);
                        closeNoteEditor(document.querySelector("#folders-note-parent").querySelector("[data-button-close-editor]"))
                        return true;
                    }
                }
                if(action == "open"){
                    // if(encryptedNoteOpen){return false;}
                    encryptedNoteOpen = true;
                    displayNoteContent(noteId, document.querySelector(`.folder[data-note-id="${noteId}"]`));
                    return true;
                }
                if(action == "decrypt"){
                    if(await decryptNote(noteId) == true){
                        updateNoteFrontEnd(noteId, 1);
                        closeNoteEditor(document.querySelector("#folders-note-parent").querySelector("[data-button-close-editor]"));
                        message("Nota desbloqueada correctamente ", "success");
                        return true;
                    }
                }
            } else {
                message(`${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

function updateNoteFrontEnd(noteId, status){
    const allNotesOpeners = document.querySelectorAll(`[data-note-id="${noteId}"]`);
    allNotesOpeners.forEach(opener => {
        opener.setAttribute("data-note-status", status);
        opener.setAttribute("data-item-status", status);
    });
}

function openEncryptedNote(noteId){
    toggleWindow("#window-validate-note-pin", "absolute");
    document.getElementById("validate-open-encrypt-note-pin-input").focus();
    document.getElementById("validate-open-encrypt-note-pin-form").onsubmit = function(event){ 
        validateEncryptNotePin(event, noteId, "open") 
    };
}


async function createPdf(){
    const content = document.getElementById("templated-note-editor").innerHTML
        const data = {
            content
        }
        console.log(data)
        const url = `helpers/GeneratePdfs.php`
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
            });
        if (response.ok) {
            const blob = await response.blob();  
            const url = URL.createObjectURL(blob);  
            const link = document.createElement('a');  
            link.href = url;
            link.download = 'Nota_de_StepbroNotes.pdf';  
            link.click();  
            URL.revokeObjectURL(url); 
        } else {
            console.log('Error en la generación del PDF');
        }
            
    } catch (error){
        console.log(error);
    }
}
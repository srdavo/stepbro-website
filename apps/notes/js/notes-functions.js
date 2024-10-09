function syncNotes(){
    displayNotes();
}
// global variables 
let timeOut;
let idNote = null;
let timeoutPromise = null; 
note = document.getElementById("create-note-content");

note.addEventListener("input", () => {
    clearTimeout(timeOut);
    timeOut = setTimeout(() => {
        noteContent = note.innerHTML;
        saveNote(noteContent);
    },950);
});

async function saveNote(content){
    const parentId = "#window-create-note";
    if(!checkEmpty(parentId, "input")){return;}
        const data = {
        op: "save_note",
        content: content,
        id: idNote
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
                idNote = result.id;
                //form.querySelector(".editor").innerHTML = "";
                //form.closest(".editor-parent").removeAttribute("active");
                message("Nota guardada", "success");
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
                console.log(result);
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
            ${console.log(note.content)}
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
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}


async function displayNoteContent(noteId, originButton){

    // 1. Manage the visually active button from the folders list
    if(!manageActiveFolderSelector(originButton)){return;}

    // 2. Get the note content from DB
    const note = await getNoteContent(noteId);
    if(!note){return;}

    if (timeoutPromise) {
        await timeoutPromise; 
    }

    // 3. 
    setNoteEditorContent(note);

    const currentFoldersParent = originButton.closest(".folders-parent");
    removeFoldersParent(currentFoldersParent);
    manageReducedFoldersParent(currentFoldersParent);

    reduceAllFoldersParent();
}
function setNoteEditorContent(note){
    const container = document.getElementById("folders-note-parent");
    container.innerHTML = "";
    const noteEditor = document.getElementById("template-note-editor").content.cloneNode(true);  
    noteEditor.querySelector("form > .editor").innerHTML = note.data[0].content;   
    console.log(note)
    console.log(noteEditor.querySelector("form > .editor"))
    container.appendChild(noteEditor);

    // code to save notes
    let editor = container.querySelector("form > .editor");
    idNote = note.data[0].id
    editor.addEventListener("input", () => {
        clearTimeout(timeOut); // Limpiar cualquier timeout anterior

        // Crear una nueva promesa para el timeout
        timeoutPromise = new Promise((resolve) => {
            timeOut = setTimeout( () => {

                let noteContent = editor.innerHTML;

                saveNote(noteContent);                   
                resolve();
            }, 500);
        });
    });
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
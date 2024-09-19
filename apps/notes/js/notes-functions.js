function syncNotes(){
    displayNotes();
}

async function createNote(event){
    event.preventDefault();
    const parentId = "#window-create-note";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "create_note",
        content: document.getElementById("create-note-content").value
    }
    const url = `controllers/notes.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Nota creada", "success");

                syncNotes();
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
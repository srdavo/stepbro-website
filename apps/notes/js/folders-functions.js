function syncFolders(){
    displayFolderList();
}

async function createFolder(event, originFolderId = 0){
    event.preventDefault();
    const parentId = "#window-create-folder";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "create_folder",
        folder_name: document.getElementById("create-folder-name").value,
        parent_folder_id: originFolderId
    }
    const url = `controllers/folders.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Calorias registradas", "success");
                data.id = result.id;
                toggleWindow();
                createUiFolder(data, originFolderId);
                return true;
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
function toggleCreateFolderWindow(){
    toggleWindow("#window-create-folder");
    document.getElementById("create-folder-form").onsubmit = function(event){ createFolder(event); }
}
function createFolderFromFolder(originButton){
    // this function is for creating a folder but inside another folder, this means that the button that triggers this function is inside a folder
    if(!originButton){return;}
    const currentFoldersParent = originButton.closest(".folders-parent");
    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    const originFolderId = previousFoldersParent.querySelector(".folder[active]").getAttribute("data-folder-id");
    console.log(`Creating folder inside folder ${originFolderId}`);

    toggleWindow("#window-create-folder");
    document.getElementById("create-folder-form").onsubmit = function(event){ createFolder(event, originFolderId); }
}
function createUiFolder(data, originFolderId = 0){
    if(originFolderId == 0){
        newFolderParent = document.getElementById("main-folders-container");
    }else{
        const activeFolder = document.querySelector(`#main-folders-parents-container .folder[data-folder-id="${originFolderId}"]`);
        var newFolderParent = activeFolder.closest(".folders-parent").nextElementSibling;
    }
    if(!newFolderParent || !newFolderParent.classList.contains("folders-parent")){return false;}

    const newFolder = document.createElement("div");
    newFolder.className = "folder";
    newFolder.setAttribute("data-folder-id", data.id);
    newFolder.innerHTML = `
        <md-ripple></md-ripple>
        <md-icon class="primary-text">folder</md-icon>
        <span>${data.folder_name}</span>
    `;
    newFolder.onclick  = function() {displayFolderContent(data.id, this)};
    newFolder.setAttribute("openning", "");
    newFolder.addEventListener("animationend", () =>{newFolder.removeAttribute("openning")}, {once: true})


    if(newFolderParent.querySelectorAll(".folders-list").length < 2){
        newFolderParent.innerHTML = `
        <div class="folders-list grow-1">
            ${newFolder.outerHTML}
        </div>
        <div class="folders-list" style="min-height:max-content">
            <div class="folder" onclick="removeSingleFolderParent(this)">
                <md-ripple aria-hidden="true"></md-ripple>
                <md-icon aria-hidden="true">close</md-icon>
                <span>Cerrar carpeta</span>
            </div>
            <div 
                class="folder" 
                onclick="createFolderFromFolder(this)"
                data-flip-id="animate"
                >
                <md-ripple aria-hidden="true"></md-ripple>
                <md-icon aria-hidden="true">create_new_folder</md-icon>
                <span>Crear carpeta</span>
            </div>
            <div class="folder">
                <md-ripple aria-hidden="true"></md-ripple>
                <md-icon aria-hidden="true">edit_square</md-icon>
                <span>Crear nota</span>
            </div>
        </div>
    `;
    }else{
        const foldersList = newFolderParent.querySelector(".folders-list");
        const folders = foldersList.querySelectorAll('.folder[data-folder-id]');
        const lastFolder = folders[folders.length - 1];
        if (lastFolder) {
            lastFolder.insertAdjacentElement('afterend', newFolder);
        } else {
            foldersList.appendChild(newFolder);
        }
        newFolder.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

}



async function getFolders(page = 0){
    const data = {
        op: "get_folders",
        page: page
    }
    const url = `controllers/folders.controller.php`
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


async function displayFolderList(page = 0){
    const result = await getFolders(page);
    if(!result.success){return;}

    const container = document.getElementById("main-folders-container").querySelector(".folders-list");
    container.innerHTML = `
        ${result.data.map(item => {
            itemName = item.item_type == "folder" ? cleanHTMLContent(item.item_name) : cleanHTMLContent(item.item_content);
            if(itemName == ""){itemNameFormated = `<i class="outline-text">Nota sin nombre</i>`;}else{itemNameFormated = itemName;}
            icon = item.item_type === "folder" ? "folder" : "notes";
            iconClass = item.item_type === "folder" ? "primary-text" : "";
            functionToCall = item.item_type === "folder" ? "displayFolderContent" : "displayNoteContent";

            return `
                <div
                    onclick="${functionToCall}(${item.id}, this)" 
                    data-${item.item_type}-id="${item.id}"
                    data-${item.item_type}-created-at="${item.created_at}"
                    data-${item.item_type}-name="${itemName}"
                    data-item-type="${item.item_type}"
                    class="folder"
                    >
                    <md-ripple></md-ripple>
                    <md-icon class="${iconClass}">${icon}</md-icon>
                    <span>${itemNameFormated}</span>
                </div>
            `
        }).join("")}
    `;

}




async function getFolderContent(folderId){
    const data = {
        op: "get_folder_content",
        folder_id: folderId
    }
    const url = `controllers/relations.controller.php`
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


async function displayFolderContent(folderId, originButton){

    // 1. Manejar el botón activo
    if(!manageActiveFolderSelector(originButton)){
        return;
    }

    // 2. Obtener el contenido de la carpeta desde la base de datos
    const result = await getFolderContent(folderId);
    if(!result.success){return;}

    // 3. Manjear las columnas
    manageFoldersParent(originButton);
    displayFolderContentList(result.data, originButton);

    // if there vas a note opened, when you open a folder it will close the note
    setNoteDefaultView();
}

function displayFolderContentList(data, originButton){
    if(data.length <= 0){return;}
    
    const newFoldersParent = (originButton.closest(".folders-parent")).nextElementSibling;   
    const newFoldersList = newFoldersParent.querySelector(".folders-list");
    
    newFoldersList.innerHTML = `
        ${data.map(item => {
            // Aquí cambiamos de 'folder' a 'item'
            itemName = item.item_type == "folder" ? cleanHTMLContent(item.item_title) : cleanHTMLContent(item.item_content);
            if(itemName == ""){itemNameFormated = `<i class="outline-text">Nota sin nombre</i>`;}else{itemNameFormated = itemName;}
            icon = item.item_type === "folder" ? "folder" : "notes";
            iconClass = item.item_type === "folder" ? "primary-text" : "";

            functionToCall = item.item_type === "folder" ? "displayFolderContent" : "displayNoteContent";
            

            return `
                <div
                    onclick="${functionToCall}(${item.item_id}, this)" 
                    data-${item.item_type}-id="${item.item_id}"
                    data-${item.item_type}-created-at="${item.created_at}"
                    data-${item.item_type}-name="${itemName}"
                    class="folder"
                    >
                    <md-ripple></md-ripple>
                    <md-icon class="${iconClass}">${icon}</md-icon>
                    <span>${itemNameFormated}</span>
                </div>
            `;
        }).join("")}
    `;
}


function manageFoldersParent(originButton){ // this column will manage the amount of "columns" to display folders exists
    const currentFoldersParent = originButton.closest(".folders-parent");
    var totalFoldersParent = countTotalFoldersParent(currentFoldersParent);
    var isNextSiblingReduced =  (currentFoldersParent.nextElementSibling.hasAttribute("reduced")) ? true : false;
    removeFoldersParent(currentFoldersParent);
    createFoldersParent(currentFoldersParent, totalFoldersParent ,isNextSiblingReduced);
    manageReducedFoldersParent();
}
function removeFoldersParent(currentFoldersParent) {
    let currentFoldersParentNextSibling = currentFoldersParent.nextSibling;
    let count = 0;
    let isFirstIteration = true; // Para detectar la primera iteración
    state = Flip.getState(`.note-parent`);
    
    while (currentFoldersParentNextSibling) {
        let nextSibling = currentFoldersParentNextSibling.nextSibling;
        
        // Crear una referencia local del nodo para evitar que cambie en el ciclo
        let folderToRemove = currentFoldersParentNextSibling;

        if (folderToRemove.classList && folderToRemove.classList.contains("folders-parent")) {
            if (isFirstIteration) {
                if(!currentFoldersParent.querySelector(".folder[active]").hasAttribute("data-note-id")){
                    folderToRemove.remove();                    
                }else{
                    folderToRemove.setAttribute("closing", "");
                    folderToRemove.addEventListener("animationend", () => { 
                        folderToRemove.remove(); 
                        count++; 
                    }, {once: true});
                }
                count ++;
                isFirstIteration = false;
            } else {
                // En las siguientes iteraciones, añadimos el atributo "closing" y esperamos la animación
                folderToRemove.setAttribute("closing", "");
                
                folderToRemove.addEventListener("animationend", () => { 
                    folderToRemove.remove(); 
                    count++; 
                }, {once: true});
            }
        }

        // Continuar con el siguiente nodo
        currentFoldersParentNextSibling = nextSibling;
    }

    // Uncomment this if you want to reapply animations if count > 2
    // if(count > 2) {
    //     applyAnimation(state, `.note-parent`);
    // }

    // console.log(`Deleted ${count} folders-parent elements.`);
    return count;
}


function createFoldersParent(currentFoldersParent, totalFoldersParent = 1, isNextSiblingReduced = false){
    if(!currentFoldersParent){return;}
    const newFoldersParent = document.getElementById("template-folders-parent").content.cloneNode(true).querySelector(".folders-parent");
    const randomId = Date.now().toString(36) + Math.floor(Math.random() * 1000);
    newFoldersParent.querySelector(".more-options-button").setAttribute("id", `toggler-menu-folder-options-${(randomId)}`);
    newFoldersParent.querySelector('md-menu').setAttribute("anchor", `toggler-menu-folder-options-${(randomId)}`);
    
    insertNewFoldersParent = () => { currentFoldersParent.parentNode.insertBefore(newFoldersParent, currentFoldersParent.nextSibling); }
    
    if(totalFoldersParent < 1 || isNextSiblingReduced){
        // console.log("Cumple los requisitos para usar animacion")
        newFoldersParent.setAttribute("openning", "");
        newFoldersParent.addEventListener("animationend", () =>{newFoldersParent.removeAttribute("openning")}, {once: true})
    }else{
        insertNewFoldersParent();
        return;
    }
    
    if((countTotalFoldersParent())+1 > 3){
        // only use flip if theres gonna be a reduction in one of the columns
        // console.log("Cumple con requisitos para usar flip")
        state = Flip.getState(`.note-parent`);
        insertNewFoldersParent();
        applyAnimation(state, `.note-parent`);
        return;
    }
    

    insertNewFoldersParent();
}
function manageReducedFoldersParent(){  
    // const mainParent = currentFoldersParent.parentElement;
    const mainParent = document.getElementById("main-folders-parents-container");
    const foldersParents = mainParent.querySelectorAll('.folders-parent:not([closing])');
    const foldersParentCount = foldersParents.length;

    if(foldersParentCount > 2){
        for (let i = 0; i < foldersParentCount - 3; i++) {
            foldersParents[i].setAttribute('reduced', '');
        }
        for (let i = foldersParentCount - 3; i < foldersParentCount; i++) {
            foldersParents[i].removeAttribute('reduced');
        }
    }else{
        foldersParents.forEach(folderParent => {
            folderParent.removeAttribute('reduced');
        });
    }
}
function countTotalFoldersParent(currentFoldersParent = false){
    if(currentFoldersParent){
        let count = 0;
        let nextSibling = currentFoldersParent.nextElementSibling;
        while (nextSibling) {
            if (nextSibling.classList && nextSibling.classList.contains("folders-parent") && !nextSibling.hasAttribute("closing")) {
                count++;
            }
            nextSibling = nextSibling.nextElementSibling;
        }
        return count;
    }

    const mainParent = document.getElementById("main-folders-parents-container");
    const foldersParents = mainParent.querySelectorAll('.folders-parent:not([closing])');
    const foldersParentCount = foldersParents.length;

    return foldersParentCount;
}
function reduceAllFoldersParent(){
    const mainParent = document.getElementById("main-folders-parents-container");
    const foldersParents = mainParent.querySelectorAll('.folders-parent:not([closing])');
    const foldersParentCount = foldersParents.length;

    for (let i = 0; i < foldersParentCount - 1; i++) {
        foldersParents[i].setAttribute('reduced', '');
    }
    foldersParents[foldersParentCount - 1].removeAttribute('reduced');
}

function removeSingleFolderParent(originButton){
    const currentFoldersParent = originButton.closest(".folders-parent");

    // Remove infinite amount of .folders-parent that could be ahead of this element
    let nextFoldersParent = currentFoldersParent.nextSibling;
    state = Flip.getState(`.note-parent`);
    while (nextFoldersParent) {
        let nextSibling = nextFoldersParent.nextSibling;
        if (nextFoldersParent.classList && nextFoldersParent.classList.contains("folders-parent")) {
            nextFoldersParent.remove();
        }
        nextFoldersParent = nextSibling;
    }
    applyAnimation(state, `.note-parent`);
    

    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    previousFoldersParent.querySelector(".folder[active]").removeAttribute("active");    
    currentFoldersParent.setAttribute("closing", "");
    currentFoldersParent.addEventListener("animationend", () => {currentFoldersParent.remove(); }, {once: true});
    
    manageReducedFoldersParent();
    setNoteDefaultView();
}

function manageActiveFolderSelector(originButton){
    if(originButton.hasAttribute("active")){return false;}

    const activeButton = originButton.closest(".folders-list").querySelector(".folder[active]");
    if(activeButton){
        activeButton.removeAttribute("active");
    }
    originButton.setAttribute("active", "");

    // const folderMenuButton = document.createElement("div");
    // folderMenuButton.className = "more-options-button";
    // folderMenuButton.innerHTML = `
    //     <md-icon>more_vert</md-icon>
    // `;
    // originButton.appendChild(folderMenuButton);

    return true;
}
function removeActiveFolderSelector(originButton){

    const activeButton = originButton.closest(".note-parent").previousElementSibling.querySelector(".folder[active]")
    if(activeButton){
        activeButton.removeAttribute("active");
    }
    return true;

}

function changeFoldersView(originButton = false){
    if(!originButton){return};
    const viewSelectorParent = originButton.parentElement;
    viewSelectorParent.querySelector("[active]").removeAttribute("active");
    originButton.setAttribute("active", "");

    viewType = originButton.getAttribute("data-folders-view-type");
    const mainFoldersParent = document.getElementById("main-folders-parents-container");
    viewClass = (viewType === "grid") ? "view-grid" : "";
    mainFoldersParent.classList.remove("view-grid");
    if(viewClass){ mainFoldersParent.classList.add(viewClass); }

    localStorage.setItem('sb-notes-selected-folders-view', viewType);
}
function loadFoldersView(){
    newView = localStorage.getItem('sb-notes-selected-folders-view') || "column";

    document.addEventListener("DOMContentLoaded", function(event) {
        const activeButton = document.querySelector(`#folders-view-selector-parent [data-folders-view-type="${newView}"]`);
        changeFoldersView(activeButton);
    }, {once:true });
   
}
loadFoldersView();



// Las siguientes funciones son para la ventana de info de la carpeta
function toggleFolderInfoWindow(originButton){
    if(!originButton){return;}
    const currentFoldersParent = originButton.closest(".folders-parent");
    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    const activeFolderElement = previousFoldersParent.querySelector(".folder[active]")

    document.getElementById("response-info-folder-name").textContent = activeFolderElement.getAttribute("data-folder-name");
    document.getElementById("response-info-created-at").textContent = activeFolderElement.getAttribute("data-folder-created-at");

    toggleWindow('#window-folder-info', 'absolute', 2)
}



// Las siguientes funciones son para la eliminación de carpetas
function toggleDeleteFolderDialog(originButton){
    if(!originButton){return;}
    const currentFoldersParent = originButton.closest(".folders-parent");
    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    const folderId = previousFoldersParent.querySelector(".folder[active]").getAttribute("data-folder-id");

    document.getElementById("button-confirm-delete-folder").onclick = function() { deleteFolder(folderId); }
    toggleDialog("dialog-delete-folder-confirmation");
}
async function deleteFolder(folderId){
    const data = {
        op: "delete_folder",
        folder_id: folderId
    }
    const url = `controllers/folders.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Carpeta eliminada", "success");
                removeUiFolder(folderId);
                toggleDialog();
                return true;
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
function removeUiFolder(folderId = 0){
    if(folderId == 0){return;}
    const folder = document.querySelector(`.folder[data-folder-id="${folderId}"]`);

    // obtenemos un boton de el contenedor de la carpeta abierta (es decir la carpeta a eliminar) para poder mandar el boton a la funcion que quita los elementos
    const folderContentParent = (folder.closest(".folders-parent").nextElementSibling.classList.contains("folders-parent")) ? folder.closest(".folders-parent").nextElementSibling : false;
    removeSingleFolderParent(folderContentParent.querySelector(".folder"));

    if(folder){
        folder.setAttribute("removing", "");
        folder.addEventListener("animationend", () => {folder.remove(); }, {once: true});
    }
    
}

// Las siguientes funciones son para mostrar las carpetas eliminadas
function openDeletedFoldersWindow(){
    toggleWindow("#window-deleted-items");
    toggleWSection('w-section-deleted-folders');
    displayDeletedFolders();
}
async function getDeletedFolders(page = 0){
    const data = {
        op: "get_deleted_folders",
        page: page
    }
    const url = `controllers/folders.controller.php`
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
async function displayDeletedFolders(page = 0){
    const result = await getDeletedFolders(page);
    if(!result.success){return;}

    const container = document.getElementById("response-deleted-folders-container");
    
    container.nextElementSibling.innerHTML = ``;
    if(!result.data || result.data.length === 0){
        container.nextElementSibling.innerHTML = `
            <div class="content-box on-background-text align-center info-table-empty">
                <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                <span class="headline-small">No hay carpetas eliminadas</span>
            </div>
        `;
        return;
    }

    container.innerHTML = `
        ${result.data.map(item => {
            return `
               <div class="deleted-item type-folders">
                    <div class="simple-container grow-1 justify-between" main-deleted-item-container>
                        <div class="simple-container gap-8">    
                            <md-icon-button 
                                toggle 
                                onclick="toggleDeletedFolderContentView(this)"
                                data-item-id="${item.id}"
                                >
                                <md-icon >folder</md-icon>
                                <md-icon class="filled" slot="selected">folder_open</md-icon>
                            </md-icon-button>

                                
                            <span style="padding-top:12px;">${item.folder_name}</span>
                        </div>
                        <div>
                            <md-icon-button 
                                onclick="toggleDeleteFolderForeverDialog(${item.id}, this)" 
                                data-tooltip="Eliminar permanentemente"
                                class="tooltip-left"
                                >
                                <md-icon>delete_forever</md-icon>
                            </md-icon-button>
                            <md-icon-button 
                                data-folder-name="${item.folder_name}"
                                onclick="toggleRestoreFolderDialog(${item.id}, this)" 
                                data-tooltip="Recuperar"
                                class="tooltip-left"
                                >
                                <md-icon>restore</md-icon>
                            </md-icon-button>
                        </div>
                    </div>
                    <div class="deleted-item-content-container">
                        <div class="deleted-item-content">
                            
                        </div>
                    </div>
                </div>
            `
        }).join("")}
    `;

    displayDeletedFoldersPagination(result.total_rows, result.limit, page);
}
function displayDeletedFoldersPagination(totalRows, limit, currentPage = 0){
    const container = document.getElementById("pagination-deleted-folders-container");
    const pageCount = Math.ceil(totalRows / limit);
    if(pageCount <= 1){container.innerHTML = "";return;}

    let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
    for (let i = 0; i < pageCount; i++) {
        if (i === currentPage) {
            paginationHTML += `<md-filled-tonal-icon-button onclick='displayDeletedFolders(${i})'><md-icon class="filled">counter_${i+1}</md-icon></md-filled-tonal-icon-button>`;
        } else {
            paginationHTML += `<md-icon-button onclick='displayDeletedFolders(${i})'>${i + 1}</md-icon-button>`;
        }
    }
    paginationHTML += `</span>`;
    container.innerHTML = paginationHTML;
}

// Las siguientes funciones son para mostrar el contenido de una carpeta eliminada
async function toggleDeletedFolderContentView(originButton){
    const togglerElement = originButton.closest("[main-deleted-item-container]").nextElementSibling;
    togglerElement.toggleAttribute("active");

    if(!togglerElement.hasAttribute("active")){return}

    const folderId = originButton.getAttribute("data-item-id");
    
    const folderContent = await getFolderContent(folderId);
    const folderContentContainer = originButton.closest("[main-deleted-item-container]").nextElementSibling.querySelector(".deleted-item-content");

    
    folderContentContainer.innerHTML = `
        ${folderContent.data.map(item => {
            itemName = item.item_type == "folder" ? cleanHTMLContent(item.item_title) : cleanHTMLContent(item.item_content);
            if(itemName == ""){itemNameFormated = `<i class="outline-text">Nota sin nombre</i>`;}else{itemNameFormated = itemName;}
            icon = item.item_type === "folder" ? "folder" : "notes";
            iconOpen = item.item_type === "folder" ? "folder_open" : "notes";
            // iconClass = item.item_type === "folder" ? "primary-text" : "";
            noteContent = item.item_type === "folder" ? "" : escapeHTML(item.item_content);
            functionToCall = item.item_type === "folder" ? "toggleDeletedFolderContentView" : "displayDeletedFolderNoteContent"; 

            return `
               <div class="simple-container grow-1 justify-between" main-deleted-item-container>
                    <div class="simple-container gap-8">    
                        <md-icon-button 
                            toggle 
                            onclick="${functionToCall}(this)"
                            data-item-id="${item.item_id}"
                            data-content="${noteContent}"
                            >
                            <md-icon>${icon}</md-icon>
                            <md-icon class="filled" slot="selected">${iconOpen}</md-icon>
                        </md-icon-button>

                        <span style="padding-top:12px;">${itemNameFormated}</span>
                    </div>
                </div>
                <div class="deleted-item-content-container">
                    <div class="deleted-item-content"></div>
                </div>
            `;
        }).join("")}
    `;
}
function displayDeletedFolderNoteContent(originButton){
    const togglerElement = originButton.closest("[main-deleted-item-container]").nextElementSibling;
    togglerElement.toggleAttribute("active");
    const noteContentContainer = originButton.closest("[main-deleted-item-container]").nextElementSibling.querySelector(".deleted-item-content");
    noteContentContainer.innerHTML = originButton.getAttribute("data-content");
}
function escapeHTML(html) {
    return html.replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;");
}
function unescapeHTML(html) {
    const doc = new DOMParser().parseFromString(html, "text/html");
    return doc.documentElement.textContent;
}

// Las siguientes funciones son para recuperar una carpeta eliminada
function toggleRestoreFolderDialog(folderId, originButton){
    document.getElementById("button-confirm-restore-folder").onclick = function() { restoreDeletedFolder(folderId, originButton); }
    toggleDialog("dialog-restore-folder-confirmation")
}
async function restoreDeletedFolder(folderId, originButton){
    const data = {
        op: "restore_deleted_folder",
        folder_id: folderId,
        id: folderId,
        folder_name: originButton.getAttribute("data-folder-name")
    }
    const url = `controllers/folders.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Carpeta restaurada", "success");
                removeDeletedFolderFromUi(originButton);
                createUiFolder(data, result.folder_id);
                toggleDialog();
                toggleWindow();
                return true;
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
function removeDeletedFolderFromUi(originButton){
    state = Flip.getState(`.deleted-item`);
    originButton.closest(".deleted-item").remove();
    applyAnimation(state, `.deleted-item`);
    return true;
}

// Las siguientes funciones son para eliminar permanentemente una carpeta
function toggleDeleteFolderForeverDialog(folderId, originButton){
    document.getElementById("button-confirm-delete-folder-forever").onclick = function() { deleteFolderForever(folderId, originButton); }
    toggleDialog("dialog-delete-folder-forever-confirmation")
}

async function deleteFolderForever(folderId, originButton) {
    const url = `controllers/folders.controller.php`;
    const data = {
        op: "delete_folder_forever",
        folder_id: folderId
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });

        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Folder and its contents deleted", "success");
                removeDeletedFolderFromUi(originButton);
                toggleDialog();
            } else {
                message(`Error: ${result.message}`, "error");
            }
        } else {
            message("Error in request", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

function syncFolders(){
    displayFolderList();
}

async function createFolder(event, originFolderId = 0){
    event.preventDefault();
    const parentId = "#window-create-folder";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);
    console.log(originFolderId);

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
function createFolderFromFolder(originButton){
    // this function is for creating a folder but inside another folder, this means that the button that triggers this function is inside a folder
    if(!originButton){return;}
    const currentFoldersParent = originButton.closest(".folders-parent");
    const previousFoldersParent = currentFoldersParent.previousElementSibling;
    const originFolderId = previousFoldersParent.querySelector(".folder[active]").getAttribute("data-folder-id");

    toggleWindow("#window-create-folder");
    document.getElementById("create-folder-form").onsubmit = function(event){ createFolder(event, originFolderId); }
}
function createUiFolder(data, originFolderId){
    const activeFolder = document.querySelector(`#main-folders-parents-container .folder[data-folder-id="${originFolderId}"]`);
    var newFolderParent = activeFolder.closest(".folders-parent").nextElementSibling;
    if(!newFolderParent || !newFolderParent.classList.contains("folders-parent")){return false;}

    const newFolder = document.createElement("div");
    newFolder.className = "folder";
    newFolder.setAttribute("data-folder-id", data.id);
    newFolder.innerHTML = `
        <md-ripple></md-ripple>
        <md-icon>folder</md-icon>
        <span>${data.folder_name}</span>
    `;
    newFolder.onclick  = function() {displayFolderContent(data.id, this)};
    newFolder.setAttribute("openning", "");
    newFolder.addEventListener("animationend", () =>{newFolder.removeAttribute("openning")}, {once: true})


    if(newFolderParent.querySelectorAll(".folders-list").length < 2){
        console.log("Carpeta previamente vacía");
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
        newFolderParent.querySelector(".folders-list").appendChild(newFolder);
        newFolderParent.querySelector(".folders-list").scrollTop = newFolderParent.querySelector(".folders-list").scrollHeight;
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


async function displayFolderList(page = 0){
    const result = await getFolders(page);
    if(!result.success){return;}

    const container = document.getElementById("main-folders-container").querySelector(".folders-list");
    container.innerHTML = `
        ${result.data.map(folder => `
            <div
                onclick="displayFolderContent(${folder.id}, this)" 
                data-folder-id="${folder.id}"
                class="folder"
                >
                <md-ripple></md-ripple>
                <md-icon>folder</md-icon>
                <span>${folder.folder_name}</span>
            </div>
        `).join("")}
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
    if(!manageActiveFolderSelector(originButton)){
        return;
    }

    const result = await getFolderContent(folderId);
    if(!result.success){return;}

    manageFoldersParent((result.data.length), originButton);
    displayFolderContentList(result.data, originButton);
}

function displayFolderContentList(data, originButton){
    if(data.length <= 0){return;}
    const newFoldersParent = (originButton.closest(".folders-parent")).nextElementSibling;   
    const newFoldersList = newFoldersParent.querySelector(".folders-list");
    newFoldersList.innerHTML = `
        ${data.map(folder => {
            const itemTitle = folder.item_type === "folder" ? folder.item_title : folder.item_content;
            const sanitizedTitle = itemTitle;
            functionToCall = folder.item_type === "folder" ? "displayFolderContent" : "displayNoteContent";

            return `
                <div
                    onclick="${functionToCall}(${folder.item_id}, this)" 
                    data-folder-id="${folder.item_id}"
                    class="folder"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>${folder.item_type === "folder" ? "folder" : "article"}</md-icon>
                    <span>${sanitizedTitle}</span>
                </div>
            `;
        }).join("")}
    `;
}

function manageFoldersParent(dataLength = 0, originButton){ // this column will manage the amount of "columns" to display folders exists
    const currentFoldersParent = originButton.closest(".folders-parent");

    // this removes the current column if there are no folders to display
    // if (dataLength <= 0) {
    //     totalFoldersParent = countTotalFoldersParent(currentFoldersParent);
    //     removeFoldersParent(currentFoldersParent);
    //     createFoldersParent(currentFoldersParent, totalFoldersParent);
    // }

        var totalFoldersParent = countTotalFoldersParent(currentFoldersParent);
        var isNextSiblingReduced =  (currentFoldersParent.nextElementSibling.hasAttribute("reduced")) ? true : false;
        removeFoldersParent(currentFoldersParent);
        createFoldersParent(currentFoldersParent, totalFoldersParent ,isNextSiblingReduced);
    // }

    manageReducedFoldersParent(currentFoldersParent);
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
                // En la primera iteración eliminamos directamente
                folderToRemove.remove();
                count++;
                isFirstIteration = false; // A partir de ahora ya no es la primera iteración
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

    console.log(`Deleted ${count} folders-parent elements.`);
    return count;
}


function createFoldersParent(currentFoldersParent, totalFoldersParent = 1, isNextSiblingReduced = false){
    if(!currentFoldersParent){return;}
    const newFoldersParent = document.getElementById("template-folders-parent").content.cloneNode(true).querySelector(".folders-parent");
    insertNewFoldersParent = () => { currentFoldersParent.parentNode.insertBefore(newFoldersParent, currentFoldersParent.nextSibling); }
    
    if(totalFoldersParent < 1 || isNextSiblingReduced){
        console.log("Cumple los requisitos para usar animacion")
        newFoldersParent.setAttribute("openning", "");
        newFoldersParent.addEventListener("animationend", () =>{newFoldersParent.removeAttribute("openning")}, {once: true})
    }else{
        insertNewFoldersParent();
        return;
    }
    
    if((countTotalFoldersParent())+1 > 3){
        // only use flip if theres gonna be a reduction in one of the columns
        console.log("Cumple con requisitos para usar flip")
        state = Flip.getState(`.note-parent`);
        insertNewFoldersParent();
        applyAnimation(state, `.note-parent`);
        return;
    }
    

    insertNewFoldersParent();
}
function manageReducedFoldersParent(currentFoldersParent){  
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
    
    manageReducedFoldersParent(currentFoldersParent);
    
}

function manageActiveFolderSelector(originButton){
    if(originButton.hasAttribute("active")){return false;}

    const activeButton = originButton.closest(".folders-list").querySelector(".folder[active]");
    if(activeButton){
        activeButton.removeAttribute("active");
    }
    originButton.setAttribute("active", "");
    return true;
}

function displayNoteContent(){
    message("Esto debería abir una nota")
}
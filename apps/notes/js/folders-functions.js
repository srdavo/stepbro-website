function syncFolders(){
    displayFolderList();
}

async function createFolder(event, form){
    event.preventDefault();
    const parentId = "#window-create-folder";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "create_folder",
        folder_name: document.getElementById("create-folder-name").value
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
    // console.log(result);

    manageFoldersParent((result.data.length), originButton);
    displayFolderContentList(result.data, originButton);
}

function displayFolderContentList(data, originButton){
    if(data.length <= 0){return;}
    const newFoldersParent = (originButton.closest(".folders-parent")).nextSibling;    
    const newFoldersList = newFoldersParent.querySelector(".folders-list");
    newFoldersList.innerHTML = `
        ${data.map(folder => {
            const itemTitle = folder.item_type === "folder" ? folder.item_title : folder.item_content;
            const sanitizedTitle = itemTitle;
            functionToCall = folder.item_type === "folder" ? "displayFolderContent" : "displayNoteContent";

            return `
                <div
                    onclick="${functionToCall}(${folder.item_id}, this)" 
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
    if (dataLength <= 0) {
        removeFoldersParent(currentFoldersParent);
        createFoldersParent(currentFoldersParent, true);
    }

    if(dataLength > 0){
        removeFoldersParent(currentFoldersParent)
        createFoldersParent(currentFoldersParent)
    }

    manageReducedFoldersParent(currentFoldersParent);
}
function removeFoldersParent(currentFoldersParent){
    let currentFoldersParentNextSibling = currentFoldersParent.nextSibling;
    while (currentFoldersParentNextSibling) {
        let nextSibling = currentFoldersParentNextSibling.nextSibling;
        if (currentFoldersParentNextSibling.classList && 
            currentFoldersParentNextSibling.classList.contains("folders-parent")) {
            currentFoldersParentNextSibling.remove();
        }
        currentFoldersParentNextSibling = nextSibling;
    }
}
function createFoldersParent(currentFoldersParent, isEmpty = false){
    const newFolderParent = document.createElement('div');
    newFolderParent.className = 'content-box light-color 0 folders-parent';
    
    newFolderParent.setAttribute('openning', '');
    newFolderParent.addEventListener("animationend", () =>{newFolderParent.removeAttribute("openning")}, {once: true})
    
    newFolderParent.innerHTML = `
        <div class="folders-list"></div>
        <div class="folders-list">
            <div class="folder" onclick="removeSingleFolderParent(this)">
                <md-ripple aria-hidden="true"></md-ripple>
                <md-icon aria-hidden="true">close</md-icon>
                <span>Cerrar carpeta</span>
            </div>
            <div class="folder">
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
    if(isEmpty){
        newFolderParent.innerHTML = `
        <div class="folders-list grow-1">
            <div class="simple-container grow-1 direction-column align-center justify-center user-select-none">
                <md-icon class="pretty medium">folder</md-icon>
                <span class="body-large text-center">Esta carpeta está vacía</span>
            </div>
        </div>
        `;
    }
    currentFoldersParent.parentNode.insertBefore(newFolderParent, currentFoldersParent.nextSibling);
}
function manageReducedFoldersParent(currentFoldersParent){
    // const mainParent = currentFoldersParent.parentElement;
    const mainParent = document.getElementById("main-folders-parents-container");
    const foldersParents = mainParent.querySelectorAll('.folders-parent');
    const foldersParentCount = foldersParents.length;

    console.log(foldersParentCount);

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
    currentFoldersParent.addEventListener("animationend", () => {currentFoldersParent.remove();}, {once: true});
    
    manageReducedFoldersParent(currentFoldersParent)
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
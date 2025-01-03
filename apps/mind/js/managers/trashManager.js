import trashService from "../services/trashService.js";
import ApptsManager from "./apptsManager.js";

const TrashManager = (() => {

    let trashItems = [];
    async function loadTrashItems(){
        trashItems.appts = await trashService.getTrash({item_type: "appt"});
        // trashItems.patients = await trashService.getTrash({item_type: "patient"});
    }

    const moveToTrashDialog = document.getElementById("dialog-move-to-trash-confirmation");
    const moveToTrashDialogForm = moveToTrashDialog.querySelector("#form-dialog-move-to-trash-confirmation");

    const recoverFromTrashDialog = document.getElementById("dialog-recover-from-trash-confirmation");
    const recoverFromTrashDialogForm = recoverFromTrashDialog.querySelector("#form-dialog-recover-from-trash-confirmation");

    // tables
    // appts
    const deletedApptsTable = document.getElementById("trash-table-deleted-appts");
    const loadMoreApptsButton = document.getElementById("trash-load-more-appts");
    
    // patients
    const loadMorePatientsButton = document.getElementById("trash-load-more-patients");

    function openConfirmationDialog(itemType = null){
        if(!itemType) { return false; }
        var itemName;
        var data = {};

        if(itemType === "appt"){
            itemName = "cita";
            data.item_type = "appt";
            data.item_id = ApptsManager.currentOpenApptId();
        }
        if(itemType === "patient"){
            itemName = "paciente";
            data.item_type = "patient";
            data.item_id = PatientsManager.currentOpenPatientId();
        }

        const itemNameContainer = moveToTrashDialogForm.querySelector("[name='item-name']");
        itemNameContainer.textContent = itemName;

        toggleDialog("dialog-move-to-trash-confirmation");
        moveToTrashDialog.querySelector("[name='button-confirm-move-to-trash']").onclick = function() { moveToTrash(data, itemType); }
    }

    function openRecoverDialog(itemType = null){
        if(!itemType) { return false; }
        var itemName;
        var data = {};

        if(itemType === "appt"){
            itemName = "cita";
            data.item_type = "appt";
            data.item_id = ApptsManager.currentOpenApptId();
        }
        if(itemType === "patient"){
            itemName = "paciente";
            data.item_type = "patient";
            data.item_id = PatientsManager.currentOpenPatientId();
        }

        const itemNameContainer = recoverFromTrashDialogForm.querySelector("[name='item-name']");
        itemNameContainer.textContent = itemName;

        toggleDialog("dialog-recover-from-trash-confirmation");
        recoverFromTrashDialog.querySelector("[name='button-confirm-recover-from-trash']").onclick = function() { recoverFromTrash(data, itemType); }
    }

    async function moveToTrash(data = {}, itemType = null){
        const result = trashService.moveToTrash(data);
        if(!result) return false;
        message("Se movió a la papelera con éxito");
        toggleDialog();
        toggleWindow();

        if(itemType === "appt"){
            const appts = ApptsManager.apptsForTable();
            console.log(appts)
            const itemIndex = appts.data.findIndex(appt => appt.id == data.item_id);        
            TrashManager.trashItems().appts.data.push(appts.data[itemIndex]);

            appts.data.splice(itemIndex, 1);
            appts.pagination.total_rows -= 1;
            ApptsManager.displayApptsTable(undefined, true);
        }
    }
    async function recoverFromTrash(data={}, itemType = null){
        if(!data.item_id || !itemType) return false;

        const result = trashService.recoverFromTrash(data);
        if(!result) return false;
        message("Se recuperó con éxito");
        toggleDialog();
        toggleDialog();

        if(itemType === "appt"){
            const appts = TrashManager.trashItems().appts;
            const itemIndex = appts.data.findIndex(appt => appt.id == data.item_id);
            ApptsManager.apptsForTable().data.push(appts.data[itemIndex]);

            appts.data.splice(itemIndex, 1);
            appts.pagination.total_rows -= 1;

            ApptsManager.apptsForTable().pagination.total_rows += 1;
            ApptsManager.displayApptsTable(undefined, true);
            displayTrashTable(itemType);
        }
    }

    function displayTrashTable(itemType = null){
        if(!itemType) { return false; }

        if(itemType === "appt"){
            deletedApptsTable.innerHTML = "";
            var table = ApptsManager.buildApptsTable(trashItems.appts.data, "trash");
        }

        const fragment = document.createDocumentFragment();
        table.forEach(row => {fragment.appendChild(row);});

        if(itemType === "appt"){
            handleLoadMoreButton(itemType);
            deletedApptsTable.appendChild(fragment);
        }
    }

    function handleLoadMoreButton(itemType = null){
        if(!itemType) return false;

        if(itemType === "appt"){
            var loadMoreButton = loadMoreApptsButton;
            var paginationData = trashItems.appts.pagination;
        }
        if(itemType === "patient"){
            var loadMoreButton = loadMorePatientsButton;
        }

        // Reset button state first
        loadMoreButton.disabled = false;

        // If total rows is less than or equal to limit, no need for load more
        if(paginationData.total_rows <= paginationData.limit) {
            loadMoreButton.disabled = true;
            console.log("total rows less than or equal to limit");
            return;
        }

        // If we've reached or exceeded the total rows, disable the button
        if(paginationData.offset + paginationData.limit >= paginationData.total_rows) {
            loadMoreButton.disabled = true;
            console.log("reached or exceeded total rows");
            return;
        }

        // Set up click handler for the load more button
        loadMoreButton.onclick = () => displayNextPage(itemType);
    }

    async function displayNextPage(itemType = null){
        if(!itemType) return false;

        if(itemType === "appt"){
            var currentPage = Math.ceil(trashItems.appts.pagination.offset / trashItems.appts.pagination.limit);
            var nextPage = currentPage + 1;
            const nextPageResponse = await trashService.getTrash({page: nextPage, item_type: itemType});
            trashItems.appts.data = [...trashItems.appts.data, ...nextPageResponse.data];
            trashItems.appts.pagination = nextPageResponse.pagination;
            displayTrashTable(itemType);
        }
        
        
    }

    return {
        openConfirmationDialog,
        openRecoverDialog,
        loadTrashItems,
        displayTrashTable,
        trashItems: () => trashItems,
    }

})();
export default TrashManager;
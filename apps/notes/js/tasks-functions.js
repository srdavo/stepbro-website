
// Globals
const sectionTasks = document.getElementById("section-to_do_list");
const pendingDiv = document.getElementById("pending");
const inProgressDiv = document.getElementById("in-progress");
const completedDiv = document.getElementById("completed");
// setTimeout(() => {
    
// },500);

function syncTasks(){
    getTasks();
}

function toggleCreateTaskWindow(){
    toggleWindow("#window-create-task", "", 1);
    // document.getElementById("create-folder-form").onsubmit = function(event){ createFolder(event); }
}


async function saveTask(e,content = null){
    e.preventDefault();
    
    const parentId = "#window-create-task";
    if(!content){
        if(!checkEmpty("#create-task-check-empty", "input")){return;}
        content = {
            task: "", 
            description: null,
            limit_date: null,
            status: null,
            id: null,
            created_at: null
        };
    }

    
    
    const data = {
        op: "save_task",
        task: (document.getElementById("create-task-name").value === "") ? content.task : document.getElementById("create-task-name").value,
        description: (document.getElementById("create-task-description").value == "") ? content.description : document.getElementById("create-task-description").value,
        limit_date: (document.getElementById("create-task-limit-date").value == "") ? content.limit_date : document.getElementById("create-task-limit-date").value,
        status: content.status ?? "Pendiente",
        id: content.id ?? null,
        created_at: content.created_at ?? null

    }

    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        toggleButton(parentId, false);
        if (result.success) {
            if (result.id) {
                let task = {
                    task: data.task,
                    description: data.description ?? "",
                    limit_date: data.limit_date,
                    status: data.status,
                    id: result.id,
                    created_at: result.created_at
                }
                pendingDiv.appendChild(createDivTask(task))
                message("Tarea Creada", "success");
                
                toggleWindow();
            }else{
                message("Tarea actualizada", "success");
                return true;
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }


}


async function getTasks(){
    
    const data = {
        op: "get_tasks"
    }

    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            displayTasks(result);
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }


}

function displayTasks(tasks){
    
    tasks.forEach(task => {
        
        switch(task.status){
            case "Pendiente":
                pendingDiv.appendChild(createDivTask(task))
                break;
            case "Activo":
                inProgressDiv.appendChild(createDivTask(task))
                break;
            case "Terminado":
                completedDiv.appendChild(createDivTask(task))
                break;
        }
    });
}

function createDivTask(task){
    const taskItem = document.getElementById("template-task-item").content.cloneNode(true);
    const divTask = taskItem.querySelector("[data-task-parent]");

    // Set attributes
    divTask.setAttribute("id", task.id);
    divTask.setAttribute("data-task_name", task.task);
    divTask.setAttribute("data-created_at", task.created_at);
    divTask.setAttribute("data-description", task.description);
    divTask.setAttribute("data-limit_date", task.limit_date);
    divTask.setAttribute("data-status", task.status);
    divTask.setAttribute("draggable", "true");
    divTask.setAttribute("ondragstart", "drag(event)");
    
    const taskCheckbox = divTask.querySelector("[data-task-checkbox]");
    if(task.status === "Terminado"){taskCheckbox.checked = true;}

    taskCheckbox.onclick = function(){ checkTask(this, task.id); }
    divTask.querySelector(["[data-taks-name-parent]"]).onclick = function(){openEditTaskWindow(task, this.closest('[data-task-parent]'), divTask );};

    // set content
    divTask.querySelector("[data-task-name]").textContent = task.task;

    divTask.setAttribute("openning", "");
    divTask.addEventListener("animationend", function(){divTask.removeAttribute("openning");}, {once: true});
    
    return divTask;
}

function openEditTaskWindow(task, originButton, divTask= null){
    toggleWindow("#window-edit-task", "absolute", 1);
    const taskParent = originButton.closest("[data-task-parent]");
    document.getElementById("delete-task").setAttribute("data-task_id", task.id);
    document.getElementById("delete-task").onclick = function(){
        toggleDeleteTaskDialog(task.id, divTask)        
    }
    document.getElementById("edit-task-name").value = taskParent.dataset.task_name  ;
    document.getElementById("edit-task-description").value = taskParent.dataset.description ?? "";
    document.getElementById("edit-task-status").value = taskParent.dataset.status;
    document.getElementById("edit-task-limit-date").value = taskParent.dataset.limit_date ?? "";
    document.getElementById("button-edit-task").setAttribute("data-task_id", task.id);
    document.getElementById("button-edit-task").setAttribute("data-created_at", task.created_at);
    // document.getElementById("task-data-name").textContent = task.task;
    // document.getElementById("task-data-status").textContent = task.status;
    // document.getElementById("task-data-created_at").textContent = task.created_at;
    // document.getElementById("task-data-id").value = task.id;
}
function toggleDeleteTaskDialog(taskId, divTask){
    document.getElementById("button-confirm-delete-task").onclick = function(){
        if(updateStatus(taskId, 0)){
            toggleDialog(); 
            toggleWindow();
        }; 
        if(divTask) {
            divTask.setAttribute("closing", "");
            divTask.addEventListener("animationend", function(){divTask.remove();}, {once: true});    
        }
    }
    toggleDialog("dialog-delete-task-confirmation");
}

function checkTask(originButton, taskId){
    if(originButton.checked){
        uncompleteTask(taskId);
    }else{
        completeTask(taskId);
    }
}
async function completeTask(taskId){
    const update = await updateStatus(taskId, "Terminado");
    if(update){moveUiTasks(taskId, "Terminado");}
}
async function uncompleteTask(taskId){
    const update = await updateStatus(taskId, "Pendiente");
    if(update){moveUiTasks(taskId, "Pendiente");}
}

function moveUiTasks(taskId, status){
    const task = document.getElementById(taskId);
    task.dataset.status = status;
    task.querySelector("[data-task-checkbox]").checked = true;

    state = Flip.getState(`[data-task-parent], .task-column-parent`);

    switch (status) {
        case "Pendiente":
            task.querySelector("[data-task-checkbox]").checked = false;
            pendingDiv.appendChild(task);
            break;
        case "Activo":
            task.querySelector("[data-task-checkbox]").checked = false;
            inProgressDiv.appendChild(task);
            break;
        case "Terminado":
            task.querySelector("[data-task-checkbox]").checked = true;
            completedDiv.appendChild(task);
            break
        
        default:
            break;
    }
    applyAnimation(state, `[data-task-parent]`, true, false, true, true);
    // applyAnimation(state, `.task-column-parent`, false);
}

function updateUiTask(content){
    const task = document.getElementById(content.id);
    task.querySelector("[data-task-name]").textContent = content.task;
    task.dataset.task_name = content.task;
    task.dataset.description = content.description;
    task.dataset.limit_date = content.limit_date;
    task.dataset.status = content.status;
    task.dataset.created_at = content.created_at;
    task.querySelector("[data-task-checkbox]").checked = (content.status === "Terminado") ? true : false;
    task.querySelector("[data-task-name]").textContent = content.task;
    // task.querySelector("[data-taks-name-parent]").textContent = content.task;
    // task.querySelector("[data-task-status]").textContent = content.status;
    // task.querySelector("[data-task-limit-date]").textContent = content.limit_date;
    // task.querySelector("[data-task-description]").textContent = content.descriptions;
}

async function updateStatus(taskId = 0, status = "0",){
    // if(taskId === 0 || status === 0){return false;}
    const taskElement = document.getElementById(taskId);
    if(taskElement){
        var currentStatus = taskElement.dataset.status;
    }else{
        var currentStatus = 0;
    }
    const data = {
        op: "update_status",
        id: taskId,
        status: status,
        last_status: (status == 0 || status == "0") ? currentStatus : 0 
    }
    

    
    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();

        if (result) {
            if(result.success){
                return true;
            }else{
                message(`Error: ${result.message}`, "error");
                return false;
            }
            
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

function unCheckLimitDateTaskCheckbox(){
    const checkbox = document.getElementById("create-taks-set-date-limit-checkbox");    
    if(checkbox.checked){ checkbox.click(); }
}
function toggleLimitDateTask(){
    const activeWindow = document.querySelector("window.active");
    const inputContainer = activeWindow.querySelector(".task-limit-date-container");
    inputContainer.toggleAttribute('active');
    // if(inputContainer.hasAttribute('active')){
    //     inputContainer.setAttribute("closing", "");
    //     inputContainer.addEventListener("animationend", function(){
    //         inputContainer.removeAttribute("closing");
    //         inputContainer.removeAttribute('active');
    //     }, {once: true});
    // }else{
    //     inputContainer.setAttribute('active', '');
    // }
}

async function editTask(ev){
    ev.preventDefault();
    content = {
        task: document.getElementById("edit-task-name").value,
        description: document.getElementById("edit-task-description").value,
        limit_date: document.getElementById("edit-task-limit-date").value,
        status: document.getElementById("edit-task-status").value,
        id: document.getElementById("button-edit-task").dataset.task_id,
        created_at: document.getElementById("button-edit-task").dataset.created_at
    }
    result = await saveTask(ev, content);

    if(result){
        updateUiTask(content);
        moveUiTasks(content.id, content.status);
        toggleWindow();
    }
}

async function filterCompleted() {
    completedDiv.innerHTML = "";
    const dateInput = document.getElementById('dateInput').value;
    if(dateInput === ""){return;}
    const [year, month] = dateInput.split('-');
    // console.log(year, month);
    
    const data = {
        op: "get_completed_tasks",
        year,
        month
    }

    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        // console.log(result);
        if (result) {
            displayTasks(result);
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

function setDefaultMonth() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); 


    document.getElementById('dateInput').value = `${year}-${month}`;

    filterCompleted();
}

// Las siguientes funciones son para el apartado de papelera de task
async function getDeletedTasks(page = 0){
    const data = {
        op: "get_deleted_tasks",
        page: page
    }
    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            return result;
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

async function displayDeletedTasks(page = 0){
    const result = await getDeletedTasks(page);
    if(!result){return;}

    const container = document.getElementById("response-deleted-tasks-container");
    container.nextElementSibling.innerHTML = ``;
    if(!result || result.length === 0){
        container.nextElementSibling.innerHTML = `
            <div class="content-box light-color on-background-text align-center justify-center">
                <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                <span class="headline-small text-center">No hay <span class="primary-text">tareas</span> eliminadas</span>
            </div>
        `;
        return;
    }

    container.innerHTML = `
        ${result.map(task => {
            var limitDate = "";
            if(task.limit_date == "0000-00-00"){
                limitDate = "<span class='outline-text'><i>Sin fecha límite</i></span>";
            }else{
                limitDate = `<span class='outline-text'>Fecha límite: ${dateToPrettyDate(task.limit_date, true)}</span>`;
            }
            var description = "";
            if(task.description != ""){
                description = `<span><span class="outline-text user-select-none">Descripción: </span>${task.description}</span>`;
            }else{
                description = "<span class='outline-text user-select-none'><i>Sin descripción</i></span>";
            }

            return `
                <div class="deleted-item">
                    <div class="simple-container grow-1 justify-between" main-deleted-item-container>
                        <div class="simple-container gap-8">    
                            <md-icon-button toggle onclick="toggleDeletedNoteContentView(this)">
                                <md-icon >task</md-icon>
                                <md-icon class="filled" slot="selected">arrow_drop_up</md-icon>
                            </md-icon-button>

                                
                            <span style="padding-top:12px;">${task.task}</span>
                        </div>
                        <div>
                            
                            <md-icon-button 
                                onclick="toggleRestoreTaskDialog(${task.id}, this)" 
                                data-tooltip="Recuperar"
                                title="Recuperar"
                                class="tooltip-left"
                                >
                                <md-icon>restore</md-icon>
                            </md-icon-button>
                        </div>
                    </div>
                    <div class="deleted-item-content-container">
                        <div class="deleted-item-content gap-8">
                            ${description}
                            
                            ${limitDate}
                        </div>
                    </div>
                </div>

                
            `;
        }).join("")}
    `;
}

function toggleRestoreTaskDialog(taskId, originButton){
    document.getElementById("button-confirm-restore-task").onclick = function(){
        restoreTask(taskId, originButton);
    }
    toggleDialog("dialog-restore-task-confirmation");
}
async function restoreTask(taskId, originButton){
    const taskData = await getTaskData(taskId);
    const lastStatus = taskData.last_status;
    taskData.status = lastStatus;
    if(updateStatus(taskId, lastStatus)){
        originButton.closest(".deleted-item").remove();
        message("Tarea restaurada", "success");
        toggleDialog();
        toggleWindow();


        switch(taskData.last_status){
            case "Pendiente":
                pendingDiv.appendChild(createDivTask(taskData))
                break;
            case "Activo":
                inProgressDiv.appendChild(createDivTask(taskData))
                break;
            case "Terminado":
                completedDiv.appendChild(createDivTask(taskData))
                break;
        }
    };

}

async function getTaskData(taskId){
    const data = {
        op: "get_task_data",
        id: taskId
    }
    const url = `controllers/tasks.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        if (result) {
            if(result.success){
                return result.data[0];
            }else{
                message(`Error: ${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

function toggleDeleteTaskForeverDialog(taskId, originButton){
    document.getElementById("button-confirm-delete-task-forever").onclick = function(){
        deleteTaskForever(taskId, originButton);
    }
    toggleDialog("dialog-delete-task-forever-confirmation");
}

function openDeletedTasksWindow(){
    toggleWSection('w-section-deleted-tasks');
    displayDeletedTasks();
}

// Globals
const sectionTasks = document.getElementById("section-to_do_list");
const pendingDiv = document.getElementById("pending");
const inProgressDiv = document.getElementById("in-progress");
const completedDiv = document.getElementById("completed");
setTimeout(() => {
    getTasks();
},500);


function toggleCreateTaskWindow(){
    toggleWindow("#window-create-task");
    // document.getElementById("create-folder-form").onsubmit = function(event){ createFolder(event); }
}


async function saveTask(e,content = null){
    e.preventDefault();
    
    const parentId = "#window-create-task";
    if(!content){
        if(!checkEmpty(parentId, "input")){return;}
        content = {
            task: "", 
            status: null,
            id: null,
            created_at: null
        };
    }
    
    
    const data = {
        op: "save_task",
        task: (document.getElementById("create-task-name").value === "") ? content.task : document.getElementById("create-task-name").value,
        status: content.status ?? null,
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
        console.log(result);
        toggleButton(parentId, false);
        if (result.success) {
            if (result.id) {
                let task = {
                    task: data.task,
                    id: result.id,
                    created_at: result.created_at
                }
                pendingDiv.appendChild(createDivTask(task))
                message("Tarea Creada", "success");
                
                toggleWindow();
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
        console.log(result);
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
    const divTask = document.createElement("DIV");
    divTask.setAttribute("id", task.id);
    divTask.setAttribute("data-created_at", task.created_at);
    divTask.classList.add("task");
    divTask.setAttribute("draggable", "true");
    divTask.setAttribute("ondragstart", "drag(event)");

    const taskP = document.createElement("P");
    taskP.textContent = task.task;
    divTask.appendChild(taskP);

    divTask.innerHTML += `<md-icon aria-hidden="true">more_vert</md-icon>`;
    
    return divTask;
}


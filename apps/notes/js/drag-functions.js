function allowDrop(ev) { ev.preventDefault(); }

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  state = Flip.getState(`.task-column-parent`);
  let data = ev.dataTransfer.getData("text");
  let draggedElement = document.getElementById(data);
  let column = ev.target.closest(".column")
  column.appendChild(draggedElement); 
  applyAnimation(state, `.task-column-parent`, false);


  ;
  content = {
    id: draggedElement.id,
    task: draggedElement.querySelector("[data-task-name]").textContent,
    created_at: draggedElement.dataset.created_at
  }
  
  
  switch(column.id){
    case "pending":
      draggedElement.setAttribute("data-status", "Pendiente");
      draggedElement.querySelector("[data-task-checkbox]").checked = false;
      content.status = "Pendiente";
      break;
    case "in-progress":
      draggedElement.setAttribute("data-status", "Activo");
      draggedElement.querySelector("[data-task-checkbox]").checked = false;
      content.status = "Activo";
      break;
    case "completed":
      draggedElement.setAttribute("data-status", "Terminado");
      draggedElement.querySelector("[data-task-checkbox]").checked = true;
      content.status = "Terminado";
      break;
  }
  
  saveTask(ev,content);
}


  
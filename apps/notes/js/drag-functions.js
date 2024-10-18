function allowDrop(ev) {
    ev.preventDefault(); 
  }

  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }

  function drop(ev) {
    ev.preventDefault();
    let data = ev.dataTransfer.getData("text");
    let draggedElement = document.getElementById(data);
    let column = ev.target.closest(".column")
    column.appendChild(draggedElement); 
    console.log(draggedElement.dataset.created_at)
    content = {
      id: draggedElement.id,
      task: draggedElement.textContent,
      created_at: draggedElement.dataset.created_at
    }
    switch(column.id){
      case "pending":
          content.status = "Pendiente";
          break;
      case "in-progress":
          content.status = "Activo";
          break;
      case "completed":
          content.status = "Terminado";
          break;
  }
  createTask(ev,content);
  }


  
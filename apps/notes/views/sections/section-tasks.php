<section id="section-to_do_list" class="align-center">

<style>
    .container-list {
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .box {
      width: 200px;
      height: 200px;
      border: 2px solid #000;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px;
    }

    .draggable {
      width: 100px;
      height: 100px;
      background-color: #f1c40f;
      cursor: grab;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
    }
  </style>





  <h2>Arrastra el elemento a la caja</h2>
  <md-outlined-button onclick="toggleCreateTaskWindow()" data-flip-id="animate">
                <md-icon slot="icon">add</md-icon>
                <span>Crear task</span>
            </md-outlined-button>

            <h2>To-Do List: Mueve las tareas entre Pendiente, Activa y Terminada</h2>

<div class="container-list">

    <div id="pending" class="column" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div class="column-title">Pendiente</div>


    </div>


    <div id="in-progress" class="column" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div class="column-title">Activa</div>
    </div>


    <div id="completed" class="column" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div class="column-title">Terminada</div>
    </div>
</div>

  
</section>
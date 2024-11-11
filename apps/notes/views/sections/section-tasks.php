<section id="section-to_do_list">
  <div class="simple-container justify-between align-start gap-16">
    <div class="simple-container direction-column">
      <span class="headline-medium bricolage weight-600 on-background-text">Tareas</span>
      <span class="body-large outline-text">Arrastra las tareas a su columna deseada</span>
    </div>
    <div class="simple-container flex-wrap gap-8">
      <div class="simple-container align-center gap-8 flex-wrap ">
        <span class="label-large outline-text">Filtrar mes:</span>
        <input type="month" class="style-button" id="dateInput" onchange="filterCompleted()">
      </div>
      <div class="simple-container">
        <md-filled-button onclick="toggleCreateTaskWindow()" data-flip-id="animate">
          <md-icon slot="icon">add</md-icon>
          <span>Crear tarea</span>
        </md-filled-button>
      </div>
    </div>
    
    
  </div>
  <div class="simple-container user-select-none grow-1" style="min-height:400px;">
    
    <div class="simple-container gap-8 grow-1 flex-wrap">
      
      <div class="content-box light-color direction-column gap-8 padding-8 light-color border-radius-32 grow-1 basis-small task-column-parent" style="min-height:200px;">

        <div class="padding-16 b-padding-0 on-secondary-container-text overflow-hidden">
          <span class="headline-small">Pendientes</span>
          <!-- <md-icon class="absolute-card small filled" aria-hidden="true">pending</md-icon> -->
        </div>

        <div 
          class="simple-container direction-column grow-1 column padding-8 gap-8"
          id="pending"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
          >
        </div>
      </div>

      <div class="content-box light-color direction-column gap-8 padding-8 light-color border-radius-32 grow-1 basis-small task-column-parent" style="min-height:200px;">

        <div class="padding-16 b-padding-0 on-secondary-container-text overflow-hidden">
          <span class="headline-small">En progreso</span>
          <!-- <md-icon class="absolute-card small filled" aria-hidden="true">build</md-icon> -->
        </div>

        <div 
          class="simple-container direction-column grow-1 column padding-8 gap-8"
          id="in-progress"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
          >

        </div>
      </div>

      <div class="content-box light-color direction-column gap-8 padding-8 light-color border-radius-32 grow-1 basis-small task-column-parent" style="min-height:200px;">

        <div class="padding-16 b-padding-0 on-secondary-container-text overflow-hidden">
          <span class="headline-small weight-500">Completadas</span>
          <!-- <md-icon class="absolute-card small filled" aria-hidden="true">task_alt</md-icon> -->
        </div>

        <div 
          class="simple-container direction-column grow-1 column padding-8 gap-8"
          id="completed"
          ondrop="drop(event)"
          ondragover="allowDrop(event)"
          >

        </div>
      </div>



    </div>

    
  </div>

  <template id="template-task-item">
    <div 
      data-task-parent 
      class="
        content-box 
        direction-row 
        gap-8 
        align-center 
        light-color 
        padding-0 
        cursor-pointer 
        outline-with-shadow
        border-radius-16
        overflow-hidden
        on-background-text
      "
      >
      <md-ripple></md-ripple>
      <div class="simple-container l-padding-16">
        <md-checkbox class="checkbox" data-task-checkbox></md-checkbox>
      </div>
      <div class="simple-container padding-16 l-padding-8 grow-1" data-flip-id="animate" data-taks-name-parent>
        <span class="body-large" data-task-name>...</span>
      </div>
    </div>
  </template>

    <!-- <span>•</span> -->

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

    .task-limit-date-container{display:none}
    .task-limit-date-container[active]{
      display:flex;
      overflow:hidden;
      animation: taskLimitDateParentIn 700ms cubic-bezier(0.38,0.49,0,1);
    }
    /* .task-limit-date-container[closing]{
      animation: taskLimitDateParentOut 500ms cubic-bezier(0.38,0.49,0,1);
    } */

    @keyframes taskLimitDateParentIn {
      from {
        max-height: 0;
        opacity: 0;
      }
      to {
        max-height: 75px;
        opacity: 1;
      }
    }
    /* @keyframes taskLimitDateParentOut {
      from {
        max-height: 75px;
        opacity: 1;
      }
      to {
        max-height: 0px;
        opacity: 0;
      }
      
    } */
  </style>





  <!-- <h2>Arrastra el elemento a la caja</h2>
  

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
</div> -->

  
</section>
<window class="increased slim h-auto" id="window-apps" data-flip-id="animate">
  <div class="content-box minimal padding-16">
    <md-icon-button onclick="toggleWindow()">
      <md-icon>close</md-icon>
    </md-icon-button>
  </div>
  <holder>
    <span class="display-small bricolage weight-600">Apps</span>
      <div class="simple-container gap-16 grow-1 flex-wrap">

        <div class="content-box light-color padding-32 basis-normal grow-1 user-select-none hover-outline" data-w_section_container>
            <div class="simple-container direction-column justify-center gap-16 grow-1">
                <span class="label-large primary-text">stepbro notes</span>

                <div class="simple-container gap-16 align-center">
                    <div class="content-box fit-content padding-16 border-radius-16" style="background:black;color:white" data-w_section_app_icon>
                        <md-icon class="filled">edit_square</md-icon>
                    </div>
                    <span class="display-medium dm-sans weight-500 line-height-0-85" data-w_section_title>stepbro Notes</span>
                </div>
                
                <span class="headline-small line-height-1 text-wrap-pretty outline-text">Una app de notas con sistema de carpetas, lista de tareas y diario encriptado.</span>
                <div class="simple-container grow-1"></div>
                <div class="simple-container flex-wrap gap-8">
                    <md-filled-button href="apps/notes/home"><md-icon slot="icon">open_in_new</md-icon>Abrir app</md-filled-button>                    
                </div>
            </div>
        </div>

        <div class="content-box padding-32 light-color basis-normal grow-1 user-select-none hover-outline">
            <div class="simple-container direction-column justify-center gap-16 grow-1">
                <span class="label-large primary-text">stepbro fitness / MuscleMaster </span>

                <div class="simple-container gap-16 align-center">
                    <div class="content-box fit-content padding-16 border-radius-16" style="background:#ff9947; color:#411d00;">
                        <md-icon class="filled">fitness_center</md-icon>
                    </div>
                    <span class="display-medium dm-sans weight-500 line-height-0-85">stepbro Fitness</span>
                </div>
                
                <span class="headline-small text-wrap-pretty outline-text">
                    Una app de entrenamiento personal con rutinas, seguimiento de progreso y recomendaciones personalizadas.
                </span>
                <div class="simple-container grow-1"></div>
                <div class="simple-container flex-wrap gap-8">
                    <md-filled-button href="apps/notes/home" disabled="true"><md-icon slot="icon">open_in_new</md-icon>Próximamente</md-filled-button>
                    <!-- <md-outlined-button 
                        onclick="togglePrettyWSection('#w-section-info-projects-3',['data-w_section_container','data-w_section_app_icon', 'data-w_section_title', 'data-w_section_previus_icon', 'data-w_section_previus_title'])">
                        <md-icon slot="icon">visibility</md-icon>
                        Más información
                    </md-outlined-button> -->
                    
                </div>
        
            </div>
        </div>

        
    </div>
  </holder>
</window>
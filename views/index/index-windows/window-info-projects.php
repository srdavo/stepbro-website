<window
    id="window-info-projects"
    class="increased full-size"
    >
        

        <div class="simple-container padding-16 gap-16 align-center">
            <md-icon-button onclick="togglePrettyWindow()">
                <md-icon>close</md-icon>
            </md-icon-button>

            <!-- <span class="headline-small dm-sans" data-title>Nuestros proyectos</span> -->
        </div>
        
    <holder class="on-background-text overflow-hidden">

        <div class="simple-container direction-column grow-1 align-center on-background-text gap-16 overflow-hidden">
            <div class="simple-container direction-column width-100 max-width-1200 overflow-hidden gap-16 overflow-hidden">
                
                <div class="w-section overflow-auto direction-column simple-container gap-8" id="w-section-info-projects-1" active>

                    <div class="simple-container gap-16 align-center bottom-margin-32">
                        <md-icon class="pretty-minimal-medium filled" data-icon data-w_section_previus_icon>apps</md-icon>
                        <span class="display-large dm-sans" data-title data-w_section_previus_title>Nuestros proyectos</span>
                    </div>
                    
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
                                    <md-filled-tonal-button
                                        class="solid" 
                                        onclick="togglePrettyWSection('#w-section-info-projects-2',['data-w_section_container'])">
                                        <md-icon slot="icon">visibility</md-icon>
                                        Más información
                                    </md-filled-tonal-button>
                                    
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

                </div>


                <div class="w-section overflow-auto simple-container direction-column gap-8" id="w-section-info-projects-2">
                    <div class="simple-container align-center gap-16 bottom-margin-8 flex-wrap">
                        <md-icon-button onclick="togglePrettyWSection('#w-section-info-projects-1',['data-w_section_container'])"><md-icon>arrow_back</md-icon></md-icon-button>
                        <div class="simple-container align-center gap-8">
                            <md-icon class="filled" data-w_section_previus_icon>apps</md-icon>
                            <span class="headline-small dm-sans" data-w_section_previus_title>Nuestros proyectos > </span>
                        </div>
                        <div class="simple-container align-center gap-8">
                            <div class="content-box fit-content padding-4 border-radius-16" style="background:black;color:white">
                                <md-icon class="filled" style="scale:0.5">edit_square</md-icon>
                            </div>
                            <span class="headline-small dm-sans ">stepbro Notes</span>
                        </div>
                    </div>


                    <div class="simple-container grow-1 basis-large gap-8 flex-wrap" data-w_section_container>
                        <div class="simple-container grow-1 basis-normal border-radius-16" style="background:var(--md-sys-color-surface-container)">
                            <img class="width-100 fit-cover object-left" src="https://i.ibb.co/0YzC06m/635shots-so.png" alt="Imagen demo de stepbro notes">
                        </div>
                        <div class="simple-container grow-1 basis-normal border-radius-16" style="background:var(--md-sys-color-surface-container)">
                            <img class="width-100 fit-cover" src="https://i.ibb.co/Dg7X4JB/146-1x-shots-so.png" alt="Imagen demo de stepbro notes">
                        </div>
                        <div class="simple-container grow-1 basis-normal border-radius-16" style="background:var(--md-sys-color-surface-container)">
                            <img class="width-100 fit-cover" src="https://i.ibb.co/2kGyqbJ/36shots-so.png" alt="Imagen demo de stepbro notes"> 
                        </div>
                    </div>

                    <div class="simple-container direction-column top-margin-24">
                        <div class="simple-container gap-16 align-center bottom-margin-16">
                            <div class="content-box fit-content padding-16 border-radius-16" style="background:black;color:white" data-w_section_app_icon>
                                <md-icon class="filled">edit_square</md-icon>
                            </div>
                            <span class="display-medium dm-sans weight-500 line-height-0-85" data-w_section_title>stepbro Notes</span>
                            <div class="simple-container grow-1"></div>
                            <md-filled-button href="apps/notes/home" class="hide-on-mobile"><md-icon slot="icon">open_in_new</md-icon>Abrir app</md-filled-button>

                        </div>
                        <span class="headline-small line-height-1-5 text-wrap-pretty outline-text">Stepbro Notes es una aplicación multiplataforma diseñada para llevar tu organización al siguiente nivel. Ofrece un completo <span class="primary-text">sistema de carpetas</span> para ordenar tus notas de forma clara y eficiente, un práctico <span class="primary-text">to-do list</span> para gestionar tus tareas con estados personalizados, y un <span class="primary-text">diario encriptado</span> con contraseña para mantener tus pensamientos privados y protegidos. Todo con un <span class="primary-text">diseño fluido, estético y pensado para facilitar tu día a día</span>.</span>
                        <md-filled-button href="apps/notes/home" class="only-on-mobile top-margin-24"><md-icon slot="icon">open_in_new</md-icon>Abrir app</md-filled-button>
                    </div>

                    <div class="top-margin-24" style="
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                        grid-template-rows: repeat(2, 1fr);
                        gap: 8px;
                        ">
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">folder_open</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">Sistema de carpetas</span>
                            <p class="body-large text-wrap-pretty">Organiza todas tus notas de forma elegante y eficiente con un sistema de carpetas. Perfecto para tener todas tus ideas, proyectos y tareas separadas de manera visualmente agradable, como en un sistema operativo.</p>
                        </div>
                        </div>
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">edit_note</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">Notas rápidas</span>
                            <p class="body-large text-wrap-pretty">Toma notas al instante, sin preocuparte por guardarlas. Al entrar en la aplicación, tendrás un recuadro listo para escribir, y cada palabra se guarda automáticamente mientras escribes. Ideal para esos momentos de prisa.</p>
                        </div>
                        </div>
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">encrypted</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">Diario encriptado</span>
                            <p class="body-large text-wrap-pretty">Tu espacio personal y privado para escribir tus pensamientos diarios. Protegido por un PIN y encriptado, asegura que solo tú tengas acceso a tus entradas más personales.</p>
                        </div>
                        </div>
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">list</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">To do List</span>
                            <p class="body-large text-wrap-pretty">Un sistema de listas de tareas simple y funcional, con estados como pendiente, en progreso y completado. Organiza y marca tus objetivos fácilmente, con la posibilidad de añadir fechas límite.</p>
                        </div>
                        </div>
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">devices</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">Multiplataforma</span>
                            <p class="body-large text-wrap-pretty">Usable en cualquier dispositivo, ya sea que prefieras una computadora, tablet o teléfono. Además, puedes instalarla como una Progressive Web App (PWA) para tenerla siempre a mano.</p>
                        </div>
                        </div>
                        <div class="content-box padding-32 direction-row hover-scale-small light-color">
                        <div class="simple-container"><md-icon class="primary-container-text filled pretty small" aria-hidden="true">palette</md-icon></div>
                        <div class="simple-container direction-column gap-8 grow-1">
                            <span class="headline-small  weight-500">Personalización</span>
                            <p class="body-large text-wrap-pretty">Personaliza tu experiencia cambiando la paleta de colores y el estilo de navegación. Haz que la aplicación se sienta verdaderamente tuya, con un look que se adapta a tus gustos.</p>
                        </div>
                        </div>
                        

                    </div>

                </div>


            </div>
        </div>


        
        

        
        <!-- <div class="simple-container flex-wrap gap-8 grow-1">
            <div class="simple-container width-100 flex-wrap gap-32 height-100">
                <div class="simple-container grow-1 basis-large gap-8">
                    <div class="simple-container grow-1 basis-normal border-radius-24" style="background:var(--md-sys-color-surface-container)">
                        <img class="width-100 fit-cover object-left" src="https://i.ibb.co/0YzC06m/635shots-so.png" alt="Imagen demo de stepbro notes">
                    </div>
                    <div class="simple-container grow-1 basis-normal direction-column gap-8">
                        <div class="simple-container grow-1 basis-normal border-radius-24" style="background:var(--md-sys-color-surface-container)">
                            <img class="width-100 fit-cover" src="https://i.ibb.co/Dg7X4JB/146-1x-shots-so.png" alt="Imagen demo de stepbro notes">
                        </div>
                        <div class="simple-container grow-1 basis-normal border-radius-24" style="background:var(--md-sys-color-surface-container)">
                            <img class="width-100 fit-cover" src="https://i.ibb.co/2kGyqbJ/36shots-so.png" alt="Imagen demo de stepbro notes">
                        </div>
                    </div>
                </div>

                <div class="simple-container direction-column justify-center grow-1 basis-normal gap-16">
                    <div class="simple-container gap-16 align-center">
                        <div class="content-box fit-content primary-container on-primary-container-text padding-16 border-radius-16">
                            <md-icon class="filled">edit_square</md-icon>
                        </div>
                        <span class="display-large dm-sans weight-500 line-height-0-85">stepbro Notes</span>
                    </div>
                    
                    <span class="headline-small line-height-1-5 text-wrap-pretty outline-text">Una app de notas con sistema de carpetas, lista de tareas y diario encriptado.</span>
                    <div class="simple-container">
                    <md-filled-button href="apps/notes/home"><md-icon slot="icon">open_in_new</md-icon>Abrir app</md-filled-button>
                    </div>
                </div>
            </div>
        </div> -->

    </holder>
</window>
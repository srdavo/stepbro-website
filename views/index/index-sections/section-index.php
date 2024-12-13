<section id="section-index" class="padding-8" active>

  <div class="simple-container direction-column gap-8 grow-1 border-radius-24 overflow-auto scrollbar-hidden">
    <div class="content-box justify-center align-center height-100 gap-16" style="padding:48px">
      <!-- <h1 class="display-large dm-sans" style="font-size:10vw; color:var(--md-sys-color-on-surface-variant); font-weight:600; line-height:0.95">Cocounut</h1> -->
      <h1 style="display:none">Stepbro</h1>
      <div class="simple-container">
        <span class="index-letter">s</span>
        <span class="index-letter">t</span>
        <span class="index-letter">e</span>
        <span class="index-letter">p</span>
        <span class="index-letter">b</span>
        <span class="index-letter">r</span>
        <span class="index-letter">o</span>
      </div>
      <style>
        .index-letter{
          font-size: 10vw;
          font-weight: 600;
          color: var(--md-sys-color-on-background);
          line-height: 0.95;
          font-family: "Bricolage Grotesque", system-ui;
          transition: 
            font-weight 300ms cubic-bezier(.29,.64,0,1), 
            transform 300ms cubic-bezier(.29,.64,0,1), 
            color 300ms cubic-bezier(.29,.64,0,1), 
            margin 300ms cubic-bezier(.29,.64,0,1)
            /* text-shadow 500ms cubic-bezier(.29,.64,0,1); */
            
            ;
          cursor:default;
          user-select:none;
        }

        .index-letter:hover{
          font-weight:1000;
          transform:scale(1.1);
          /* color:var(--md-sys-color-primary-container); */
          /* text-shadow: 0px 0px 128px var(--md-sys-color-primary-container); */
          margin:0 4px;
        }

        .stepbro-display{
          transform: rotate3d(1, 1, 1, -60deg) scale(4);
          transition:transform 900ms cubic-bezier(0.38,0.49,0,1.16);
          /* animation: stepbro-display-animation 9s infinite; */
        }
        .stepbro-display-container:hover .stepbro-display{
          transform: rotate3d(1, 1, 1, 0deg) scale(1);
        }

        @keyframes stepbro-display-animation {
            0%{
            transform: rotate3d(1, 1, 1, 20deg) scale(1);
            color: var(--md-sys-color-background);
            }
            25%{
            transform: rotate3d(1, 1, 1, 10deg) scale(1.1);
            color: var(--md-sys-color-primary-container);
            }
            50%{
            transform: rotate3d(1, 1, 1, 0deg) scale(1.2);
            font-size: 60px;
            color: var(--md-sys-color-secondary);
            }
            75%{
            transform: rotate3d(1, 1, 1, -10deg) scale(1.1);
            color: var(--md-sys-color-tertiary);
            }
            100%{
            transform: rotate3d(1, 1, 1, -20deg) scale(1);
            color: var(--md-sys-color-background);
            }
        }

    
        
      </style>

      <h2 class="headline-medium weight-500 user-select-none text-center" style="color:var(--md-sys-color-on-secondary-container); line-height:0.98">
        La máxima cálidad en desarrollo de software.
      </h2>
      <div class="simple-container v-margin">
        <md-filled-button data-flip-id="animate" onclick="toggleWindow('#window-apps', undefined, 1)"><md-icon slot="icon">arrow_downward</md-icon>Explorar</md-filled-button>
      </div>

      <!-- <sb-container-2>
        <div class="simple-container" slot="closed">
          <div class="content-box">
            <md-ripple></md-ripple>
            <md-icon class="filled">visibility</md-icon>
            <span class="dm-sanas">Visión</span>
          </div>
        </div>
        <div class="simple-container grow-1" slot="open">
          <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>

        </div>
      </sb-container-2> -->
        <div class="content-box width-auto" data-flip-id="animate" onclick="toggleBeautifulWindow('#window-beautiful-test')">
          <md-ripple></md-ripple>
          <md-icon class="filled">visibility</md-icon>
          <span class="dm-sanas">Visión</span>
        </div>

      <!-- <sb-container data-origin_element_style="padding:48px !important;">
        <div slot="closed">
          <div data-origin_element class="simple-container cursor-pointer padding-24 direction-column gap-8 border-radius-24 position-relative">
            <md-icon class="filled">visibility</md-icon>
            <span class="dm-sans">Visión</span>
          </div>
        </div>
        <div slot="open" class="padding-24">
          <div class="simple-container direction-column grow-1 basis-large justify-center padding-40 gap-24 on-background-text">
            <sb-container 
              data-origin_element_style="
                display:flex;
                margin:24px;
                box-sizing:border-box;
              "
              >
              <span slot="closed"><span class="content-box cursor-pointer light-color" data-origin_element>stepbro Software</span></span>
              <div slot="open" class="simple-container direction-column padding-24 gap-16">
                <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
              </div>
            </sb-container>
            <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
            <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
          </div>
        </div>
      </sb-container> -->
      <!-- <expandable-card>
        <div slot="container" style="background: #f9f9f9; padding: 16px;"></div>
        <div slot="closed">
          <h3>Haz clic para abrir</h3>
        </div>
        <div slot="open">
          <h3>Contenido expandido</h3>
          <p>¡Aquí puedes colocar más detalles!</p>
        </div>
      </expandable-card> -->

      <!-- <sb-container-3
        data-container_class="content-box outline-1"
        >
        <div slot="close" class="content-box">
          Hola mundo
        </div>
        <div slot="open" class="content-box ">
          <p>¡Aquí puedes colocar más detalles!</p>
        </div>
      </sb-container-3> -->



      <!-- <sb-container>
        <div class="main-container" slot="main-container">
          <div class="closed">Haz clic para abrir</div>
          <div class="hidden-content" style="display: none;">Haz clic aquí para cerrar</div>
        </div>
      </sb-container> -->

    </div>

    <!-- <div class="content-box align-center gap-16">
        <div class="simple-container">
          <span class="headline-medium dm-sans">stepbro 1</span>
        </div>

        <div class="simple-container border-radius-24 overflow-hidden">
          <img src="assets/asset2.png" alt="stepbro #1" style="max-width:100%; height:500px; object-fit: cover;">
        </div>

        <div class="simple-container">
          <span class="body-large dm-sans">Próximamente disponible</span>
        </div>
    </div> -->


    <div class="simple-container justify-center">
      <div class="simple-container direction-column grow-1 max-width-1200 user-select-none">
        <div class="simple-container flex-wrap gap-8 gap-8 height-100">
          <div class="simple-container grow-1 basis-normal">
            <div class="stepbro-display-container overflow-hidden simple-container grow-1 justify-center align-center primary-container border-radius-16" style="aspect-ratio:1/1">
              <span class="bricolage display-large weight-600 background-text stepbro-display">stepbro</span>
            </div>
          </div>
          <div class="simple-container direction-column grow-1 basis-large justify-center padding-40 gap-24 on-background-text">
            <sb-container 
              data-origin_element_style="
                display:flex;
                margin:24px;
                box-sizing:border-box;
              "
              >
              <span slot="closed"><span class="content-box cursor-pointer light-color" data-origin_element>stepbro Software</span></span>
              <div slot="open" class="simple-container direction-column padding-24 gap-16">
                <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
              </div>
            </sb-container>
            <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
            <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="simple-container direction-column align-center">
        <div class="simple-container width-100 max-width-800 gap-8">
          <sb-container class="simple-container grow-1" data-origin_element_style="transition:background 500ms; margin:24px; flex-direction:row; gap:16px; align-items:center;">
            <div slot="closed" class="position-relative">
              <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                <md-icon class="filled pretty medium">visibility</md-icon>
                <span class="dm-sans headline-large">Visión</span>
              </div>
            </div>
            <div slot="open">
              <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
                <!-- anidados -->
                <div class="simple-container width-100 gap-8">
                  <sb-container class="simple-container grow-1"data-origin_element_style="transition:background 500ms; margin:24px;background:transparent; flex-direction:row; gap:16px; align-items:center;">
                    <div slot="closed" class="position-relative">
                      <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                        <md-icon class="filled pretty medium">visibility</md-icon>
                        <span class="dm-sans headline-large">Visión</span>
                      </div>
                    </div>
                    <div slot="open">
                      <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                        <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                        <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
                      </div>
                    </div>
                  </sb-container>

                  <sb-container class="simple-container grow-1"data-origin_element_style="transition:background 500ms; margin:24px;background:transparent; flex-direction:row; gap:16px; align-items:center;">
                    <div slot="closed" class="position-relative">
                      <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                        <md-icon class="filled pretty medium">sentiment_very_satisfied</md-icon>
                        <span class="dm-sans headline-large">Ventajas</span>
                      </div>
                    </div>
                    <div slot="open">
                      <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                        <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                        <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
                      </div>
                    </div>
                  </sb-container>

                  <sb-container class="simple-container grow-1"data-origin_element_style="transition:background 500ms; margin:24px;background:transparent; flex-direction:row; gap:16px; align-items:center;">
                    <div slot="closed" class="position-relative">
                      <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                        <md-icon class="filled pretty medium">payments</md-icon>
                        <span class="dm-sans headline-large">Costos</span>
                      </div>
                    </div>
                    <div slot="open">
                      <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                        <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                        <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
                      </div>
                    </div>
                  </sb-container>
                </div>
              </div>
            </div>
          </sb-container>

          <sb-container class="simple-container grow-1"data-origin_element_style="transition:background 500ms; margin:24px;background:transparent; flex-direction:row; gap:16px; align-items:center;">
            <div slot="closed" class="position-relative">
              <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                <md-icon class="filled pretty medium">sentiment_very_satisfied</md-icon>
                <span class="dm-sans headline-large">Ventajas</span>
              </div>
            </div>
            <div slot="open">
              <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
              </div>
            </div>
          </sb-container>

          <sb-container class="simple-container grow-1"data-origin_element_style="transition:background 500ms; margin:24px;background:transparent; flex-direction:row; gap:16px; align-items:center;">
            <div slot="closed" class="position-relative">
              <div data-origin_element class="content-box width-auto cursor-pointer user-select-none">
                <md-icon class="filled pretty medium">payments</md-icon>
                <span class="dm-sans headline-large">Costos</span>
              </div>
            </div>
            <div slot="open">
              <div class="simple-container direction-column gap-24 padding-48 t-padding-0">
                <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
                <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
              </div>
            </div>
          </sb-container>
          
          <!-- <div class="content-box width-auto grow-1 cursor-pointer user-select-none">
            <md-icon class="filled pretty medium">sentiment_very_satisfied</md-icon>
            <span class="dm-sans headline-large">Ventajas</span>
          </div>
          <div class="content-box width-auto grow-1 cursor-pointer user-select-none">
            <md-icon class="filled pretty medium">payments</md-icon>
            <span class="dm-sans headline-large">Costos</span>
          </div> -->
        </div>
    </div>

    <div class="simple-container widht-100 direction-column align-center">
      <div class="simple-container width-100 max-width-800 direction-column">
        
        <!-- <sb-container class="simple-container grow-1 widht-100" data-origin_element_style="background:transparent; transition:background 700ms; flex-direction:row; gap:24px; cursor:default; align-items:center;">
          <div slot="closed" class="position-relative">
            <div data-origin_element class="simple-container secondary padding-24 border-radius-24 direction-column  grow-1 cursor-pointer">
              <md-icon class="pretty filled">sentiment_very_satisfied</md-icon>
              
              <div class="display-large dm-sans user-select-none">stepbro</div>
            </div>
          </div>
        </sb-container> -->

        <div class="simple-container">

          <sb-container
            data-origin_element_style="
              transition:background 500ms, margin 500ms;
              margin:24px;
              background:transparent;
              color:var(--md-sys-color-on-background);
              flex-direction:column;
              gap:8px;
              justify-content:center;
              align-items:flex-start;
              cursor:default;
            "
            >
            <div slot="closed" class="position-relative">
              <div 
                data-origin_element 
                class="
                  content-box 
                  direction-row
                  align-center
                  width-auto
                  padding-16 
                  cursor-pointer
                  weight-500
                "
                >
                <md-icon class="filled">person_add</md-icon>
                <span>Registrar usuario</span>
              </div>
            </div>
            <div slot="open" class="simple-container grow-1">
              <form class="simple-container width-100 padding-32 t-padding-0 direction-column gap-16" action="/register" method="POST">
                <md-filled-text-field label="Nombre" name="name" required></md-filled-text-field>
                <md-filled-text-field label="Correo Electrónico" type="email" name="email" required></md-filled-text-field>
                <md-filled-text-field label="Contraseña" type="password" name="password" required></md-filled-text-field>
                <md-filled-text-field label="Confirmar Contraseña" type="password" name="confirm_password" required></md-filled-text-field>
                <div class="simple-container justify-right">
                  <md-filled-button type="submit"><md-icon slot="icon">send</md-icon>Registrar</md-filled-button>
                </div>
              </form>
            </div>
          </sb-container>

        </div>

        

        


      </div>
    </div>

    <!-- <sb-container class="simple-container grow-1 flex-wrap gap-8 gap-8">
      <div class="simple-container direction-column" slot="closed">
        <div data-origin_element class="stepbro-display-container overflow-hidden simple-container grow-1 justify-center align-center primary-container border-radius-16" style="aspect-ratio:1/1">
          <span class="bricolage display-large weight-600 background-text stepbro-display">stepbro</span>
        </div>
      </div>
      <div class="simple-container direction-column grow-1 basis-large justify-center padding-40 gap-24 on-background-text" slot="open">
        <span class="data-line light-color">stepbro Software</span>
        <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
        <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
      </div>
    </sb-container> -->

    <!-- <div class="simple-container flex-wrap gap-8 gap-8 height-100">
      
      <div class="simple-container grow-1 basis-normal">
        <div class="stepbro-display-container overflow-hidden simple-container grow-1 justify-center align-center primary-container border-radius-16" style="aspect-ratio:1/1">
          <span class="bricolage display-large weight-600 background-text stepbro-display">stepbro</span>
        </div>
      </div>
      <div class="simple-container direction-column grow-1 basis-large justify-center padding-40 gap-24 on-background-text">
        <span class="data-line light-color">stepbro Software</span>
        <span class="dm-sans display-large line-height-0-75 ">Nuestra visión</span>
        <p class="headline-small line-height-1-5 text-wrap-pretty">Stepbro Software nace con el objetivo de redefinir la forma en que se desarrolla y se entrega software, tanto para usuarios individuales como para empresas y negocios.<br>Nos enfocamos en crear herramientas que no solo sean funcionales, sino que también destaquen por su calidad, experiencia de usuario y diseño.</p>
      </div>
    </div> -->



  </div>

  

  

   
  

  
</section>
<section id="section-index" class="padding-8" active>

  <div class="simple-container direction-column gap-8 grow-1 border-radius-24 overflow-auto scrollbar-hidden">
    <div class="content-box justify-center align-center height-100 gap-16" style="padding:48px">
      <!-- <h1 class="display-large dm-sans" style="font-size:10vw; color:var(--md-sys-color-on-surface-variant); font-weight:600; line-height:0.95">Cocounut</h1> -->

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

    
        
      </style>

      <p class="headline-medium weight-500 user-select-none text-center" style="color:var(--md-sys-color-on-secondary-container); line-height:0.98">
        Transformando el desarrollo de software
      </p>
      <div class="simple-container v-margin">
        <md-filled-button data-flip-id="animate" onclick="toggleWindow('#window-apps', undefined, 1)"><md-icon slot="icon">apps</md-icon>Nuestras apps</md-filled-button>
      </div>
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
        <div class="simple-container width-100 max-width-1200">
          <div class="simple-container direction-column gap-16 on-background-text top-margin-64 bottom-margin-64 padding-32">
            <span class="display-small dm-sans weight-500">¿Qué somos?</span>
            <p class="headline-small outline-text line-height-1-5 text-wrap-pretty">
              <!-- Somos una empresa de <span class="primary-text">desarrollo de software</span> que se enfoca en la creación de Sistemas para empresas y aplicaciones para usuarios.<br><br> -->
              En Stepbro Software, <span class="primary-text">transformamos ideas en soluciones tecnológicas</span> que combinan funcionalidad, diseño y accesibilidad. Nos especializamos tanto en aplicaciones para usuarios individuales como en sistemas personalizados para negocios, <span class="primary-text">siempre con un enfoque en la experiencia de usuario y la calidad.</span>
            </p>
          </div>
        </div>
    </div>

    <div class="simple-container height-100 gap-8 flex-wrap on-background-text">
      <!-- <div class="content-box width-auto grow-1 basis-normal direction-column justify-center padding-32">
        <md-icon class="pretty-minimal filled">kid_star</md-icon>
        <span class="display-large dm-sans">Somos mejores.</span>
      </div> -->

      <div 
        onclick="togglePrettyWindow('#window-info-projects', ['data-icon', 'data-title'])"
        class="content-box width-auto grow-1 basis-normal direction-column justify-center padding-32 cursor-pointer hover-outline"
        >
        <md-icon class="pretty-minimal filled" data-icon>apps</md-icon>
        <span class="display-large dm-sans" data-title>Nuestros proyectos</span>
      </div>

      <!-- <div class="content-box width-auto grow-1 basis-normal direction-column justify-center padding-32">
        <md-icon class="pretty-minimal filled">credit_card</md-icon>
        <span class="display-large dm-sans">Precios</span>
      </div> -->
    </div>

  </div>

  

   
  

  
</section>
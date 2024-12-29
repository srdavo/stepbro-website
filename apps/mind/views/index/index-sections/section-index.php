<section id="section-index" active class="landing-page top-padding-0-16">

  <div class="simple-container grow-1 flex-wrap gap-32">
    <div class="simple-container grow-1 basis-normal align-center justify-center">

      <div class="simple-container direction-column">
        <span class="main-title dm-sans">
          Super<br>beautiful<br> Mind
        </span>
        <span class="headline-small outline-text">
          Controla tus citas, controla tu clínica
        </span>
        <span class="top-margin-24">
          <?php
            if(isset($_SESSION['id'])){
              echo "
                <button 
                  class='style-1 primary-container on-primary-container-text'
                  onclick='window.location=\"home\"'
                  >
                  <md-ripple></md-ripple>
                  Comenzar
                </button>
              ";
            } else{
              echo "
                  <button 
                    class='style-1 primary-container on-primary-container-text'
                    data-flip-id='animate'
                    onclick='toggleWindow(\"#window-sb-signup\",undefined,1)'
                    >
                    <md-ripple></md-ripple>
                    Comenzar
                  </button>
              ";
            }
          ?>
        </span>
      </div>
      
    </div>
    <div class="simple-container grow-1 basis-normal border-radius-24" style="background:var(--md-sys-color-surface-container-low)">
      <img 
        class="width-100 fit-cover object-left"
        src="https://i.ibb.co/Xtp2qFV/998shots-so.png" 
        alt="app preview"
      >
    </div>
  </div>

  <!-- <div class="simple-container direction-column user-select-none grow-1 align-center justify-center">
    
    <span class="display-large dm-sans weight-600 primary-text hover-scale-small">Cocounut Mind</span>
    <span class="headline-small outline-text">
      Controla tus citas
    </span>
    <md-filled-button href="home" class="top-margin-24">
      Probar app
    </md-filled-button>
  </div> -->

  <style>
    .main-title-parent{
      min-height:324px;
    }

    .landing-page .main-title{
      font-size:80px;
      /* font-family: "Bricolage Grotesque", system-ui !important; */
      color:var(--md-sys-color-on-background);
      user-select: none;
      font-weight:600;
      line-height:0.88;
    } 
    .landing-page .main-image{
      width:100%;
      border-radius:64px;
      background: var(--md-sys-color-surface-container-low)
    }


    [only-on-mobile]{display:none;}
    [hide-on-mobile]{display:flex;}
    [hide-on-mobile][dark-mode]{display:none;}
    @media only screen and (max-width: 680px){
      [only-on-mobile]{display:flex;}
      [hide-on-mobile]{display:none;}

      .main-title-parent{
        min-height:80%;
      }

      .landing-page .main-image{
        border-radius:16px;
      }
    }

    @media only screen and (max-width: 680px) and (prefers-color-scheme: light){
      [only-on-mobile][dark-mode]{display:none ;}
    }
    @media only screen and (min-width: 680px) and (prefers-color-scheme: dark){
      [hide-on-mobile][dark-mode]{display:flex;}
      [hide-on-mobile][light-mode]{display:none;}
    }
    @media only screen and (max-width: 680px) and (prefers-color-scheme: dark){
      [only-on-mobile][light-mode]{display:none;}
    }

  </style>
 
</section>



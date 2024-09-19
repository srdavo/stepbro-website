<section id="section-index" active>

    <div class="content-box justify-center grow-1" style="padding:48px">
      <h1 class="bricolage" style="font-size:2vw; color:var(--md-sys-color-on-background); font-weight:600; line-height:0.95">stepbro</h1>
      <h1 style="font-size:10vw; color:var(--md-sys-color-on-surface-variant); font-weight:600; line-height:0.95">Notes</h1>
      <p class="headline-medium dm-sans weight-500" style="color:var(--md-sys-color-on-secondary-contaienr); line-height:0.98">
        La <span style="color:var(--md-sys-color-primary)">mejor</span> aplicación de Notas
      </p>
      <div class="simple-container v-margin">
        <?php
          if(!isset($_SESSION['user'])){
            echo '
              <md-filled-button href="'.BASE_URL.'">Volver a inicio para Iniciar sesión</md-filled-button>
            ';
          }else{
            echo '
              <md-filled-button href="home"><md-icon slot="icon">login</md-icon>Entrar</md-filled-button>
            ';
          }
        ?>

      </div>
    </div>
   
  

  
</section>
<window
    id="window-app-message-example"
    data-flip-id="animate"
    >
    <div class="simple-container position-absolute top-16 left-16 z-index-1">
        <md-filled-tonal-icon-button onclick="toggleWindow()" class="color-translucent">
            <md-icon>close</md-icon>
        </md-filled-tonal-icon-button>
    </div>
    <holder class="padding-8 on-background-text user-select-none">
        <div class="simple-container gap-8 flex-wrap">
            <div class="simple-container border-radius-16 overflow-hidden grow-1 basis-normal">
                <img class="width-100 image-fit-cover" src="https://i.ibb.co/SV9CW4g/443shots-so.png" alt="Image of the new Theme">
            </div>
            <div class="simple-container direction-column grow-1 basis-normal padding-16">
                <div class="simple-container direction-column gap-0">
                    <span class="body-large dm-sans primary-text bottom-margin-8">Novedades</span>
                    <span class="dm-sans display-small weight-500">Nuevo tema</span>
                </div>
                <div class="simple-container direction-column outline-text gap-16 bottom-margin-16">
                    <span class="body-large">
                        Hemos lanzado un nuevo tema para la aplicación, puedes probarlo en la sección de configuración.
                    </span>
                </div>
                <div class="simple-container grow-1"></div>
                <div class="simple-container justify-right">
                    <md-filled-tonal-button class="solid">Probar ahora</md-filled-tonal-button>
                </div>
            </div>
        </div>
    </holder>
</window>
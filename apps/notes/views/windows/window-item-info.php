<window 
    id="window-item-info"
    class=""
    data-flip-id="animate"
    >
    <div class="simple-container gap-8 padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small window-title on-background-text">Información</span>
    </div>
    <holder class="on-background-text">
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Nombre</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-item-name">...</span></div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Tipo</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-item-type">...</div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Id</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-item-id">...</div>
        </div>
        <!-- <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Ubicación</span></div>
            <div class="simple-container"><span class="body-large" ><i class="outline-text">Próximamente</i></span></div>
        </div> -->
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Fecha de creación</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-item-created-at">...</span></div>
        </div>
        <!-- <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Última modificación</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-last-modified"><i class="outline-text">Próximamente</i></span></div>
        </div> -->




    </holder>
</window>
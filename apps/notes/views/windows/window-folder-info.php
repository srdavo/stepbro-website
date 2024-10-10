<window 
    id="window-folder-info"
    class=""
    data-flip-id="animate"
    >
    <div class="simple-container gap-8 padding-16">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small window-title">Información</span>
    </div>
    <holder>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Tipo</span></div>
            <div class="simple-container"><span class="body-large" ><i class="outline-text">Próximamente</i></span></div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Ubicación</span></div>
            <div class="simple-container"><span class="body-large" ><i class="outline-text">Próximamente</i></span></div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Nombre de la carpeta</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-folder-name">...</span></div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Fecha de creación</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-created-at">...</span></div>
        </div>
        <div class="content-box direction-row light-color h-gap-24 padding-16 border-radius-16 justify-between">
            <div class="simple-container"><span class="label-large">Última modificación</span></div>
            <div class="simple-container"><span class="body-large" id="response-info-last-modified"><i class="outline-text">Próximamente</i></span></div>
        </div>




    </holder>
</window>
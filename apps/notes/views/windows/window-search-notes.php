<window 
    id="window-search-notes"
    class="increased slim h-auto"
    data-flip-id="animate"
    >
    <div class="simple-container gap-8 padding-16 b-padding-8">
        <md-icon-button onclick="toggleWindow()">
            <md-icon>close</md-icon>
        </md-icon-button>
        <span class="simple-container align-center headline-small window-title">Buscador</span>
    </div>
    <holder class="on-background-text gap-0">
        <form onsubmit="searchFunctions.search(event)" class="simple-container gap-8 flex-wrap justify-right">
            <input
                id="search-input"
                class="grow-1 rounded"
                type="search"
                autocomplete="off"
                placeholder="Buscar en tus notas"
            >
           
            <md-filled-button><md-icon slot="icon">search</md-icon>Buscar</md-filled-button>
        </form>
        <div id="response-search-results" class="top-margin-8 simple-container direction-column gap-8"></div>
        <div class="simple-container width-100 container-info-empty-table grow-1"></div>
        <div class="simple-container" id="pagination-search"></div>
    </holder>
</window>
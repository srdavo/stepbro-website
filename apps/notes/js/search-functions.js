(function(){
    let searchInput = document.getElementById("search-input");
    let resultContainer = document.getElementById('response-search-results');
    let currentSearch = "";

    window.searchFunctions = {
        openSearchWindow,
        search,
        searchInput,
        resultContainer,
        getSearch,
    }

    function openSearchWindow(isMobile = false){
        searchInput.value = "";
        if(isMobile){
            toggleWindow('#window-search-notes', 0, undefined, true)
        }else{
            toggleWindow('#window-search-notes', 'absolute', 2, true)
        }
        searchInput.focus();
    }

    async function search(event = false, page = 0){
        if(!false){event.preventDefault();}
        const parentId = "#window-search-notes";
        if(!checkEmpty(parentId, "input")){return;}
        if(searchInput.value == currentSearch){return false}
        toggleButton(parentId, true);
        
        searchValue = searchInput.value.trim();
        const result = await getSearch(searchValue);
        toggleButton(parentId, false);
        buildResults(result.data);
    }

    async function getSearch(searchValue, page = 0){
        const data = {
            op: "get_search",
            search: searchValue,
            page:page,
        }
        const url = `controllers/search.controller.php`
        try{
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json'}
            });
            if (response.ok) {
                const result = await response.json();
                if(result.success){
                    currentSearch = searchValue;
                    return result;
                } else { 
                    message(`Hubo un error: ${result.message}`, "error"); 
                }
            } else {
                message("Hubo un error en la solicitud", "error");
            }
        } catch (error) {
            message("Error: " + error.message, "error");
        }
    }

    function buildResults(data = false){
        if(!data){ return; }
        state = Flip.getState(`#window-search-notes`);
        resultContainer.nextElementSibling.innerHTML = "";
        if(data.length == 0){
            resultContainer.innerHTML = "";
            resultContainer.nextElementSibling.innerHTML = `
                <div class="search-result-item-in simple-container gap-8 padding-16 align-center user-select-none">
                    <md-icon>search_off</md-icon>
                    <p class="margin-top-16">No se encontraron resultados</p>
                </div>
            `;
            applyAnimation(state, `#window-search-notes`, false, false, true);
            return false;
        }
        resultContainer.innerHTML = "";
        data.forEach(item => {
            let resultItem = document.createElement('div');
            resultItem.classList.add('search-result-item', 'content-box', 'direction-row', 'padding-16', 'border-radius-16', 'cursor-pointer');
            
            itemName = cleanHTMLContent(item.content);
            if(itemName == ""){itemNameFormated = `<i class="outline-text">Nota sin nombre</i>`;}else{itemNameFormated = itemName;}
            
            resultItem.innerHTML = `
                <div class="simple-container">
                    <md-icon>notes</md-icon>
                </div>
                <div class="simple-container grow-1 align-center">
                    ${itemNameFormated}
                </div>
                <md-ripple></md-ripple>
            `;

            resultItem.setAttribute("data-note-id", item.id);
            resultItem.setAttribute("data-note-created-at", item.created_at);
            resultItem.setAttribute("data-note-name", itemName);
            resultItem.setAttribute("data-note-status", item.status);
            resultItem.setAttribute("title", itemName);
            resultItem.onclick = function() {
                displayNoteContent(item.id, this);
                toggleWindow();
                removeAllActiveItems();
            }

            resultContainer.appendChild(resultItem);
        });

        resultContainer.querySelectorAll('.search-result-item').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.05}s`; // Retraso de 0.2s por elemento
            el.classList.add('search-result-item-in'); // Agrega la clase que activa la animación
            el.addEventListener("animationend", () => {
                el.classList.remove("search-result-item-in")
                el.classList.add("search-result-item-opacity-100");
            }, {once: true})
        });
        applyAnimation(state, `#window-search-notes`, false, false, true);
    }
})();

// function search(){
//     const resultsParent = document.getElementById('response-search-results');
//     state = Flip.getState(`#window-search-notes`);

//     resultsParent.innerHTML = `
//         <div class="search-result-item content-box direction-row padding-16 border-radius-16 cursor-pointer">
//             <div class="simple-container">
//                 <md-icon>notes</md-icon>
//             </div>
//             <div class="simple-container grow-1 align-center">
//                 Resultado de la busqueda
//             </div>
//             <md-ripple></md-ripple>
//         </div>
//         <div class="search-result-item content-box direction-row padding-16 border-radius-16 cursor-pointer">
//             <div class="simple-container">
//                 <md-icon>notes</md-icon>
//             </div>
//             <div class="simple-container grow-1 align-center">
//                 Resultado de la busqueda
//             </div>
//             <md-ripple></md-ripple>
//         </div>
//         
        
//     `;

//     resultsParent.querySelectorAll('.search-result-item').forEach((el, index) => {
//         el.style.animationDelay = `${index * 0.05}s`; // Retraso de 0.2s por elemento
//         el.classList.add('search-result-item-in'); // Agrega la clase que activa la animación
//         el.addEventListener("animationend", () => {
//             el.classList.remove("search-result-item-in")
//             el.classList.add("search-result-item-opacity-100");
//         }, {once: true})
//     });

//     applyAnimation(state, `#window-search-notes`, false, false, true);
// }
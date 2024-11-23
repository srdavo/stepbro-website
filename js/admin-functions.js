
(function(){
    let adminPanel = document.querySelector("#window-admin-panel");

    async function syncAdminPanel(){
        // users
        buildUsersTable();
        // access
        buildPageAccessTable();
        // suggestions
        buildSuggestionsTable();

    }

    window.AdminPanel = {
        syncAdminPanel,
        buildUsersTable,
        buildPageAccessTable,
        buildSuggestionsTable
    }

    // Users
    async function getUsers(page = 0){
        const data = {
            op: "get_users",
            page:page
        }
        const url = `${BASE_URL}controllers/admin.controller.php`;
        try{
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json'}
            });
            if (response.ok) {
                const result = await response.json();
                if(result.success){ 
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
        return false;
    }
    async function buildUsersTable(page = 0){
        const result = await getUsers(page);
        if(!result) return false;
        const tableContainer = adminPanel.querySelector("#response-users-table");
        emptyTableIndicator = tableContainer.nextElementSibling;
        emptyTableIndicator = "";

        if(!result.data || result.data.length === 0){
            emptyTableIndicator.innerHTML = `
                <div class="content-box on-background-text align-center info-table-empty">
                    <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                    <span class="headline-small">No hay registros</span>
                </div>
            `;
            return false;
        }


        tableContainer.innerHTML = `
            <tr>
                <td>Id</td>
                <td></td>
                <td>Nombre</td>
                <td>Correo</td>
                <td>Token</td>
                <td>Google Id</td>
                <td>Nivel de permisos</td>
                <td>Fecha de creación</td>
            </tr>
            ${result.data.map(user => {
                googleId = user.google_id ? user.google_id : "-";
                profilePicture = user.profile_picture ? `<span class='simple-container overflow-hidden border-radius-64' style='width:24px;'><img class='width-100' src='${user.profile_picture}'></span>` : `<span class='simple-container outline-variant-text overflow-hidden border-radius-64' style='width:24px;'><md-icon class='filled'>account_circle</md-icon></span>` 
                permissions = (user.permissions == "7") ? "<span class='data-line primary-text'>Administrador</span>" : "<span class='data-line'>Usuario</span>";

                return `
                    <tr>                       
                        <td>${user.user_id}</td>
                        <td>${profilePicture}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.user_token}</td>
                        <td>${googleId}</td>
                        <td>${permissions}</td>
                        <td>${formatDateTime(user.creation_datetime)}</td>
                    </tr>
                `;
            }).join("")}
        `;
        displayTotalUsers(result.total_rows);
        buildUsersTablePagination(result.total_rows, result.limit, page);
    }
    function buildUsersTablePagination(totalRows, limit, currentPage = 0){
        const container = adminPanel.querySelector("#pagination-users-table");
        const pageCount = Math.ceil(totalRows / limit);
        if(pageCount <= 1){container.innerHTML = "";return;}
    
        let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
        for (let i = 0; i < pageCount; i++) {
            if (i === currentPage) {
                paginationHTML += `<md-filled-icon-button onclick='AdminPanel.buildUsersTable(${i})'>${i+1}</md-filled-icon-button>`;
            } else {
                paginationHTML += `<md-icon-button onclick='AdminPanel.buildUsersTable(${i})'>${i + 1}</md-icon-button>`;
            }
        }
        paginationHTML += `</span>`;
        container.innerHTML = paginationHTML;
    }
    async function displayTotalUsers(totalRows = false){
        if(!totalRows) return false;
        const container = adminPanel.querySelector("#response-admin-panel-total-users");
        container.textContent = totalRows;
    }
    
    // Access
    async function getPageAccess(page = 0){
        const data = {
            op: "get_page_access",
            page:page
        }
        const url = `${BASE_URL}controllers/admin.controller.php`;
        try{
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json'}
            });
            if (response.ok) {
                const result = await response.json();
                if(result.success){ 
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
        return false;
    }
    async function buildPageAccessTable(page = 0){
        const result = await getPageAccess(page);
        if(!result) return false;
        const tableContainer = adminPanel.querySelector("#response-admin-panel-access-table");
        emptyTableIndicator = tableContainer.nextElementSibling;
        emptyTableIndicator = "";

        if(!result.data || result.data.length === 0){
            emptyTableIndicator.innerHTML = `
                <div class="content-box on-background-text align-center info-table-empty">
                    <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                    <span class="headline-small">No hay registros</span>
                </div>
            `;
            return false;
        }

        tableContainer.innerHTML = `
            <tr>
                <td></td>
                <td>Usuario</td>
                <td>Id de usuario</td>
                <td>App</td>
                <td>Dispositivo</td>
                <td>Ip</td>
                <td>Fecha de acceso</td>
            </tr>
            ${result.data.map(access => {
                profilePicture = access.profile_picture ? `<span class='simple-container overflow-hidden border-radius-64' style='width:24px;'><img class='width-100' src='${access.profile_picture}'></span>` : `<span class='simple-container outline-variant-text overflow-hidden border-radius-64' style='width:24px;'><md-icon class='filled'>account_circle</md-icon></span>` 

                return `
                    <tr>                       
                        <td>${profilePicture}</td>
                        <td>${access.name}</td>
                        <td>${access.user_id}</td>
                        <td>${access.page_name}</td>
                        <td>${access.device_type}</td>
                        <td>${access.ip_address}</td>
                        <td>${formatDateTime(access.access_timestamp)}</td>
                    </tr>
                `;
            }).join("")}
        `;
        displayTotalAccess(result.total_rows);
        buildPageAccessTablePagination(result.total_rows, result.limit, page);
    }
    function buildPageAccessTablePagination(totalRows, limit, currentPage = 0){
        const container = adminPanel.querySelector("#pagination-admin-panel-access-table");
        const pageCount = Math.ceil(totalRows / limit);
        if(pageCount <= 1){container.innerHTML = "";return;}
    
        let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
        for (let i = 0; i < pageCount; i++) {
            if (i === currentPage) {
                paginationHTML += `<md-filled-icon-button onclick='AdminPanel.buildPageAccessTable(${i})'>${i+1}</md-filled-icon-button>`;
            } else {
                paginationHTML += `<md-icon-button onclick='AdminPanel.buildPageAccessTable(${i})'>${i + 1}</md-icon-button>`;
            }
        }
        paginationHTML += `</span>`;
        container.innerHTML = paginationHTML;
    }
    function displayTotalAccess(totalRows = false){
        if(!totalRows) return false;
        const container = adminPanel.querySelector("#response-admin-panel-total-access");
        container.textContent = totalRows;
    }

    // suggestions
    async function getSuggestions(page = 0){
        const data = {
            op: "get_suggestions",
            page:page
        }
        const url = `${BASE_URL}controllers/admin.controller.php`;
        try{
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json'}
            });
            if (response.ok) {
                const result = await response.json();
                if(result.success){ 
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
        return false;
    }
    async function buildSuggestionsTable(page = 0){
        const result = await getSuggestions(page);
        if(!result) return false;
        const tableContainer = adminPanel.querySelector("#response-admin-panel-suggestions-table");
        emptyTableIndicator = tableContainer.nextElementSibling;
        emptyTableIndicator = "";

        if(!result.data || result.data.length === 0){
            emptyTableIndicator.innerHTML = `
                <div class="content-box on-background-text align-center info-table-empty">
                    <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                    <span class="headline-small">No hay registros</span>
                </div>
            `;
            return false;
        }

        tableContainer.innerHTML = `
            <tr>
                <td></td>
                <td>Usuario</td>
                <td>App</td>
                <td>Sugerencia</td>
            </tr>
            ${result.data.map(suggestion => {
                profilePicture = suggestion.profile_picture ? `<span class='simple-container overflow-hidden border-radius-64' style='width:24px;'><img class='width-100' src='${suggestion.profile_picture}'></span>` : `<span class='simple-container outline-variant-text overflow-hidden border-radius-64' style='width:24px;'><md-icon class='filled'>account_circle</md-icon></span>` 

                return `
                    <tr>                       
                        <td>${profilePicture}</td>
                        <td>${suggestion.name}</td>
                        <td>${suggestion.page_name}</td>
                        <td>${suggestion.suggestion}</td>
                    </tr>
                `;
            }).join("")}
        `;
        displayTotalSuggestions(result.total_rows);
        buildSuggestionsTablePagination(result.total_rows, result.limit, page);
    }
    function buildSuggestionsTablePagination(totalRows, limit, currentPage = 0){
        const container = adminPanel.querySelector("#pagination-admin-panel-suggestions-table");
        const pageCount = Math.ceil(totalRows / limit);
        if(pageCount <= 1){container.innerHTML = "";return;}
    
        let paginationHTML = `<span class='simple-container width-100 flex-wrap members-table-rows' style='min-height:48px;max-height:80px;overflow:auto'>`;
        for (let i = 0; i < pageCount; i++) {
            if (i === currentPage) {
                paginationHTML += `<md-filled-icon-button onclick='AdminPanel.buildSuggestionsTable(${i})'>${i+1}</md-filled-icon-button>`;
            } else {
                paginationHTML += `<md-icon-button onclick='AdminPanel.buildSuggestionsTable(${i})'>${i + 1}</md-icon-button>`;
            }
        }
        paginationHTML += `</span>`;
        container.innerHTML = paginationHTML;
    }
    function displayTotalSuggestions(totalRows = false){
        if(!totalRows) return false;
        const container = adminPanel.querySelector("#response-admin-panel-total-suggestions");
        container.textContent = totalRows;
    }

    function formatDateTime(datetime){
        const date = new Date(datetime);
        return `${date.toLocaleDateString()} ${date.toLocaleTimeString()}`;
    }

})();



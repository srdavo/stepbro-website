
(function(){
    let adminPanel = document.querySelector("#window-admin-panel");


    syncAdminPanel();

    async function syncAdminPanel(){
        buildUsersTable();
    }

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
                profilePicture = user.profile_picture ? `<span class='simple-container overflow-hidden border-radius-64' style='width:24px;'><img class='width-100' src='${user.profile_picture}'></span>` : `<span class='simple-container outline-variant-text overflow-hidden border-radius-64' style='width:24px;'><md-icon>account_circle</md-icon></span>` 

                return `
                    <tr>
                        <td>${user.id}</td>
                        <td>${profilePicture}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.user_token}</td>
                        <td>${googleId}</td>
                        <td>${user.permissions}</td>
                        <td>${user.creation_datetime}</td>
                    </tr>
                `;
            }).join("")}
        `;

    }

})();



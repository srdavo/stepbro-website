function syncCalories(refrestTable = true){
    if(refrestTable){
        displayCalories();
    }
    displayTotalCalories();
}

async function registerCalories(event){
    event.preventDefault();
    const parentId = "#window-register-calories";
    if(!checkEmpty(parentId, "input, select")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "register_calories",
        calories: document.getElementById("register-calories-calories").value,
        description: document.getElementById("register-calories-description").value,
        date: document.getElementById("register-calories-date").value,
        time: document.getElementById("register-calories-time").value,
    }
    const url = `${BASE_URL}controllers/calories.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Calorias registradas", "success");
                data.id = result.id;

                syncCalories();
                toggleWindow();
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

async function getCalories(page = 0){
    const data = {
        op: "get_calories",
        page:page,
    }
    const url = `${BASE_URL}controllers/calories.controller.php`
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
            return result;
        } else{ message("Hubo un error en la función getMembers()", "error");}
    } catch (error) { 
        message("Error de conexión " + error.message, "error"); 
    }
    return false;
}

async function displayCalories(page = 0){
    const result = await getCalories(page);
    if(!result){return;}

    const container = document.getElementById("response-calories-table");
    container.nextElementSibling.innerHTML = ``;

    if(!result.data || result.data.length === 0){
        container.nextElementSibling.innerHTML = `
            <div class="content-box on-background-text align-center info-table-empty">
                <md-icon class="pretty medium" aria-hidden="true">sentiment_content</md-icon>
                <span class="headline-small">No hay registros</span>
            </div>
        `;
        return;
    }

    // Agrupar los registros por fecha
    const groupedData = result.data.reduce((groups, item) => {
        const date = item.date;
        if(!groups[date]){
            groups[date] = [];
        }
        groups[date].push(item);
        return groups;
    }, {});

    // Generar el HTML para los datos agrupados
    let htmlContent = '';
    for(const [date, items] of Object.entries(groupedData)){
        const totalCalories = items.reduce((sum, item) => sum + parseFloat(item.calories), 0);

        htmlContent += `
            <div class="content-box light-color padding-8 border-radius-32">
                <div class="content-box gap-0 surface-variant on-secondary-container-text overflow-hidden">
                    <span class="body-medium data-line bottom-margin-4 weight-500">${dateToText(date)}</span>
                    <span class="body-large">Calorias totales:</span>
                    <span class="display-small">${totalCalories}</span>
                    <md-icon class="absolute-card filled">nutrition</md-icon>
                </div>

                <div class="content-box padding-8">
                    <div class="simple-container direction-column border-radius-16">
                        <table class="style-3" id="dynamic-table-${date}">
                            <tr>
                                <td>Hora</td>
                                <td>Calorias</td>
                                <td>Descripción</td>
                            </tr>
                            ${items.map(item => `
                                <tr onclick="toggleDeleteCalorieLogDialog(${item.id}, this)">
                                    <td>${formatTime(item.time)}</td>
                                    <td><span class="data-line secondary-container weight-500 dm-sans">${Math.round(item.calories)}</span></td>
                                    <td>${item.description}</td>
                                </tr>
                            
                            `).join("")}
                        </table>
                    </div>
                </div>
            </div>
        `;
    }

    container.innerHTML = htmlContent;
}
function toggleDeleteCalorieLogDialog(logId, row){
    document.getElementById("button-confirm-delete-calorie-log").onclick = function(){ deleteCalorieLog(logId, row) }
    toggleDialog("dialog-delete-calorie-log-confirmation");
}

async function deleteCalorieLog(logId, row){
    const data = {
        op: "delete_calorie_log",
        id: logId,
    }
    const url = `${BASE_URL}controllers/calories.controller.php`
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json'}
        });
        if (response.ok) {
            const result = await response.json();
            if(result.success){ 
                message("Registro eliminado", "success");
                toggleDialog();
                removeTableRow(row);
                syncCalories(false);
            } else { 
                message(`Hubo un error: ${result.message}`, "error"); 
            }
            return result;
        } else{ message("Hubo un error en la función deleteCalorieLog()", "error");}
    } catch (error) { 
        message("Error de conexión " + error.message, "error"); 
    }
    return false;
}


async function getTotalCalories(){
    const data = {
        op: "get_total_calories",
    }
    const url = `${BASE_URL}controllers/calories.controller.php`
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
            return result;
        } else{ message("Hubo un error en la función getMembers()", "error");}
    } catch (error) { 
        message("Error de conexión " + error.message, "error"); 
    }
    return false;
}
async function displayTotalCalories(){
    const result = await getTotalCalories();
    if(!result){return;}
    document.getElementById("response-total-day-calories").innerHTML = Math.round(result.data);
}

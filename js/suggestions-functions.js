async function sendSuggestion(event){
    event.preventDefault();
    const parentId = "#window-send-suggestion";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "send_suggestion",
        page_name: "notes",
        suggestion: document.getElementById("send-suggestion-suggestion").value,
    }
    const url = `${BASE_URL}controllers/suggestions.controller.php`;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Sugerencia enviada", "success");
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
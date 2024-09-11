async function saveSettings(event){
    if(event !== undefined){event.preventDefault();}
    if(!(document.getElementById("dialog-verify-password").hasAttribute("open"))){
        toggleDialog("dialog-verify-password");
        return;
    }
    if(document.getElementById("dialog-verify-password").hasAttribute("open")){
        if (!checkEmpty("#dialog-verify-password", "input")) { return; }
    }

    const parentId = "#window-settings";
    if (!checkEmpty(parentId, "input")) { toggleDialog(); return; }
    toggleButton(parentId, true);

    const data = {
        op: "save_settings",
        password: document.getElementById("verify-password-input").value,
        store_name: document.querySelector(`${parentId} #settings-store-name`).value,
        store_owner_name: document.querySelector(`${parentId} #settings-store-owner-name`).value,
        store_contact_phone: document.querySelector(`${parentId} #settings-store-contact-phone`).value,
        store_contact_email: document.querySelector(`${parentId} #settings-store-contact-email`).value,
        store_address_1: document.querySelector(`${parentId} #settings-store-address-1`).value,
        store_address_2: document.querySelector(`${parentId} #settings-store-address-2`).value,
        store_address_3: document.querySelector(`${parentId} #settings-store-address-3`).value,
    };
    const url = "controllers/settings.controller.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });

        toggleButton(parentId, false);

        if (response.ok) {
            const result = await response.json();

            if (result.success) {
                message("Cambios guardados", "success");
                toggleDialog();
                toggleWindow();
            } else {
                message(result.message, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
        console.log(error);
    }
}
async function getSettings(){
    const data = {
        op: "get_settings",
    };
    const url = "controllers/settings.controller.php";
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (response.ok) {
            const result = await response.json();
            if(result.success){ 
                return result;
            } else{
                message(`Hubo un error: ${result.message}`, "error");
            }
            return result;
        } else{
            message("Hubo un error", "error");
        }
    } catch (error) {
        message("Error de conexión " + error.message, "error");
    }
    return false;
}

async function displaySettings(){
    const result = await getSettings();
    if(!result){ return; }

    document.getElementById("settings-user-email").innerText = result.data.email;
    document.getElementById("settings-user-id").innerText = result.data.user_id;
    document.getElementById("settings-user-token").innerText = result.data.user_token;
    
    document.querySelector("#settings-store-name").value = result.data.store_name;
    document.querySelector("#settings-store-owner-name").value = result.data.admin_name;
    document.querySelector("#settings-store-contact-phone").value = result.data.contact_phone;
    document.querySelector("#settings-store-contact-email").value = result.data.contact_email;
    document.querySelector("#settings-store-address-1").value = result.data.address_1;
    document.querySelector("#settings-store-address-2").value = result.data.address_2;
    document.querySelector("#settings-store-address-3").value = result.data.address_3;

    // add to the password dialog the onclick event to save the settings
    document.getElementById("dialog-verify-password-button").onclick = function(){ saveSettings(); };
}

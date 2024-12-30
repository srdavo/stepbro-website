const apptService = (() =>{
    const API_URL = 'back-end/controllers/appointment.controller.php';
    

    async function getAppts(data = {}){
        data.op = "appts_get_list";
        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' },
            });
            if (!response.ok) { throw new Error(`Error en la solicitud: ${response.statusText}`);}
            const result = await response.json();
            if (!result.success) { throw new Error(result.message || "Error desconocido en la respuesta");}
        
            return result;
        } catch (error) {
            message(`Hubo un error: ${error.message}`, "error");
            return null;
        }
    }

    async function insertAppt(data = {}){
        data.op = "appt_create";
        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' },
            });
            if (!response.ok) { throw new Error(`Error en la solicitud: ${response.statusText}`);}
            const result = await response.json();
            if (!result.success) { throw new Error(result.message || "Error desconocido en la respuesta");}
        
            return result;
        } catch (error) {
            message(`Hubo un error: ${error.message}`, "error");
            return false;
        }
    }

    window.getAppts = getAppts;

    return {
        insertAppt,
        getAppts
    }

})();

export default apptService;
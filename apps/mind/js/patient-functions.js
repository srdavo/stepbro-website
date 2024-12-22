const PatientsManager =  (function() {

    const createPatientForm = document.getElementById('form-create_patient');
    const createPatientName = createPatientForm.getElementById('create-patient_name');

    async function createPatient(event){
        event.preventDefault();
        if(!checkEmpty('#form-create_patient', 'input')){return;}
        const data = {
            patient_name: createPatientName.value.trim()
        }
        const insertPatient = await insertPatient(data);
        if(!insertPatient){return;}
        toggleWindow();
        message("Paciente creado correctamente", "success");
    }

    async function insertPatient(data){
        data.op = "patient_create";
        const url = `back-end/controllers/patients.controller.php`;
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            });
            if (!response.ok) {
                message("Hubo un error en la solicitud", "error");
                return false;
            }
            const result = await response.json();
            if (result.success) {
                return true;
            } else {
                message(`Hubo un error: ${result.message}`, "error");
                return false;
            }
        } catch (error) {
            message(`Hubo un error: ${error}`, "error");
            return false;
        }
    }

    

})();
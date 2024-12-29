import patientService from '../services/patientService.js';

const PatientsManager = (() => {
    let patients = [];

    // const createPatientWindow = document.getElementById("window-create-patient");
    const createPatientForm = document.getElementById("form-create-patient");
    const patientsTableContainer = document.getElementById("response-container-patients_table");

    async function loadPatients() {
        patients = await patientService.getPatients({ page: 0 });
    }
    async function createPatient(event = false, owner_id = false){
        if(event !== false) event.preventDefault();
        if(!checkEmpty(`#${createPatientForm.id}`, 'input')){return;}
        const data = {
            patient_name: createPatientForm.querySelector("[name='patient-name']").value.trim()
        }
        const result = await patientService.insertPatient(data, owner_id)
        if(!result) return false;

        patients.push({
            id: result.patient_id,
            patient_name: data.patient_name
        })
        displayPatientsTable();
        message("Paciente creado correctamente");
    }

    async function displayPatientsTable(page = 0, owner_id = false){
        patientsTableContainer.innerHTML = `
            <tr>
                <td>id</td>            
                <td>user_id</td>            
                <td>patient_name</td>            
            </tr>
            ${patients.map(patient => {
                return `
                    <tr>
                        <td>${patient.id}</td>
                        <td>${patient.user_id}</td>
                        <td>${patient.patient_name}</td>
                    </tr>
                `;
            }).join("")}
        `;
    }

    // async function createPatient(data) {
    //     const patientId = await patientService.insertPatient(data);
    //     if (patientId) {
    //         patients.push({ id: patientId, ...data });
    //     }
    // }

    return {
        loadPatients,
        createPatient,
        displayPatientsTable,
        patients: () => patients
    };
})();

export default PatientsManager;
import apptService from '../services/apptService.js';

const ApptsManager = (() => {

    let appts = [];
    async function loadAppts() {
        appts = await apptService.getAppts();
    }

    const createApptWindow = document.getElementById("window-create-appt");
    const createApptForm = document.getElementById("form-create-appt");

    const editApptWindow = document.getElementById("window-appt-data");
    const editApptForm = document.getElementById("form-edit-appt");

    const apptsTableContainer = document.getElementById("response-container-appts-table");

    function openCreateApptWindow(){
        toggleWindow(`#${createApptWindow.id}`);
        const patientSelector = createApptForm.querySelector("[name='appt-patient']");
        patientSelector.innerHTML = buildPatientsOptionList(PatientsManager.patients());
    }
    function buildPatientsOptionList(patients = false){
        if(!patients) return false;
        const list = patients.map(patient =>{
            return `
                <md-select-option
                    value=${patient.id}
                    >
                    <div slot="headline">${patient.patient_name}</div>
                </md-select-option>
            `;
        }).join("")

        return list;
    }

    async function displayApptsTable(page = 0){
        apptsTableContainer.innerHTML = `
            <tr>
                <td>id</td>
                <td>patient_id</td>
                <td>appt_date</td>
                <td>appt_time</td>
            </tr>
        `;

        appts.forEach(appt => {
            const row = document.createElement("tr");
            row.setAttribute("data-flip-id", "animate");
            row.onclick = () => openApptDataWindow(row);

            row.innerHTML = `
                <td>${appt.id}</td>
                <td>${appt.patient_id}</td>
                <td>${appt.appt_date}</td>
                <td>${appt.appt_time}</td>
            `;

            setApptDataset(appt, row);
            apptsTableContainer.appendChild(row);
        })
    }

    function setApptDataset(data, element) {
        if (!element) return false;
    
        for (const [key, value] of Object.entries(data)) {
            element.dataset[key] = value; // Asigna cada propiedad como atributo `data-*`
        }
    }

    function getDataset(element) {
        if (!element) return false;
    
        const dataset = {};
        for (const key in element.dataset) {
            dataset[key] = element.dataset[key];
        }
    
        return dataset;
    }

    async function createAppt(event = false){
        if(event !== false) event.preventDefault();
        if(!checkEmpty(`#${createApptForm.id}`, 'input')){return;}
        const data = {
            patient_id: createApptForm.querySelector("[name='appt-patient']").value.trim(),
            appt_date: createApptForm.querySelector("[name='appt-date']").value.trim(),
            appt_time: createApptForm.querySelector("[name='appt-time']").value.trim(),
        }
        const result = await apptService.insertAppt(data)
        if(!result) return false;

        console.log(result);
        console.log(result.id)
        appts.push({
            id: result.appt_id,
            patient_id: data.patient_id,
            appt_date: data.appt_date,
            appt_time: data.appt_time,
        });
        displayApptsTable();
        message("Cita creada correctamente");
    }


    function openApptDataWindow(origin){
        toggleWindow(`#${editApptWindow.id}`);
        const apptDataset = getDataset(origin);

        // editApptWindow.querySelector("[name='patient-name']").innerHTML = apptDataset.patient_name;
        editApptForm.querySelector("[name='appt-date']").value = apptDataset.appt_date;
        editApptForm.querySelector("[name='appt-time']").value = apptDataset.appt_time;
        editApptForm.querySelector("[name='appt-cost']").value = parseFloat(apptDataset.appt_cost) || 0;
        editApptForm.querySelector("[name='appt-concept']").value = apptDataset.appt_concept;
        editApptForm.querySelector("[name='appt-status']").value = apptDataset.appt_status;
        
    }

    return {
        openCreateApptWindow,
        createAppt,
        displayApptsTable,
        loadAppts,
        openApptDataWindow,
        appts: () => appts
    }

})();

export default ApptsManager;
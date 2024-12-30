import apptService from '../services/apptService.js';
import patientService from '../services/patientService.js';
import PatientsManager from './patientsManager.js';

const ApptsManager = (() => {

    let appts = [];
    let apptsForTable = []
    async function loadAppts() {
        // appts = await apptService.getAppts({limit: "no_limit"});
        apptsForTable = await apptService.getAppts({filters: getFiltersValue()});
    }

    const createApptWindow = document.getElementById("window-create-appt");
    const createApptForm = document.getElementById("form-create-appt");

    const editApptWindow = document.getElementById("window-appt-data");
    const editApptForm = document.getElementById("form-edit-appt");

    const apptsTableContainer = document.getElementById("response-container-appts-table");

    const apptsTableFiltersForm = document.getElementById("form-appts-table-filters");

    function populateAppointmentPatientFilter() {
        const patientSelector = apptsTableFiltersForm.querySelector("[name='filter-patients']");
        patientSelector.innerHTML = `
            <option value="all_patients">Todos los pacientes</option>
            ${buildPatientsVanillaOptionList(PatientsManager.patients())}
        `;
        const allPatientsOption = document.createElement("option")
        
    }

    function openCreateApptWindow(){
        toggleWindow(`#${createApptWindow.id}`);
        const patientSelector = createApptForm.querySelector("[name='appt-patient']");
        patientSelector.innerHTML = buildPatientsOptionList(PatientsManager.patients());
        // setDateTime(createApptForm.querySelector("[name='appt-date']"), createApptForm.querySelector("[name='appt-time']"));
    }

    function buildPatientsVanillaOptionList(patients = false){
        if(!patients) return false;
        const list = patients.map(patient =>{
            return `
                <option
                    value=${patient.id}
                    >
                    ${patient.patient_name}
                </option>
            `;
        }).join("")

        return list;
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
        // displayApptsTable();
        message("Cita creada correctamente");
    }
    function openApptDataWindow(origin){
        toggleWindow(`#${editApptWindow.id}`, "absolute", 1, true);
        const apptDataset = getDataset(origin);

        // editApptWindow.querySelector("[name='patient-name']").innerHTML = apptDataset.patient_name;
        editApptForm.querySelector("[name='appt-date']").value = apptDataset.appt_date;
        editApptForm.querySelector("[name='appt-time']").value = apptDataset.appt_time;
        editApptForm.querySelector("[name='appt-cost']").value = parseFloat(apptDataset.appt_cost) || 0;
        editApptForm.querySelector("[name='appt-concept']").value = apptDataset.appt_concept;
        editApptForm.querySelector("[name='appt-status']").value = apptDataset.appt_status;
        
    }

    function displayApptsTable(data = apptsForTable.data, replace = false) {
        if (replace) apptsTableContainer.innerHTML = "";
    
        const fragment = document.createDocumentFragment();
        const elements = buildApptsTable(data);
    
        elements.forEach(element => {
            fragment.appendChild(element);
        });
    
        apptsTableContainer.appendChild(fragment);
        
        handleLoadMoreButton();
        setApptsStatsData();
    }
    function buildApptsTable(appts) {
        return appts.map(appt => {
            const item = document.createElement("div");
            item.setAttribute("data-flip-id", "animate");
            item.onclick = () => openApptDataWindow(item);

            item.className = "content-box direction-row padding-16 border-radius-16 cursor-pointer user-select-none on-background-text";

            item.innerHTML = `
                <md-ripple></md-ripple>
                <div class="simple-container body-large">
                    <md-icon class="dynamic">circle</md-icon>
                </div>
                <div class="simple-container direction-column grow-1 gap-4">
                    <span class="label-medium">${dateToShort(appt.appt_date)}, ${timeToAmPm(appt.appt_time)}</span>
                    <span class="body-large">${PatientsManager.patients().find(patient => patient.id == appt.patient_id)?.patient_name}</span>
                </div>
            `;

            setApptDataset(appt, item);
            return item;
        });
    }
    async function displayNextPage(){
        const currentPage = Math.ceil(apptsForTable.pagination.offset / apptsForTable.pagination.limit);
        const nextPage = currentPage + 1;
        const nextPageResponse = await apptService.getAppts({page: nextPage, filters: getFiltersValue()})
        apptsForTable.data = [...apptsForTable.data, ...nextPageResponse.data];
        apptsForTable.pagination = nextPageResponse.pagination;
        displayApptsTable(nextPageResponse.data);
    }

    function handleLoadMoreButton(){
        const loadMoreButton = document.getElementById("load-more-appts");
        if(!loadMoreButton) return false;

        // Reset button state first
        loadMoreButton.disabled = false;

        // If total rows is less than or equal to limit, no need for load more
        if(apptsForTable.pagination.total_rows <= apptsForTable.pagination.limit) {
            loadMoreButton.disabled = true;
            return;
        }

        // If we've reached or exceeded the total rows, disable the button
        if(apptsForTable.pagination.offset + apptsForTable.pagination.limit >= apptsForTable.pagination.total_rows) {
            loadMoreButton.disabled = true;
            return;
        }

        // Set up click handler for the load more button
        loadMoreButton.onclick = () => displayNextPage();
    }

 
    
    

    async function applyTableFilters(){
        apptsForTable = await apptService.getAppts({filters:getFiltersValue()});
        displayApptsTable(undefined, true);
    }

    function getFiltersValue(){
        
        const filters = {
            month: apptsTableFiltersForm.querySelector("[name='filter-month']").value,
            year: apptsTableFiltersForm.querySelector("[name='filter-year']").value,
            status: apptsTableFiltersForm.querySelector("[name='filter-status']").value,
            patient: apptsTableFiltersForm.querySelector("[name='filter-patients']").value,
        };
        return filters;
    }



    function setApptsStatsData(){
        const statsContainer = document.getElementById("appts-stats-data-container");
        statsContainer.querySelector("[name='total-appts']").textContent = `${apptsForTable.pagination.total_rows} citas`;        
        statsContainer.querySelector("[name='total-cancelled-appts']").textContent = apptsForTable.data.filter(appt => appt.appt_status == "3").length;
        statsContainer.querySelector("[name='total-income']").textContent = formatMoney(apptsForTable.stats.total_cost)                
        
    }

    return {
        openCreateApptWindow,
        createAppt,
        loadAppts,
        openApptDataWindow,
        applyTableFilters,
        displayApptsTable,
        displayNextPage,
        populateAppointmentPatientFilter,
        // appts: () => appts,
        apptsForTable: () => apptsForTable,
    }

})();

export default ApptsManager;
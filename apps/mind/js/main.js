import PatientsManager from './managers/patientsManager.js';
import ApptsManager from './managers/apptsManager.js';
import TrashManager from './managers/trashManager.js';

(async function main() {
    try {
        // 1. Configuración inicial
        console.log('Iniciando aplicación...');
        
        // 2. Cargar datos iniciales
        await PatientsManager.loadPatients();
        await PatientsManager.displayPatientsTable();

        await ApptsManager.loadAppts();
        ApptsManager.displayApptsTable();
        ApptsManager.populateAppointmentPatientFilter();

        await TrashManager.loadTrashItems();


        window.PatientsManager = PatientsManager;
        window.ApptsManager = ApptsManager;
        window.TrashManager = TrashManager;
        
        // window.App = {
        //     PatientsManager,
        // }


        // Configurar eventos globales
        setupGlobalEvents();
      
        console.log('Aplicación lista.');
    } catch (error) {
        console.error('Error al iniciar la aplicación:', error);
    }
})();

function setupGlobalEvents(){

    document.getElementById("button-open-trash").addEventListener("click", () =>{
        toggleWindow("#window-trash");
        TrashManager.displayTrashTable("appt");
    })

}
import PatientsManager from './managers/patientsManager.js';
import ApptsManager from './managers/apptsManager.js';

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


        window.PatientsManager = PatientsManager;
        window.ApptsManager = ApptsManager;
        
        // window.App = {
        //     PatientsManager,
        // }

      
        console.log('Aplicación lista.');
    } catch (error) {
        console.error('Error al iniciar la aplicación:', error);
    }
})();
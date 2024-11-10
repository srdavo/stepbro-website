(function () {

    let diary = document.getElementById("create-diary-content");
    const diaryContentDiv = document.querySelector(".diary-content");

    if(diary) {
        // Variables y constantes globales dentro del IIFE
        let timeOut;
        let idNote = null;
        let createdAt = null;
        let offset = 0; 
        const limit = 10; 
        let isLoading = false; 
        let noMoreRecords = false;
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); 
        const day = String(today.getDate()).padStart(2, '0');
        const localDate = `${year}-${month}-${day}`;
        let alreadyExecuted = false;
        const diaryDate = document.getElementById("diary-date");
        

        // Eventos de scroll y de input para actualizar y guardar contenido
        diaryContentDiv.addEventListener("scroll", () => {
            if (diaryContentDiv.scrollTop + diaryContentDiv.clientHeight >= diaryContentDiv.scrollHeight) {
                getJournal()
            }
        });

        diary.addEventListener("input", () => {
            clearTimeout(timeOut);
            timeOut = setTimeout(() => {
                let diaryContent = diary.innerHTML;
                saveContent(diaryContent);
            }, 950); 
        });

async function saveContent(content){  
    const parentId = "#window-create-note";
    if(!checkEmpty(parentId, "input")){return;}
        const data = {
        op: "save_content",
        content: content,
        id: idNote,
        created_at: createdAt
    }
    let span = document.querySelector("[data-id_journal='"+idNote+"'] span");
    if(span){
        const divHidden = document.querySelector("[data-id_journal='"+idNote+"'] .hidden");
        divHidden.textContent = content;
        span.textContent = content.replace(/<[^>]*>/g, ' ');
    }

    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        toggleButton(parentId, false);
        if (result.success) {
            uiConfirmNoteChanges()

            if (result.id) {
                idNote = result.id;
            } 
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

        async function getJournal() {
            console.log(isLoading, noMoreRecords);
            if (isLoading || noMoreRecords) return; 
            isLoading = true; 
        
            const url = `controllers/diary.controller.php`;
            const data = {
                op: "get_journal",
                offset: offset,
                limit: limit
            };
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                showJournalContent(result.entries); 
                
                checkDay(result.entries);
                if (result.noMoreRecords) {
                    noMoreRecords = true;
                }else{
                    offset += limit;
                }
            } catch (error) {
                message("Error: " + error.message, "error");
            } finally {

                noMoreRecords = false;
                isLoading = false; // Asegúrate de que isLoading se restablezca a false
            }
        }

function showJournalContent(journal){
    journal.forEach(day => {
        const diaryBox = document.createElement("DIV");
        diaryBox.classList.add(
            "content-box", 
            "top-margin-16", 
            "padding-8", 
            "direction-column", 
            "gap-0", 
            "border-radius-64", 
            "flex-wrap", 
            "diary-box"
          );
          
        diaryBox.onclick = () => {
            toggleWindow("#window-check-diary-notes");
            displayDiaryContent(day)  };

        const diaryNote = document.createElement("DIV");
        diaryNote.classList.add("diary-note");
        diaryNote.innerHTML = `
            <md-ripple aria-hidden="true"></md-ripple>
            <md-icon aria-hidden="true">notes</md-icon>
        `;

        const span = document.createElement("SPAN");
        span.innerHTML = day.content;

        diaryNote.appendChild(span);
        diaryBox.appendChild(diaryNote);

                const spanDate = document.createElement("SPAN");
                spanDate.classList.add("left-margin-24");
                spanDate.textContent = formatDate(day.created_at);

                diaryBox.appendChild(spanDate);

                diaryContentDiv.appendChild(diaryBox);
            });
        }

        function checkDay(days) {
            if (alreadyExecuted) return;

            days.forEach(day => {
                if (day.created_at.split(" ")[0] === localDate) {
                    displayDiaryContent(day);
                }
            });
        }

function displayDiaryContent(day){
    idNote = day.id;
    createdAt = day.created_at;
    diary.innerHTML = day.content;
    diaryDate.textContent = formatDate(day.created_at);
}

        // Exponemos las funciones necesarias en el objeto DiaryApp
        window.DiaryApp = {
            getJournal
        };
    }

})();


function toggleCheckDiaryNotes(){
    toggleWindow("#window-check-diary-notes", undefined, 1);

}





function formatDate(dateString) {
    
    const date = new Date(dateString);
    
    
    const options = { 
        weekday: 'long',  
        year: 'numeric',  
        month: 'long',   
        day: 'numeric'    
    };
    
    
    const formattedDate = new Intl.DateTimeFormat('es-ES', options).format(date);
    
    return formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);  
}

// las siguientes funciones serán para el pin del diario
function toggleDiaryPinWindow(){
    toggleWindow("#window-diary-pin", "absolute", 1);
    document.getElementById("diary-validate-access-pin").focus();
}

function toggleSetDiaryPinWindow(){
    toggleWindow("#window-set-diary-pin", "");
}

async function saveDiaryPin(event){
    event.preventDefault();
    const setPint = await setDiaryPin();
    if(setPint){
        document.getElementById("open-diary-nav-button").onclick = function(){ toggleDiaryPinWindow() }
    }
}
async function setDiaryPin(event = false){
    if(event){ event.preventDefault();}
    const parentId = "#set-diary-pin-form";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "set_diary_pin",
        pin: document.getElementById("diary-set-access-pin").value
    }
    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                message("Diario configurado correctamente", "success");
                toggleWindow();
                return true;
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

async function startDiary(){
    // esta función decide si el usuario tiene un pin configurado o no
    // y en base a eso decide que ventana mostrar
    const openDiaryButton = document.getElementById("open-diary-nav-button");
    const hasPin = await checkDiaryPin();
    if(hasPin){
        openDiaryButton.onclick = function(){ toggleDiaryPinWindow() }
    }else{
        openDiaryButton.onclick = function(){ toggleSetDiaryPinWindow() }
    }



}

async function checkDiaryPin(){
    // esta función revisa si el usuario tiene un pin configurado
    const data = {
        op: "check_diary_pin",
    }
    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                return true;
            } else {
                return false;
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}
async function validateDiaryPin(event){
    event.preventDefault();
    const parentId = "#validate-diary-pin-form";
    if(!checkEmpty(parentId, "input")){return;}
    toggleButton(parentId, true);

    const data = {
        op: "validate_diary_pin",
        pin: document.getElementById("diary-validate-access-pin").value
    }
    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parentId, false);
        if (response.ok) {
            const result = await response.json();
            if (result.success) {
                toggleWindow();
                toggleSection("section-diary");
                DiaryApp.getJournal();
            } else {
                message(`${result.message}`, "error");
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
    }
}

const sectionDiary = document.querySelector("section#section-diary");

const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.attributeName === "class") {

            if (sectionDiary.classList.contains("section-open")) {
                
            } else {
                console.log("cerrado diario");
                document.querySelector("#window-check-diary-notes .diary-content").innerHTML = "";
            }
        }
    });
});

observer.observe(sectionDiary, { attributes: true });
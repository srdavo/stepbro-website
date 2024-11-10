(function () {

let diary = document.getElementById("create-diary-content");
const diaryContentDiv = document.querySelector(".diary-content");
if(diary){
// global variables 
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
getJournal();


// Global elements
const diaryDate = document.getElementById("diary-date");


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
    },950); 
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



async function getJournal(){
    
    if (isLoading || noMoreRecords) return; 
    isLoading = true; 

    const url = `controllers/diary.controller.php`
    const data = {
        op: "get_journal",
        offset: offset,
        limit: limit
    }
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        showJournalContent(result.entries) 
        offset += limit;
        checkDay(result.entries);
        if (result) {
            isLoading = false; 
            if (result.noMoreRecords) {
                noMoreRecords = true;
                // message("No hay mas registros", "error");   
            }
        } else {
            message("Hubo un error en la solicitud", "error");
        }
    } catch (error) {
        message("Error: " + error.message, "error");
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
        const divHidden = document.createElement("DIV");
        divHidden.classList.add("hidden");
        divHidden.textContent = day.content;

        diaryBox.onclick = () => {
            toggleWindow("#window-check-diary-notes");
            displayDiaryContent(day, true);
            };

        const diaryNote = document.createElement("DIV");
        diaryNote.classList.add("diary-note");
        diaryNote.setAttribute("data-id_journal", day.id);
        diaryNote.innerHTML = `
            <md-ripple aria-hidden="true"></md-ripple>
            <md-icon aria-hidden="true">notes</md-icon>
        `;

        const span = document.createElement("SPAN");
        span.innerHTML = day.content.replace(/<[^>]*>/g, ' ');



        diaryNote.appendChild(span);
        diaryNote.appendChild(divHidden);
        diaryBox.appendChild(diaryNote);

        const spanDate = document.createElement("SPAN");
        spanDate.classList.add("left-margin-24");
        spanDate.textContent = formatDate(day.created_at);

        diaryBox.appendChild(spanDate);

        diaryContentDiv.appendChild(diaryBox);
    });

}

function checkDay(days){
    if(alreadyExecuted) return;
    
    days.forEach(day => {
        if(day.created_at.split(" ")[0] == localDate){
            displayDiaryContent(day);
        }
    });
}

function displayDiaryContent(day, click = false) {
    idNote = day.id;
    const divHidden = document.querySelector("[data-id_journal='"+idNote+"'] .hidden");
    createdAt = day.created_at;
    diary.innerHTML = divHidden.textContent ?? day.content;
    diaryDate.textContent = formatDate(day.created_at);
}





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


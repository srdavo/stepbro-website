(function () {

let diary = document.getElementById("create-diary-content");
if(diary){
    console.log("ola")
// global variables 
let timeOut;
let idNote = null;
// let timeoutPromise = null; 


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
        id: idNote
    }

    const url = `controllers/diary.controller.php`
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        const result = await response.json();
        console.log(result);
        toggleButton(parentId, false);
        if (result) {
            if (result.id) {
                idNote = result.id;
                //form.querySelector(".editor").innerHTML = "";
                //form.closest(".editor-parent").removeAttribute("active");
                message("Contenido Guardado", "success");
                // syncNotes();
                
                // toggleWindow();
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

}


})();


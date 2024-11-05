// Ejecutar comandos de formato
function execCmd(command, showUI = false, value = null) {
    document.execCommand(command, showUI, value);
    updateButtonStates();
}

function updateButtonStates(){
    const toolbar = document.querySelector("section[active] [data-toolbar]");
    if(!toolbar) return;
    const boldBtn = toolbar.querySelector("[data-cmd=bold]");
    const italicBtn = toolbar.querySelector("[data-cmd=italic]");
    const underlineBtn = toolbar.querySelector("[data-cmd=underline]");
    // const strikeThroughBtn = toolbar.querySelector("[data-cmd=strikeThrough]");
    const justifyLeftBtn = toolbar.querySelector("[data-cmd=justifyLeft]");
    const justifyCenterBtn = toolbar.querySelector("[data-cmd=justifyCenter]");
    const justifyRightBtn = toolbar.querySelector("[data-cmd=justifyRight]");
    // const justifyFullBtn = toolbar.querySelector("[data-cmd=justifyFull]");
    const insertOrderedListBtn = toolbar.querySelector("[data-cmd=insertOrderedList]");
    const insertUnorderedListBtn = toolbar.querySelector("[data-cmd=insertUnorderedList]");
    // const createLinkBtn = toolbar.querySelector("[data-cmd=createLink]");
    const h1Btn = toolbar.querySelector("[data-cmd=h1]");
    const h2Btn = toolbar.querySelector("[data-cmd=h2]");
    // const h3Btn = toolbar.querySelector("[data-cmd=h3]");
    // const h4Btn = toolbar.querySelector("[data-cmd=h4]");

    underlineBtn.toggleAttribute("selected", document.queryCommandState("underline"));
    // strikeThroughBtn.toggleAttribute("selected", document.queryCommandState("strikeThrough"));
    justifyLeftBtn.toggleAttribute("selected", document.queryCommandState("justifyLeft"));
    justifyCenterBtn.toggleAttribute("selected", document.queryCommandState("justifyCenter"));
    justifyRightBtn.toggleAttribute("selected", document.queryCommandState("justifyRight"));
    // justifyFullBtn.toggleAttribute("selected", document.queryCommandState("justifyFull"));
    insertOrderedListBtn.toggleAttribute("selected", document.queryCommandState("insertOrderedList"));
    insertUnorderedListBtn.toggleAttribute("selected", document.queryCommandState("insertUnorderedList"));
    // createLinkBtn.toggleAttribute("selected", document.queryCommandState("createLink"));
    h1Btn.toggleAttribute("selected", document.queryCommandValue("formatBlock") === "h1");
    h2Btn.toggleAttribute("selected", document.queryCommandValue("formatBlock") === "h2");
    // h3Btn.toggleAttribute("selected", document.queryCommandValue("formatBlock") === "h3");
    // h4Btn.toggleAttribute("selected", document.queryCommandValue("formatBlock") === "h4");

    boldBtn.toggleAttribute("selected", document.queryCommandState("bold"));
    italicBtn.toggleAttribute("selected", document.queryCommandState("italic"));

}



// Pruebas de nuevo editor de texto:
// function startQuill(editor){
//     return quill = new Quill(editor, {});
// }

// function editorToggleBold(quill){
//     const isBold = quill.getFormat().bold;
//     quill.format('bold', !isBold);
// }
// function editorToggleItalic(quill){
//     const isItalic = quill.getFormat().italic;
//     quill.format('italic', !isItalic);
// }
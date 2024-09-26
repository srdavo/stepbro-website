let nav = document.querySelector('nav');
function toggleSection(objetiveSectionId) {
  activeSection = document.querySelector('section[active]');
  activeNavButton = nav.querySelector('nav button[active]');
  if (activeSection.id === objetiveSectionId) {
    console.log('Ya estás en la sección que quieres ver');
    return;
  }
  if(activeSection) {activeSection.removeAttribute('active');}
  if(activeNavButton) {activeNavButton.removeAttribute('active');}
  if(document.getElementById(objetiveSectionId)) {
    document.getElementById(objetiveSectionId).setAttribute('active', '');
    nav.querySelector(`button[data-section="${objetiveSectionId}"]`).setAttribute('active', '');

    if((window.location.pathname).split("/").pop() === "home"){
      localStorage.setItem("currentSection", objetiveSectionId);

    }
  }
}
function resetDialog(dialog){
  if(!dialog){return;}
  const inputs = dialog.querySelectorAll('input, textarea, select, '+ materialT("input"));
  for (let i=0; i<inputs.length; i++){
    inputs[i].value = "";
    inputs[i].removeAttribute('error');
  }
  toggleButton("#"+dialog.id, false);
}
function toggleDialog(dialogId) {
  if (dialogId == '' || dialogId == undefined){
    const openDialog = document.querySelector('md-dialog[open]')
    if(openDialog){
      openDialog.removeAttribute('open');
      openDialog.classList.remove('dialog-active');
      resetDialog(openDialog);
    }
    // resetForm();
    return
  }
  const dialog = document.getElementById(dialogId);
  dialog.setAttribute('open', '');
  dialog.classList.add('dialog-active');

}

// Menus
function toggleMenu(menuId) {
  const menu = document.getElementById(menuId);
  menu.open = !menu.open;
}


// old
function materialT(elements) {
  const mapping = {
    'option': 'md-select-option',
    'select': 'MD-OUTLINED-SELECT, MD-FILLED-SELECT',
    'select-not-reset': 'md-outlined-select:not(.no-reset), md-filled-select:not(.no-reset)', 
    'button': 'md-outlined-button, md-filled-button, md-filled-tonal-button, md-text-button, md-elevated-button',
    'input': 'md-outlined-text-field, md-filled-text-field',
    'input-not-reset': 'md-outlined-text-field:not(.no-reset), md-filled-text-field:not(.no-reset)',
    'slider': 'md-slider',
    'textarea': 'mwc-textarea'
  };

  const elementList = elements.split(',').map(e => e.trim().toLowerCase());

  const result = [];
  elementList.forEach(element => {
    const mapped = mapping[element];
    if (mapped) {
      result.push(mapped);
    }
  });

  return result.length > 0 ? result.join(', ') : 'Componente no mapeado';
}

function resetForm(parent){
  if (parent) {
    const parentElement = document.querySelector(parent);
    if(!parentElement){return;}
    var inputs = parentElement.querySelectorAll(materialT("input-not-reset")+', textarea, select:not(.no-reset), input:not(.no-reset) ,'+materialT("select-not-reset")+','+materialT("slider"));
  } else {
    var inputs = document.querySelectorAll(materialT("input")+', textarea, select:not(.no-reset), input:not(.no-reset)');
  }
  for (let i=0; i<inputs.length; i++){
    inputs[i].value = "";
    inputs[i].style.background = "";
    inputs[i].classList.remove('error');
  }
}

function resetFormNextGen(parentId){
  if(!parent){return;}
  const parentElement = document.getElementById(parentId);
  if(!parentElement){return;}
  const inputs = parentElement.querySelectorAll(materialT("input-not-reset")+', textarea, select:not(.no-reset), input:not(.no-reset) ,'+materialT("select-not-reset")+','+materialT("slider"));
  for (let i=0; i<inputs.length; i++){
      if(inputs[i].tagName == "select" || inputs[i].tagName == "MD-OUTLINED-SELECT" || inputs[i].tagName == "MD-FILLED-SELECT"){
        inputs[i].querySelectorAll(materialT("option")).forEach(element => {
          element.selected = false;
        });
      }else{
        if(inputs[i].tagName == "MD-SLIDER"){
          inputs[i].value = 50;
        }else{
          inputs[i].value = "";
        }
      }
      
    inputs[i].removeAttribute('error');
    try{inputs[i].reportValidity()} catch(e){}
    inputs[i].style.background = "";
    inputs[i].classList.remove('error');
  }
}

function checkEmpty(parentId, elementToCheck){
  const parentElement = document.querySelector(parentId);
  if(!parentElement){return;}
  const inputs = parentElement.querySelectorAll(materialT(elementToCheck));
  validation = 0;
  for (let i=0; i<inputs.length; i++){
    inputs[i].addEventListener("focus", function() {inputs[i].removeAttribute('error')}, {once: true});
    if(inputs[i].value === "" || inputs[i].value === "0"){ 
      validation = 1; 
      inputs[i].setAttribute('error', '');;
    }
  }
  if(validation != 0){
    // if(type==="dialog"){toggleWindow("#empty_spaces")} 
    return false;
  }else{
    return true
  }
}

function toggleButton(parentId, state, type){
  const parentElement = document.querySelector(parentId);
  if(!parentElement){return;}
  lastButton = parentElement.querySelector(materialT("button"));
  if(type === "submit"){lastButton = parentElement.querySelector('[type="submit"]')}
  if(state){
    lastButton.disabled = true;
  } else {
    lastButton.disabled = false;
  }
}

let currentTimeoutId = null;

function message(message, action){
  const messageElement = document.querySelector("MESSAGE");
  if (action === "error") {messageElement.classList.add('error');}
  if (action === "success") {messageElement.classList.add('success'); }
  
  messageElement.innerHTML = message;
  messageElement.style.display = "flex";
  messageElement.style.animation = "messageIn 0.7s cubic-bezier(0.6, -0.14, 0.02, 1.29)";
  if (currentTimeoutId) {clearTimeout(currentTimeoutId);}
  currentTimeoutId = setTimeout(() => {
      messageElement.style.animation = "messageOut 0.8s";
      setTimeout(() => {
        messageElement.style.display = "none"; 
        currentTimeoutId = null;
        messageElement.className="";
      }, 700);
  }, 4000);
}
function toggleWindowFullSize(){
  if(!document.querySelector('transparent window.active')){return;}

  state = Flip.getState("transparent window.active");
  windowId = document.querySelector('transparent window.active').id;
  document.getElementById(windowId).classList.toggle('full-size');

  timeline = Flip.from(state, {
    ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
    targets: "transparent window.active",
    scale:true,
    simple:true,
  })
  timeline.play();
}
function toggleWindow(windowId, position, scale){
  if (windowId == ''){windowId = null}

  // Close any other open window
  const transparent = document.querySelector('transparent');
  const activeWindow = transparent.querySelector('window.active');

  function closingAnimation() {
    if (transparent.hasAttribute("closing")) {
      transparent.classList.remove('active');
      transparent.removeAttribute("closing");
      
      activeWindow.classList.remove('active');
    }
  }

  if (activeWindow) {
    if (transparent.hasAttribute("closing")) { return; }
    // toggleOvermessage();

    // This attribute added and all makes the close animation smooth
    transparent.setAttribute("closing", "");
    transparent.addEventListener("animationend", () =>{closingAnimation()}, {once: true})
    
    resetFormNextGen(activeWindow.id)
    // resetForm();
    return;
  }
  if (transparent.hasAttribute("closing") && transparent.classList.contains("active")) {
    transparent.removeAttribute("closing");
  }

  // remove useless classes
  transparent.classList.remove('dynamic', 'right', 'left', 'top', 'bottom');


  // Window to open
  const windowNew = document.querySelector(windowId);
  if (!windowNew) { return; }
  transparent.classList.add('active'); 
  localStorage.setItem("currentWindow", windowId); 

  

  // Set origin element of animation
  if (event && event.currentTarget) {
    element = event.currentTarget;
    windowNew.classList.remove("not-animated");
  }else{
    element = null
    windowNew.classList.add("not-animated");
  }
  // if(originElement){
  //   element = document.getElementById(originElement);
  // }

  // specific functions per window
  switch (windowId) {
    case "#window-create_movement": 
      setInputDate();
    break;
    case "#window-account": 
      getUserData()
    break;
    case "#window-settings":
      displaySettings();  
      break;
    case "#window-register-calories":

      setDateTime("register-calories-date" , "register-calories-time"); 
      break;
    default: break;
  }

  // Set element with Dynamic position
  if(position == "absolute"){
    windowNew.classList.add("absolute");
    var rect = element.getBoundingClientRect();
    screenWidth = window.innerWidth;
    screenHeight = window.innerHeight;
    // Tests
    
    

    if (rect.left < (screenWidth/2)) {
      windowNew.style.right = "unset";
      windowNew.style.left = Math.round(rect.left)+"px";
      transparent.classList.add("left");
    } else{
      windowNew.style.left = "unset";
      windowNew.style.right = screenWidth-Math.round(rect.right)+"px";
      transparent.classList.add("right");
    }

    if (rect.top < (screenHeight/2)) {
      windowNew.style.bottom = "unset";
      windowNew.style.top = (Math.round(rect.top) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("top");

    }else{
      windowNew.style.top = "unset";
      windowNew.style.bottom = (screenHeight-Math.round(rect.bottom) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("bottom");
    }
    
    
    requestAnimationFrame(function() {
      var windowHeight = windowNew.offsetHeight;
      var windowBottom = screenHeight - (windowNew.offsetTop + windowNew.offsetHeight);
      
      var windowWidth = windowNew.offsetWidth;

    });
  }
  if(scale === undefined){scale = 0}else{scale = 1}
  animate(element, windowNew, position, scale);
}
function animate(element, windowNew, position, scale){
  let easeType = CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 ");
  if(position === "absolute" && window.innerWidth >= 681){
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 -0.003,0.896 0.325,1.044 0.653,1.191 0.585,0.935 1,1 ");
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.026,0.939 0.335,1.013 0.685,1.097 0.585,0.935 1,1 ");
    easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.04,0.951 0.335,1 0.684,1.057 0.614,0.964 1,1");
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.045,0.925 0.335,1 0.625,1.074 0.532,0.987 1,1");
  }

  if (scale === 0 || window.innerWidth >= 681) {
    var scaleValue = true;
  }else{
    var scaleValue = false;
  }


  
  let state = Flip.getState(element);
  windowNew.classList.toggle('active');
  Flip.from(state, {
    targets: windowNew,
    duration: 0.7,
    scale: scaleValue,
    ease: easeType,
    // ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
    // ease: CustomEase.create("easeName", ".47,.29,0,1"),
    // ease: CustomEase.create("easeName", ".58,.18,0,1"),
    // ease: CustomEase.create("easeName", ".21,.19,0,1"),
    // ease: CustomEase.create("emphasized", "0.2, 0, 0, 1"),
    // ease: CustomEase.create("classic", "0.1, 0.8, 0, 1"),
    // ease: CustomEase.create("classic", "0.4, 0.4, 0, 1.2"),
    // ease: CustomEase.create("custom", "M0,0 C0.099,0 0.133,0.915 0.325,1.044 0.642,1.257 0.64,0.938 1,1 "),
    // ease: CustomEase.create("custom", "M0,0 C0.249,-0.124 -0.003,0.896 0.325,1.044 0.653,1.191 0.585,0.935 1,1 "),
    absolute: true,
  })
    
}


function formatMoney(amount) {
  return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(amount);
}
function dateToText(date, showYear) {
  if(showYear === undefined){showYear = false}
  const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  const [year, month, day] = date.split("-");
  if(showYear){
    return `${parseInt(day)} de ${months[month - 1]} de ${year}`;
  }
  return `${parseInt(day)} de ${months[month - 1]}`;
}
function dateToPrettyDate(date, showYear) {
  if(date === "0000-00-00"){return "-";}
  if(showYear === undefined){showYear = false}
  const [year, month, day] = date.split("-");
  if(showYear){
    return `${parseInt(day)}/${month}/${year}`;
  }
  return `${parseInt(day)}/${month}`;
}
function formatTime(time){
  if(time === undefined){return;}
  if(time === "00:00:00"){return "-";}
  const [hours, minutes, seconds] = time.split(":");
  return `${hours}:${minutes}`;
}

function toggleTab(windowId, tabId, workHidden){
  const windowElement = document.getElementById(windowId);
  const currentActiveTab = windowElement.querySelector('.md-tab[active]');
  if (currentActiveTab) {currentActiveTab.removeAttribute('active');}


  if(workHidden){
    const currentActiveTabSelector = windowElement.querySelector('md-tabs [active]');
    if (currentActiveTabSelector) {currentActiveTabSelector.removeAttribute('active');}
    const objetiveTabSelector = windowElement.querySelector('[data-tab-id="'+tabId+'"]');
    objetiveTabSelector.setAttribute('active', '');
  }

  

  const objetiveTab = windowElement.querySelector('.md-tab[id="'+tabId+'"]');
  objetiveTab.setAttribute('active', '');
  
}

// function addTableRow(tableId, templateId){
//   const table = document.getElementById(tableId);
//   const template = document.getElementById(templateId);

// }
function applyAnimation(state, target){
  let timeline = Flip.from(state, {
    ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
    targets: target,
    absolute:false,
    scale:true,
    simple:true,
  })
  timeline.play();
}

function removeTableRow(row = false){
  if(!row){return;}
  const parentTable = row.closest("table");
  rowsState = Flip.getState(`#${parentTable.id} tr`);
  row.remove();
  let timeline = Flip.from(rowsState, {
      ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
      targets: `#${parentTable.id} tr`,
      absolute:false,
      scale:true,
      simple:true,
  })
  timeline.play();
  countTableRows(parentTable.id);
}

function countTableRows(tableId){
  const table = document.getElementById(tableId);
  const rowsCount = table.querySelectorAll('tr').length;
  
  if(rowsCount <= 1){
    table.querySelector("tr").remove();
    table.parentElement.querySelector(".container-info-empty-table").innerHTML = `
      <div class="content-box on-background-text align-center info-table-empty">
        <md-icon class="pretty medium">sentiment_content</md-icon>
        <span class="headline-small">No hay registros</span>
      </div>
    `;
  }
}

function setDateTime(dateParent, timeParent){
  const date = getDate();
  const time = getTime();

  const dateParentElement = document.getElementById(dateParent);
  const timeParentElement = document.getElementById(timeParent);

  if(dateParentElement){
    dateParentElement.value = `${date.year}-${date.month}-${date.day}`;
  }
  if(timeParentElement){
    timeParentElement.value = `${time.hours}:${time.minutes}`;
  }
}

function getDate(){
  const date = new Date();

  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses van de 0 a 11
  const day = String(date.getDate()).padStart(2, '0');

  const response = {
    "year": year,
    "month": month,
    "day": day,
  }
  return response;
}
function getTime(){
  const date = new Date();

  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');

  const response = {
    "hours": hours,
    "minutes": minutes,
  }
  return response;
}
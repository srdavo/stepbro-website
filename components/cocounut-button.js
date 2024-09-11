const cocounutButtonTemplate = document.createElement('template');
cocounutButtonTemplate.innerHTML = `
    <style>

        :host([open]) ::slotted(.button-area){
            display:none;
        } 
        :host([open]) ::slotted(.content-area){
            display:flex;
        }


        

        ::slotted(.content-area){
            display:none;
        }

        

        .back-area{
            display:none;
            z-index:10;
            width:100%;
            height:100%;
            inset:0;
            position:fixed;
            background:rgba(0,0,0,0.5);
        }
    </style>
    <slot>
    </slot>
    <div class="back-area">
        
    </div>
`;

class cocounutButton extends HTMLElement {
    
    constructor(){
        super();
        const shadow = this.attachShadow({mode: 'open'});
        shadow.append(cocounutButtonTemplate.content.cloneNode(true));
    }

    connectedCallback() {
        const slot = this.shadowRoot.querySelector('slot');
        slot.addEventListener('slotchange', () => {
            console.log(this.innerHTML);
        });


        
        
        // slot.addEventListener('slotchange', () => {
        //   setTimeout(() => {
        //     const assignedNodes = slot.assignedNodes({ flatten: false });
        //     const elementsInSlot = Array.from(assignedNodes).filter(node => node instanceof HTMLElement);
            
        //     // Now you can work with the elementsInSlot array
        //     elementsInSlot.forEach(element => {
        //       // Do something with each element
        //       console.log(element);
        //     });
        //   }, 0); // You can adjust the timeout delay as needed
        // });
    }

    loadSlot(slot){
        slot.addEventListener('slotchange', () => {
            console.log('slotchange');
            // const nodes = slot.assignedNodes();
            const nodes = slot;
            this.prepareOpenButton(nodes);
        });
    }

    prepareOpenButton(nodes){
        console.log(nodes)
        const openButton = nodes.querySelector('cocounut-open-button');
            
        // const openButton = nodes.find(node => node.classList && node.classList.contains('cocounut-open-button'));
        
        // if (openButton) {
        //     openButton.style.background = "red";
        // }
    }
}

customElements.define("cocounut-button", cocounutButton);
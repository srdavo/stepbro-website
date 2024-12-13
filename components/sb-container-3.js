const sbContainerWebComponentTemplate = document.createElement('template');
sbContainerWebComponentTemplate.innerHTML = `
    <div class="sb-container-main-container">
        <slot name="close"></slot>
        <slot name="open"></slot>
    </div>
    
`;

class SbContainer3 extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });
        this.shadowRoot.appendChild(sbContainerWebComponentTemplate.content.cloneNode(true));
    }

    connectedCallback() {
        this.shadowRoot.querySelector('[name="close"]').addEventListener('click', () => {
            this.toggle();
        });

        const mainContainer = this.shadowRoot.querySelector('.sb-container-main-container');
        mainContainer.className = this.getAttribute('data-container_class');
        
    }

    toggle(){
        console.log("Hola")
        if(this.hasAttribute("open")){
            this.removeAttribute("open");
        }else{
            this.setAttribute("open", "");
        }
    }
}

customElements.define('sb-container-3', SbContainer3);
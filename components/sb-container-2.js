class SbContainer2 extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });
        this.shadowRoot.innerHTML = `
            <style>
                /* Estilos opcionales para aplicar al main-container */
                :host {
                    display: block;
                }

                .content{
                    display:none
                }

                :host([open]) .content{
                    display:flex;
                }
                
            </style>


            <div class="container outline-1">
                <slot name="closed"></slot>
                <slot name="open" class="content"></slot>
            </div>
            
        `;
    }

    connectedCallback() {
        this.shadowRoot.querySelector('[name="closed"]').addEventListener('click', () => {
            this.toggle();
        });
        
    }

    toggle(){
        if(this.hasAttribute("open")){
            this.removeAttribute("open");
        }else{
            this.setAttribute("open", "");
        }
    }
}

customElements.define('sb-container-2', SbContainer2);

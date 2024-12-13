class SbContainer extends HTMLElement {
    constructor() {
      super();
  
      // Crear un shadow DOM
      this.attachShadow({ mode: "open" });
  
      // Crear la estructura del componente
      this.shadowRoot.innerHTML = `
        <style>
          :host {
            position:relative;
            display:flex;
            
          }
  
          .content {
            display: none;
            margin-top: 10px;
            animation: fadeIn 500ms cubic-bezier(.75,0,.41,-0.06) forwards;
          }
          @keyframes fadeIn {from{opacity:0}to{opacity:1;}}
          :host([open]) .content {
            display: flex;
          }
          :host([open]) .transparent {
            display: flex;
          }

          .transparent {
            display:none; 
            align-items:center;
            justify-content:center;
            z-index:10; 
            width:100%; 
            height:100%; 
            inset:0; 
            position:fixed;
            background: rgba(0,0,0,0.2);
            animation: transparentFadeIn 700ms
          }
          @keyframes transparentFadeIn {
            from{
              background: rgba(0,0,0,0.0);
            }
            to{
              background: rgba(0,0,0,0.2)
            }
          }

      

          .blur{
            animation: blurFadeIn 400ms;
          }

          @keyframes blurFadeIn {
            0%{
              filter: blur(0px);
            }
            50%{
              filter:blur(4px);
            }
            100%{
              filter: blur(0px);
            }
          }

          :host([open]) .main-container{
            max-width:1200px;
            max-height:90%;
            background:var(--md-sys-color-background);

          }

          .main-container{
            display:flex;
            position:relative;
            width:100%;height:100%;
            border-radius:24px;
            overflow:auto;
            flex-direction:column;
           
            background:transparent;
          }
          .main-container::-webkit-scrollbar{display:none !important}
          
          :host([closing]) .main-container{
            animation: mainContainerOut 700ms cubic-bezier(.75,0,.41,-0.06);
          } 

          @keyframes mainContainerOut {
            from{
              background:var(--md-sys-color-background);
            }
            to{
              background:transparent;
            }
          }

          .close-button{
            display:none;
            margin:16px;
            width:fit-content;
            border-radius:24px;
            background:var(--md-sys-color-surface-container);
            padding:6px 12px;
            font-family: 'DM Sans', sans-serif;
            border:none;
            cursor:pointer;
            transition: transform 0.3s cubic-bezier(0.38,0.49,0,1.16), max-height 0.7s cubic-bezier(0.38,0.49,0,1.16);
            animation: buttonInAnimation 700ms;
          }
          .close-button[closing]{
            display:block;
            animation: buttonOutAnimation 700ms;
            max-height:0px;
          }
          .close-button:hover{
            transform:scale(1.1);
            background:var(--md-sys-color-surface-container-high);
          }
          @keyframes buttonInAnimation {
            from{
              max-height:0px;
              padding:0px 16px;
              margin:0px 16px
            }
            to{
              max-height:29px;
              padding:6px 12px;
              margin:16px 16px;
            }
          }
          @keyframes buttonOutAnimation {
            from{
              max-height:29px;
              padding:6px 12px;
              margin:16px 16px;
              opacity:1;
            }
            to{
              max-height:0px;
              padding:0px 16px;
              margin:0px 16px;
              opacity:0;
            }
          }

          :host([open]) .close-button{ 
            display:flex;
          } 

          @keyframes window-border-radius{from{border-radius:48px}to{border-radius: 0;}}

          @media only screen and (max-width: 680px){
            :host([open]) .main-container{
              max-width:100%;
              max-height:100%;
              border-radius:0px;
              animation: window-border-radius 1000ms cubic-bezier(.56,.27,0,1);

            }
          }
        </style>

        <div class="transparent">
        </div>

        <div class="main-container">
          <button class="close-button">Cerrar</button>
          <slot name="closed" class="toggle" part="toggle"></slot>
          <slot name="open" class="content" part="content"></slot>
        </div>


      `;
    }
  
    connectedCallback() {
      let closedContent = this.shadowRoot.querySelector('[name="closed"]');
      const openContent = this.shadowRoot.querySelector('[name="open"]');
      let closeButton = this.shadowRoot.querySelector('.close-button');
      closedContent.addEventListener('click', () => {
        this.toggle();
      }, {once: true});
      closeButton.addEventListener('click', () => {
        this.toggle();
      });

      // const assignedElements = openContent.assignedElements();
      // if (assignedElements.length > 0) {
      //   const originAreaContainer = assignedElements[0].querySelector('[part=data-origin]');
      //   if (originAreaContainer) {
      //     console.log("existe");
      //   } else {
      //     console.log("no existe");
      //   }
      // } else {
      //   console.log("no assigned elements");
      // }
    }
  
    disconnectedCallback() {
      this.shadowRoot.querySelector('.toggle').removeEventListener('click', this.toggle);
      // this.shadowRoot.querySelector('.transparent .close-button').removeEventListener('click', this.toggle);
    }

    setSize(){
      const mainContainer = this.shadowRoot.querySelector('.main-container');

      const rect = mainContainer.getBoundingClientRect();
      this.style.minWidth = `${rect.width}px`;
      this.style.minHeight = `${rect.height}px`;
      this.style.maxHeight = `${rect.height}px`;

      console.log(rect);
    }
    toggle(){
      const mainContainer = this.shadowRoot.querySelector('.main-container');
      let state = Flip.getState(mainContainer);

      if(this.hasAttribute("open")){
        // let closedOrigin = this.shadowRoot.querySelector("[name='open']").assignedElements()[0].querySelector("[data-origin_element]");
        // let closedOriginContainer = this.querySelector("[slot='closed']");
        // let closedOriginState = Flip.getState(closedOrigin);
        // closedOriginContainer.appendChild(closedOrigin);
        // Flip.from(closedOriginState, {
        //   duration: 5.7,
        //   scale: true,
        //   ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
        //   simple: true,
        //   absolute: false,
        //   zIndex: 1,
        // });
        let closedOrigin = this.shadowRoot.querySelector('[name="closed"]').assignedElements()[0].querySelector("[data-origin_element]");
        let allChilds = closedOrigin.querySelectorAll("*");
        var closedOriginState = Flip.getState([closedOrigin, ...allChilds]);
        
        this.shadowRoot.querySelector('.close-button').setAttribute("closing","");
        closedOrigin.setAttribute("style", "");
        console.log(closedOriginState);
        Flip.from(closedOriginState, {
          ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
          targets: [closedOrigin, ...allChilds],
          duration: 0.7,
          absolute:true,
          scale:false,
          simple:true
        })
        
        this.setAttribute("closing","");
        this.shadowRoot.appendChild(mainContainer);
        this.removeAttribute("open");
        mainContainer.addEventListener("animationend", () => {
          this.removeAttribute("closing");
          this.shadowRoot.querySelector('.close-button').removeAttribute("closing");
        }, {once: true});
        this.shadowRoot.querySelector('[name="closed"]').addEventListener('click', () => {
          this.toggle();
        }, {once: true});

        
        
      }else{
        this.setSize();
        this.setAttribute("open","");
        this.shadowRoot.querySelector('.transparent').appendChild(this.shadowRoot.querySelector('.main-container'));

        // const closedOrigin =  this.shadowRoot.querySelector('[name="closed"]');
        let closedOrigin = this.shadowRoot.querySelector('[name="closed"]').assignedElements()[0].querySelector("[data-origin_element]");
        let allChilds = closedOrigin.querySelectorAll("*");
        if(allChilds.length == 0){
          var closedOriginState = Flip.getState(closedOrigin);
          var targets = [closedOrigin];
        }else{
          var closedOriginState = Flip.getState([closedOrigin, ...allChilds]);
          var targets = [closedOrigin, ...allChilds];
        }
        console.log(targets)
        closedOrigin.style.transition = "all 0.7s cubic-bezier(0.38,0.49,0,1)";
        closedOrigin.setAttribute("style", this.getAttribute("data-origin_element_style"))
        Flip.from(closedOriginState, {
          ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
          duration: 0.7,
          nested:true,
          absolute:false,
          scale:false,
          simple:true
        });
        

        // let originAreaContainer = this.shadowRoot.querySelector("[name='open']").assignedElements()[0].querySelector('[data-origin_area]');
        // let closedOrigin = this.shadowRoot.querySelector('[name="closed"]').assignedElements()[0].querySelector("[data-origin_element]");
        // let closedOriginState = Flip.getState(closedOrigin);
        // originAreaContainer.appendChild(closedOrigin);
        // Flip.from(closedOriginState, {
        //   targets: closedOrigin,
        //   duration: 5.7,
        //   scale: false,
        //   ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
        //   simple: true,
        //   absolute: false,
        //   zIndex: 1,
        // });
      }

      this.applyAnimation(state, mainContainer, false, true, true, 1, Flip, CustomEase);
      // Flip.from(state, {
      //   duration: 0.7,
      //   scale: false,
      //   ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
      //   toggleClass: "blur",

      //   absolute: true,
      //   zIndex: 1,
      // });
    }

    // toggle() {
    //   const mainContainer = this.shadowRoot.querySelector('.main-container');

    //   if (this.hasAttribute("open")) {
    //     this.removeAttribute("open");
    //     this.shadowRoot.appendChild(mainContainer);
    //     Flip.from(state, {
    //       duration: 0.7,
    //       scale: false,
    //       toggleClass: "blur",

    //       ease: CustomEase.create("easeName", "0.38,0.49,0,1"),

    //       absolute: true,
    //       zIndex: 1,
    //     });
    //   } else {
        
        
    //     this.setAttribute("open", "");

    //     let state = Flip.getState(mainContainer);
    //     this.shadowRoot.querySelector('.transparent').appendChild(this.shadowRoot.querySelector('.main-container'));
    //     Flip.from(state, {
    //       duration: 0.7,
    //       scale: false,
    //       ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
    //       toggleClass: "blur",

    //       absolute: true,
    //       zIndex: 1,
    //     });
    //   }
    // }

    applyAnimation(state, target, scale = true, absolute = false, customEase = false, zIndex = false, Flip, CustomEase){
      var easeToUse = CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 ")
      if(!zIndex){zIndex = 0}else{zIndex = 100}
      if(customEase){easeToUse = CustomEase.create("easeName", "0.38,0.49,0,1")}
      let timeline = Flip.from(state, {
        ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
        // ease: CustomEase.create("custom", "M0,0 C0.154,0 0.165,0.541 0.324,0.861 0.532,1.281 0.524,1 1,1 "),
        toggleClass: "blur",
        targets: target,
        duration: 0.7,
        absolute:absolute,
        scale:scale,
        zIndex:zIndex,
      })
      timeline.play();
    }
  }
  
  customElements.define('sb-container', SbContainer);
  
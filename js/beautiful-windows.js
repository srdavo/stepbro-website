function toggleBeautifulWindow(windowSelector = false){
    if(!windowSelector){
        // we asume there is a window open
        const activeTransparent = document.querySelector("transparent.active");
        if(!activeTransparent){console.error("No window to close");return false;}

        activeTransparent.setAttribute("beautiful-closing", "");
        
        const eventOriginState = Flip.getState("[data-current_origin]");
        
        Flip.to(eventOriginState, {
            targets: "window.active",
            duration: 0.7,
            ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
            absolute: true,
            onComplete: function(){
                activeTransparent.removeAttribute("beautiful-closing");
                activeTransparent.querySelector("window.active").setAttribute("style", "");
                activeTransparent.querySelector("window.active").classList.remove("active");
                document.querySelector("[data-current_origin]").removeAttribute("data-current_origin");
                // activeTransparent.querySelector("window.active").removeAttribute("beautiful-closing");
                activeTransparent.classList.remove("active");
                activeTransparent.classList.remove("fade-in-off");
            }
        })

        
        console.log("closing window");
        return true;
    }


    const desiredWindow = document.querySelector(windowSelector);
    const transparent = desiredWindow.closest("transparent");
    
    // open the window
    
    transparent.classList.add("fade-in-off");
    transparent.classList.add("active");
    eventOrigin = event.currentTarget;
    
    const clonedOriginElement = eventOrigin.cloneNode(true);
    eventOrigin.setAttribute("data-current_origin", "");
    const preparedArea = desiredWindow.querySelector("[data-prepared-area]");
    preparedArea.innerHTML = "";
    preparedArea.appendChild(clonedOriginElement);

    const state = Flip.getState(eventOrigin);
    desiredWindow.classList.toggle("active");

    Flip.from(state, {
        targets: desiredWindow,
        duration: 0.7,
        ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
        absolute: true
    })
}
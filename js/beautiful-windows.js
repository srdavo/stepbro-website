function toggleBeautifulWindow(windowSelector = false, cloneChanges = false){
    if(!windowSelector){
        // we asume there is window open
        const activeTransparent = document.querySelector("transparent.active");
        if(!activeTransparent){return;}

        const activeWindow = activeTransparent.querySelector("window.active");
        const preparedArea = activeWindow.querySelector("[data-prepared_area]");
        if(preparedArea){
            const preparedAreaFirstChild = preparedArea.firstChild;
            const preparedAreaFirstChildChildren = preparedAreaFirstChild.querySelectorAll("*");
            const activeWindowHolder = activeWindow.querySelector("holder");
            const preparedAreaFirstChildChildrenState = Flip.getState([activeWindowHolder, ...preparedAreaFirstChildChildren]);
            preparedAreaFirstChild.setAttribute("style", "");
            Flip.from(preparedAreaFirstChildChildrenState, {
                targets: [activeWindowHolder, ...preparedAreaFirstChildChildren],
                duration: 0.7,
                toggleClass: "apply-blur-animation",
                ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
            });
        }

        activeTransparent.setAttribute("closing", "");
        const eventOriginState = Flip.getState("[data-current_origin]");
        Flip.to(eventOriginState, {
            targets: "window.active",
            duration: 0.7,
            ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
            absolute: true,
            onComplete: function(){
                activeTransparent.removeAttribute("closing");
                const activeWindow = activeTransparent.querySelector("window.active");
                activeWindow.setAttribute("style", "");
                activeWindow.classList.remove("active");
                document.querySelector("[data-current_origin]").removeAttribute("data-current_origin");
                activeTransparent.classList.remove("active");
            }
        })

        return;
    }

    const desiredWindow = document.querySelector(windowSelector);
    const transparent = desiredWindow.closest("transparent");
    const eventOrigin = event.currentTarget;
    const eventOriginState = Flip.getState(eventOrigin);
    const eventOriginClone = eventOrigin.cloneNode(true);
    const preparedArea = desiredWindow.querySelector("[data-prepared_area]");

    if(preparedArea){
        preparedArea.innerHTML = "";
        preparedArea.appendChild(eventOriginClone);
        eventOriginClone.removeAttribute("onclick");
        
        if(cloneChanges){
            const eventOriginCloneChildren = Array.from(preparedArea.querySelectorAll("*")).slice(1);
            console.log(eventOriginCloneChildren);
            // const eventOriginCloneText = eventOriginClone.querySelector("[data-origin_text]");
            
            setTimeout(() => {
                const eventOriginCloneChildrenState = Flip.getState(eventOriginCloneChildren);

                eventOriginClone.style = cloneChanges.style;
                Flip.from(eventOriginCloneChildrenState, {
                    targets: eventOriginCloneChildren,
                    duration: 0.7,
                    toggleClass: "apply-blur-animation",
                    ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
                })
            }, 10); 
        }
    }

    eventOrigin.setAttribute("data-current_origin", "");
    transparent.setAttribute("data-beautiful_transparent", "");
    transparent.classList.toggle("active");
    desiredWindow.classList.add("active");
    Flip.from(eventOriginState, {
        targets: desiredWindow,
        duration: 0.7,
        ease: CustomEase.create("easeName", "0.38,0.49,0,1"),
        absolute: true,
    })
}
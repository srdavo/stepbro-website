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
async function togglePrettyWindow(windowSelector = false, sharedElements = false){
    const instanceRandomNumber = generateRandomNumberForVT();
    const viewTransitionClass = "vt-shared-element-animation";
    const viewTransitionClassChildes = "vt-shared-element-animation-childes"; 

    if(!windowSelector){

        if (!document.startViewTransition) {
            toggleWindow();
            return;
        }

        // we asume there is window open
        const desiredElement = document.querySelector("[data-shared_elements]");
        if(!desiredElement){message("Element does not exists in the document", "error");return;}
        const activeTransparent = document.querySelector("transparent.active");        
        const activeWindow = document.querySelector("window.active");

        activeWindow.style.viewTransitionName = `vt-shared-${instanceRandomNumber}`;
        activeWindow.style.viewTransitionClass = viewTransitionClass;
        
        const sharedElements = desiredElement.getAttribute("data-shared_elements").split(",") || [];
        desiredElement.removeAttribute("data-shared_elements");

        if(sharedElements.length > 1){
            sharedElements.map((element) => {
                const originElementShared = activeWindow.querySelector(`[${element}]`);
                if(!originElementShared){
                    console.error(`Element [${element}] does not exists in the origin element`);
                    return;
                }
                originElementShared.style.viewTransitionName = `vt-shared-${element}`;
                originElementShared.style.viewTransitionClass = viewTransitionClassChildes;
            })
        }
        
        const closeTransition = document.startViewTransition(() => {
            desiredElement.style.viewTransitionName = `vt-shared-${instanceRandomNumber}`;
            desiredElement.style.viewTransitionClass = viewTransitionClass;
            if(sharedElements.length > 1){
                sharedElements.map((element) => {
                    const desiredElementShared = desiredElement.querySelector(`[${element}]`);
                    if(!desiredElementShared){
                        console.error(`Element [${element}] does not exists in the desired window`);
                        return;
                    }
                    desiredElementShared.style.viewTransitionName = `vt-shared-${element}`;
                    desiredElementShared.style.viewTransitionClass = viewTransitionClassChildes;
                })
            }

            activeWindow.style.viewTransitionName = '';
            activeWindow.style.viewTransitionClass = '';

            if(sharedElements.length > 1){
                sharedElements.map((element) => {
                    const originElementShared = activeWindow.querySelector(`[${element}]`);
                    originElementShared.style.viewTransitionName = '';
                    originElementShared.style.viewTransitionClass = '';                
                })
            }
            activeTransparent.classList.remove("active");
            activeWindow.classList.remove("active");

        });
        await closeTransition.finished;

        
        desiredElement.style.viewTransitionName = '';
        desiredElement.style.viewTransitionClass = '';
        if(sharedElements.length > 1){
            sharedElements.map((element) => {
                const desiredElementShared = desiredElement.querySelector(`[${element}]`);
                desiredElementShared.style.viewTransitionName = '';
                desiredElementShared.style.viewTransitionClass = '';
            })
        }

        return;
    }

    if (!document.startViewTransition) {
        toggleWindow(windowSelector);
        return;
    }

    const desiredWindow = document.querySelector(windowSelector);
    if(!desiredWindow){message("Window does not exists in the document", "error");return;}
    const transparent = desiredWindow.closest("transparent");
    const originElement = event.currentTarget;
    originElement.setAttribute("data-shared_elements", sharedElements);
    
    desiredWindow.style.viewTransitionName = `vt-shared-${instanceRandomNumber}`;
    desiredWindow.style.viewTransitionClass = viewTransitionClass;

    originElement.style.viewTransitionName = `vt-shared-${instanceRandomNumber}`;
    originElement.style.viewTransitionClass = viewTransitionClass;
    

    if(sharedElements != false){
        sharedElements.map((element) => {
            const originElementShared = originElement.querySelector(`[${element}]`);
            if(!originElementShared){
                console.error(`Element [${element}] does not exists in the origin element`);
                return;
            }

            const desiredElementShared = desiredWindow.querySelector(`[${element}]`);
            if(!desiredElementShared){
                console.error(`Element [${element}] does not exists in the desired window`);
                return;
            }

            desiredElementShared.style.viewTransitionName = `vt-shared-${element}`;
            desiredElementShared.style.viewTransitionClass = viewTransitionClassChildes;
            originElementShared.style.viewTransitionName = `vt-shared-${element}`;
            originElementShared.style.viewTransitionClass = viewTransitionClassChildes;
        })
    }
    

    const transition = document.startViewTransition(() => {
        originElement.style.viewTransitionName = '';
        originElement.style.viewTransitionClass = '';
        if(sharedElements != false){
            sharedElements.map((element) => {
                const originElementShared = originElement.querySelector(`[${element}]`);
                originElementShared.style.viewTransitionName = '';
                originElementShared.style.viewTransitionClass = '';                
            })
        }
        transparent.classList.toggle("active");
        desiredWindow.classList.toggle("active");

    });
    await transition.finished;
    
    desiredWindow.style.viewTransitionName = '';
    desiredWindow.style.viewTransitionClass = '';

    if(sharedElements != false){
        sharedElements.map((element) => {
            const desiredElementShared = desiredWindow.querySelector(`[${element}]`);
            desiredElementShared.style.viewTransitionName = '';
            desiredElementShared.style.viewTransitionClass = '';

        })
    }
    
    
}


function generateRandomNumberForVT(){
    return Math.floor(100000 + Math.random() * 900000);
}
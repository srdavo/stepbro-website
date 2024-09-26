function changeTheme(originButton){
    if(originButton === undefined){return;}

    newTheme = originButton.getAttribute('data-theme');
    document.getElementById('theme-style').setAttribute('href', `${BASE_URL}css/theme/colors/${newTheme}.css`);

    const parent = document.getElementById("app-theme-selector-parent");
    parent.querySelector("div[active]").removeAttribute("active");
    originButton.setAttribute("active", "");

    localStorage.setItem('sb-selected-theme', newTheme);
}

function resetTheme(){
    const parent = document.getElementById("app-theme-selector-parent");
    changeTheme(parent.querySelector(`div[data-theme="black"]`));
}

function loadTheme(){
    newTheme = localStorage.getItem('sb-selected-theme') || "black";
    document.getElementById('theme-style').setAttribute('href', `${BASE_URL}css/theme/colors/${newTheme}.css`);

    document.addEventListener("DOMContentLoaded", function(event) {
        const parent = document.getElementById("app-theme-selector-parent");
        parent.querySelector("div[active]").removeAttribute("active");

        const activeButton = parent.querySelector(`div[data-theme="${newTheme}"]`);
        activeButton.setAttribute("active", "");

    }, {once:true });
}

loadTheme();
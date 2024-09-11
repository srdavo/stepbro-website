<button 
  class="nav-button hide-on-mobile bottom-margin-8" 
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <rect y="4.69629" width="14.6076" height="14.6076" rx="7.30381" fill="var(--md-sys-color-primary)"/>
    <rect x="16.5786" y="4.69629" width="7.42162" height="14.6076" rx="3.71081" fill="var(--md-sys-color-primary)"/>
  </svg>
  </span>
  <span>Cocounut</span>
</button>


<button 
  class="nav-button" active 
  data-section="section-home" 
  onclick="toggleSection('section-home')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder" >
    <span class="material-symbols-rounded">home</span>
  </span>
  <span>Inicio</span>
</button>

<button 
  class="nav-button"
  data-section="section-registers" 
  onclick="toggleSection('section-registers')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">list</span>
  </span>
  <span>Registros</span>
</button>

<button 
  class="nav-button" 
  data-section="section-groups"
  onclick="toggleSection('section-groups')"
  >
  <md-ripple></md-ripple>
  <span class="icon-holder">
    <span class="material-symbols-rounded">nutrition</span>
  </span>
  <span>Alimentos</span>
</button>
<window 
    id="window-settings"
    class="increased semi-slim on-background-text"
    data-flip-id="animate"
    >
    <div class="simple-container padding-16">
        <md-icon-button onclick="toggleWindow()"><md-icon>close</md-icon></md-icon-button>
    </div>
    <holder>
        <div class="simple-container gap-16 grow-1 w-section-holder">
            <div class="w-nav simple-container direction-column gap-4 w-nav-parent">
                <!-- <span class="body-large bottom-margin-8 on-surface-variant-text">Configuración</span> -->
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-account"
                    onclick="toggleWSection('w-section-account', this)"
                    active
                    >
                    <md-ripple></md-ripple>
                    <md-icon>account_circle</md-icon>
                    <span>Cuenta</span>
                </button>
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-appearance"
                    onclick="toggleWSection('w-section-appearance', this)"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>palette</md-icon>
                    <span>Apariencia</span>
                </button>
                <button 
                    class="w-nav-button"
                    data-w-section="w-section-information"
                    onclick="toggleWSection('w-section-information', this)"
                    >
                    <md-ripple></md-ripple>
                    <md-icon>info</md-icon>
                    <span>Información</span>
                </button>
            </div>

            <div class="w-section simple-container direction-column grow-1 gap-8" active id="w-section-account">
                <div class="simple-container direction-row justify-center">
                    <div class="simple-container padding-40 border-radius-64 surface-variant relative user-select-none">
                        <span id="response-settings-account-username-first-letter" class="display-large absolute-centered bricolage weight-600">...</span>
                    </div>
                </div>
                <div class="simple-container justify-center">
                    <span id="response-settings-account-username-title" class="body-large">...</span>
                </div>
                <div class="simple-container direction-column v-margin gap-8">
                    
                    <div class="content-box direction-row light-color padding-24 border-radius-16 justify-between">
                        <div class="simple-container"><span class="label-large">Correo</span></div>
                        <div class="simple-container"><span id="response-settings-account-email" class="body-large">...</span></div>
                    </div>
                    <div class="content-box direction-column light-color padding-24 border-radius-16 justify-between">
                        <div class="simple-container justify-between">
                            <div class="simple-container"><span class="label-large">Nombre de usuario</span></div>
                            <div class="simple-container"><span id="response-settings-account-username" class="body-large">...</span></div>
                        </div>
                        <div class="simple-container justify-right">
                            <span 
                                class="label-small data-line interactive"
                                onclick="toggleDialog('dialog-account')"
                                >
                                <md-ripple aria-hidden="true"></md-ripple>
                                Editar
                            </span>
                        </div>
                    </div>
                    <div 
                        class="content-box direction-row light-color padding-16 border-radius-16 justify-center user-select-none cursor-pointer"
                        onclick="toggleDialog('dialog-logout-confirmation')"
                        >
                        <md-ripple></md-ripple>
                        <span class="body-medium error-text">Cerrar sesión</span>
                    </div>

                </div>
            </div>
            <div class="w-section simple-container direction-column grow-1" id="w-section-appearance">
                <div class="simple-container direction-column grow-1 gap-16">
                    <div class="simple-container gpa-8 direction-column">
                        <span class="headline-medium">Apariencia</span>
                        <span class="body-large on-surface-variant-text">Modifica la apariencia de la app a un color de tu preferencia</span>
                    </div>
                    <div class="theme-selector-parent v-margin" id="app-theme-selector-parent">
                        <div 
                            class="ball" 
                            data-theme="black"
                            onclick="changeTheme(this)"
                            active 
                            >
                            <span style="background:#000000;"></span>
                            <span style="background:#122644;"></span>
                            <span style="background:#b4c7ed;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="blue"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#0045b2;"></span>
                            <span style="background:#0066ff;"></span>
                            <span style="background:#b3c5ff;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="green"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#006d34;"></span>
                            <span style="background:#5de989;"></span>
                            <span style="background:#9fffb3;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="brown"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#944b00;"></span>
                            <span style="background:#ff9947;"></span>
                            <span style="background:#ffbc8d;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="cold-blue"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#006590;"></span>
                            <span style="background:#55c0ff;"></span>
                            <span style="background:#96d3ff;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="pink"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#8900a3;"></span>
                            <span style="background:#c400e8;"></span>
                            <span style="background:#f7acff;"></span>
                            <md-ripple></md-ripple>
                        </div>
                        <div 
                            class="ball" 
                            data-theme="purple"
                            onclick="changeTheme(this)"
                            >
                            <span style="background:#5e00d0;"></span>
                            <span style="background:#853fff;"></span>
                            <span style="background:#d2bcff;"></span>
                            <md-ripple></md-ripple>
                        </div>

                    </div>
                    <div class="simple-container">
                        <div 
                            class="content-box direction-row padding-16 border-radius-16 justify-center user-select-none cursor-pointer"
                            onclick="resetTheme()"
                            >
                            <md-ripple></md-ripple>
                            <span class="body-medium">Restablecer tema</span>
                        </div>
                    </div>
                    <div class="simple-container direction-column gap-16">
                        <div class="simple-container gpa-8 direction-column">
                            <span class="headline-small">Navegación</span>
                            <span class="body-large on-surface-variant-text">Elige el estilo de navegación que más te guste </span>
                        </div>
                        <div class="simple-container nav-selector-parent" id="nav-selector-parent">
                            <div 
                                class="nav-option" 
                                data-nav-option="1"
                                onclick="changeNav(this)"
                                >
                                <md-ripple></md-ripple>
                                Clásica
                            </div>
                            <div 
                                class="nav-option"
                                data-nav-option="2"
                                onclick="changeNav(this)" 
                                active
                                >
                                <md-ripple></md-ripple>
                                Moderna
                            </div>
                            <div 
                                class="nav-option"
                                data-nav-option="3"
                                onclick="changeNav(this)"
                                >
                                <md-ripple></md-ripple>
                                Dock
                            </div>
                        </div>
                        <div class="simple-container">
                            <span class="label-large outline-text">
                                Los cambios solo se verán reflejados dentro de una Stepbro App
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="w-section simple-container grow-1 w-section-holder" id="w-section-information">
                <div class="simple-container w-nav w-nav-parent direction-column">
                    <button 
                        class="w-nav-button"
                        data-w-section="w-section-test"
                        onclick="toggleWSection('w-section-test', this)"
                        
                        >
                        <md-ripple></md-ripple>
                        <md-icon>folder</md-icon>
                        <span>test</span>
                    </button>
                    <button 
                        class="w-nav-button"
                        data-w-section="w-section-test-2"
                        onclick="toggleWSection('w-section-test-2', this)"
                        >
                        <md-ripple></md-ripple>
                        <md-icon>folder</md-icon>
                        <span>test 2</span>
                    </button>
                </div>
                <div class="simple-container w-section" id="w-section-test" >
                    Tests
                </div>
                <div class="simple-container w-section" id="w-section-test-2" >
                    <div class="simple-container w-nav w-nav-parent direction-column">
                        <button 
                            class="w-nav-button"
                            data-w-section="w-section-test-3"
                            onclick="toggleWSection('w-section-test-3', this)"
                            
                            >
                            <md-ripple></md-ripple>
                            <md-icon>folder</md-icon>
                            <span>test 3</span>
                        </button>
                        <button 
                            class="w-nav-button"
                            data-w-section="w-section-test-4"
                            onclick="toggleWSection('w-section-test-4', this)"
                            >
                            <md-ripple></md-ripple>
                            <md-icon>folder</md-icon>
                            <span>test 4</span>
                        </button>
                    </div>
                    <div class="simple-container w-section" id="w-section-test-3" >
                        Tests 3
                    </div>
                    <div class="simple-container w-section" id="w-section-test-4" >
                        Tests 4 
                    </div>
                </div>
            </div>
        </div>
    
    </holder>

</window>

<md-dialog id="dialog-account" style="min-width: calc(-1600px + 100vw)">
  <div slot="headline">Cuenta</div>
  <form id="form-dialog-account" slot="content" method="dialog">
    <md-list style="border-radius:16px;">
      <md-list-item>
        <md-icon slot="start">tag</md-icon>
        <div slot="headline" id="response-account-id">...</div>
      </md-list-item>
      <md-list-item>
        <md-icon slot="start">mail</md-icon>
        <div slot="headline" id="response-account-email">...</div>
      </md-list-item>
    </md-list>
    <div class="simple-container direction-column gap-8 v-margin">

      <md-outlined-text-field 
        id="modify-account-username"
        label="Nombre de usuario" 
        role="presentation"
        style="margin-top:8px;"
        >
      </md-outlined-text-field>
    </div>
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-account" value="cancel">Cancelar</md-text-button>
    <md-filled-tonal-button form="form-dialog-account" onclick="modifyUserData()" value="save">Guardar</md-filled-tonal-button>
  </div>
</md-dialog>

<md-dialog id="dialog-logout-confirmation">
  <div slot="headline">Cerrar sesión</div>
  <md-icon slot="icon" aria-hidden="true">logout</md-icon>
  <form id="form-dialog-logout-confirmation" slot="content" method="dialog">
    ¿Estas seguro de que quieres cerrar sesión?
  </form>
  <div slot="actions">
    <md-text-button form="form-dialog-logout-confirmation" value="cancel">Cancelar</md-text-button>
    <md-filled-tonal-button value="save" onclick="logOut()">Cerrar sesión</md-filled-tonal-button>
  </div>
</md-dialog>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        // getUserData();
        syncUserData();
    });
</script>
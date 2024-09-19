async function signUp(){
  const parent = "#parent-signup";
  if(!checkEmpty(parent, "input")) { return; }

  const userInput = document.getElementById("input-signup-user");
  const pwdInput = document.getElementById("input-signup-password");
  const pwdRepeatInput = document.getElementById("input-signup-password_repeat");

  if(pwdInput.value != pwdRepeatInput.value) {
    pwdInput.setAttribute("error", "");
    pwdRepeatInput.setAttribute("error", "");
    // message("Las contraseñas no son iguales", "error");
    return;
  }

  pwdInput.removeAttribute("error");
  pwdRepeatInput.removeAttribute("error");

  const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!regex.test(userInput.value)) {
    message("El correo no es valido", "error");
    userInput.setAttribute("error", "");
    return false;
  }

  pwdInput.removeAttribute("error");
  pwdRepeatInput.removeAttribute("error");

  toggleButton(parent, true);

  const data = {
    op: "signup",
    email: userInput.value,
    pwd: pwdInput.value,
  };
  const url = `${BASE_URL}controllers/users.controller.php`;
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    switch (result) {
      case "user_already_exists":
        message("El usuario ya existe", "error");
        userInput.setAttribute("error", "");
        break;
      case "access_accepted":
        window.location.href='home';
        break;
      default:
        message("Hubo un error", "error");
    }
    toggleButton(parent, false);

  } else {
    console.error('Error al registrarse:', response.statusText);
  }
}

async function logIn(){
  const parent = "#parent-login";
  if(!checkEmpty(parent, "input")) { return; }
  toggleButton(parent, true);

  const userInput = document.getElementById("input-login-user");
  const pwdInput = document.getElementById("input-login-password");

  const data = {
    op: "login",
    user: userInput.value,
    pwd: pwdInput.value,
  };
  const url = `${BASE_URL}controllers/users.controller.php`;
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    switch (result) {
      case "user_doesnt_exist": 
        message("El usuario no existe", "error"); 
        userInput.setAttribute("error", ""); 
        break;
      case "wrong_password": 
        message("Usuario o contraseña incorrectos", "error"); 
        userInput.setAttribute("error", "");
        pwdInput.setAttribute("error", "");
        break;
      case "access_accepted":
        window.location.href='index';
        break;
    }
    toggleButton(parent, false);

  } else {
    console.error('Error al iniciar sesión:', response.statusText);
  }
}

async function logOut(){
  const data = {
    op: "logout",
  };
  const url = `${BASE_URL}controllers/users.controller.php`;
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    if (result) { window.location.href='home';}
  } else {
    console.error('Error al cerrar sesión:', response.statusText);
  }
}

async function modifyUserData(){
  const parent = "#dialog-logout-confirmation"
  if(!checkEmpty(parent, "input")) { return; }
  toggleButton(parent, true)

  const username = document.getElementById("modify-account-username")
  const data = {
    op: "modifyUserData",
    name: username.value,
  };
  const url = `${BASE_URL}controllers/users.controller.php`;
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    toggleButton(parent, false);

    if(!result){
      message("Hubo un error", "error");
      return false;
    }
    if(result === "user_already_exists"){
      message("Nombre de usuario ya en uso", "error");
      username.setAttribute("error", "");
      return false;
    }
    message("Datos modificados", "success");
    toggleWindow();
  }
}

async function getUserData(){
  const data = {
    op: "getUserData",
  };
  const url = `${BASE_URL}controllers/users.controller.php`;
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    if(!result){
      message("Hubo un error", "error");
      return false;
    }
    
    var id = result.id;
    var name = result.name;
    var email = result.email;

    document.getElementById("response-account-id").textContent = id;
    document.getElementById("response-account-email").textContent = email;
    document.getElementById("modify-account-username").value = name;
  }
}
function loadUserLoginForm() {
  let input_ID = createInput("ID", "text", "Reader_ID");
  let input_pwd = createInput("Password", "password", "Password");
  let submitBtn = createSubmitButton("Send");
  let wholeForm = input_ID + input_pwd + submitBtn;
  let loginForm = document.getElementById("loginForm");
  if (loginForm == null) {
    console.log("form not found");
  } else {
    loginForm.innerHTML = wholeForm;
  }
}
function loadRegisterForm() {
  let input_ID = createInput("ID", "text", "Reader_ID");
  let input_name = createInput("Name", "text", "Name");
  let input_pwd_1 = createInput("Password", "password", "Password1");
  let input_pwd_2 = createInput("check Password", "password", "Password2");
  let submitBtn = createSubmitButton("Send");
  let wholeForm = input_ID + input_name + input_pwd_1 + input_pwd_2 + submitBtn;
  let loginForm = document.getElementById("registerForm");
  if (loginForm == null) {
    console.log("form not found");
  } else {
    loginForm.innerHTML = wholeForm;
  }
}
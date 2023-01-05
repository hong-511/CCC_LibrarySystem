function loadPwdForm() {
  //createInput(label, inputType, inputName)
  let input_id = createInput("ID", "text", "Reader_ID");
  let input_name = createInput("Name", "text", "UserName");
  let input_newPwd = createInput("NewPassword", "password", "NewPassword");
  let input_checkPwd = createInput(
    "check NewPassword",
    "password",
    "checkedNewPassword"
  );
  let submitButton = createSubmitButton("Modify");

  let wholeForm =
    input_id + input_name + input_newPwd + input_checkPwd + submitButton;

  let pwdEditForm = document.getElementById("pwdEditForm");
  pwdEditForm.innerHTML = wholeForm;
}

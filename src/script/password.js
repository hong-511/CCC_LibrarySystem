function loadPwdForm() {
  let formHeadTag = `<form id="pwdEditForm">`;
  //createInput(label, inputType, inputName)
  let input_id = createInput("ID", "text", "Reader_ID");
  let input_name = createInput("Name", "text", "UserName");
  let input_newPwd = createInput("NewPassword", "password", "NewPassword");
  let input_checkPwd = createInput(
    "check NewPassword",
    "password",
    "checkedNewPassword"
  );
  let formTailTag = "</form>";
  let submitBtnHTML = `<button class="btn btn-info" onclick="editPwd()">Modify</button>`;
  let submitButton = centerElement(submitBtnHTML);

  let wholeForm =
    formHeadTag +
    input_id +
    input_name +
    input_newPwd +
    input_checkPwd +
    formTailTag +
    submitButton;

  let formBlock = document.getElementById("formBlock");
  formBlock.innerHTML = wholeForm;
}

function editPwd() {
  var form = document.getElementById("pwdEditForm");
  var data = new FormData(form);
  if (!form) {
    console.log("pwdEditForm not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/modifyPassword.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      alert(response);
      if(response == "edit succeed"){
        location.replace("/user/loginPage.php");
      }
    }
  };
}

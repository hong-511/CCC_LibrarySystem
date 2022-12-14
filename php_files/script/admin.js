function loadAdminLoginForm() {
  let input_ID = createInput("ID", "text", "id");
  let input_pwd = createInput("Password", "password", "password");
  let submitBtn = createSubmitButton("Send");
  let wholeForm = input_ID + input_pwd + submitBtn;
  let loginForm = document.getElementById("loginForm");
  if (loginForm == null) {
    console.log("form not found");
  } else {
    loginForm.innerHTML = wholeForm;
  }
}
function loadSearchForm(action) {
  let formBlock = document.getElementById("formBlock");
  let formHeadTag =
      "<form  action=/admin/process/db_" + action + ".php method='post'>";
  let formContent ="";
  let submitBtn = createSubmitButton(action);
  let formTailTag = "</form>";
  if(action == "search" || action =="insert" || action == "update"){
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    let input_BookName = createInput("BookName", "text", "BookName");
    let input_Author = createInput("Author", "text", "Author");
    let input_Status = create_Status_Dropdown();
    let input_Year = create_Year_Dropdown(2009, 2023);
    let input_price = createInput("Price", "text", "Price");
    
    formContent = input_Book_ID + input_BookName + input_Author + input_Status + input_Year + input_price + submitBtn;
    let formTailTag = "</form>";
    let wholeForm = formHeadTag + formContent + formTailTag;
    if (formBlock == null) {
      console.log("form not found");
    } else {
      formBlock.innerHTML = wholeForm;
    }
  }
  else if(action == "delete"){
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    formContent = input_Book_ID + submitBtn;
    formBlock.innerHTML = formHeadTag + formContent + formTailTag;
  }
}
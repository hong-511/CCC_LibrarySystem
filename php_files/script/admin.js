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
function loadCRUDForm(action) {
  let formBlock = document.getElementById("formBlock");
  
  let formHeadTag =
       "<form id='" + action + "-form'>";
  let formContent ="";
  let formTailTag = "</form>";
  let submitBtn_text = `<button class="btn btn-primary" onclick="CRUD('`+action+`')" >`+action+"</button>";
  let submitBtn = centerElement(submitBtn_text);
  let resultBlock = "<div id='result'></div>";
  if(action == "search" || action =="insert" || action == "update"){
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    let input_BookName = createInput("BookName", "text", "BookName");
    let input_Author = createInput("Author", "text", "Author");
    let input_Status = create_Status_Dropdown();
    let input_Year = create_Year_Dropdown(2009, 2023);
    let input_price = createInput("Price", "text", "Price");
    
    formContent = input_Book_ID + input_BookName + input_Author + input_Status + input_Year + input_price ;
    let formTailTag = "</form>";
    
    let wholeForm = formHeadTag + formContent + formTailTag + submitBtn + resultBlock;
    if (formBlock == null) {
      console.log("form not found");
    } else {
      formBlock.innerHTML = wholeForm;
    }
  }
  else if(action == "delete"){
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    formContent = input_Book_ID ;
    formBlock.innerHTML = formHeadTag + formContent + formTailTag + submitBtn + resultBlock;
  }
}
function CRUD(action){
  var form = document.getElementById(action +'-form');
  var data = new FormData(form);
  if(form){
    console.log(form.elements);
  }
  else{
    console.log(action +'-form not found');
  }
  //console.log("html form: "+form.elements['BookName'].value);

  var xhr = new XMLHttpRequest();
  xhr.open('POST','/admin/process/db_'+action+'.php');

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function() {
      if (xhr.readyState == XMLHttpRequest.DONE) {
          //reset form after AJAX success.
          form.reset(); 
          let respone=this.responseText;
          document.getElementById("result").innerHTML=respone;
      }
  }

}
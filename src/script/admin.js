function adminPageInitialize() {
  setPageNumberTo1();
}
function setPageNumberTo1() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/session/resetPageNumber.php");

  //send the form data
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response != "page number set") {
        alert(response);
      }
    }
  };
}
function loadAdminLoginForm() {
  let formHeadTag = `<form  action=login.php method="post"  id="loginForm">`;
  let input_ID = createInput("ID", "text", "id");
  let input_pwd = createInput("Password", "password", "password");
  let formTailTag = "</form>";
  let loginBTNHTML = `<button class="btn btn-warning" onclick="login()">login</button>`;
  let loginBtn = centerElement(loginBTNHTML);
  let wholeForm = formHeadTag + input_ID + input_pwd + formTailTag + loginBtn;
  let adminLoginFormBlock = document.getElementById("adminLoginFormBlock");
  if (adminLoginFormBlock == null) {
    console.log("form not found");
  } else {
    adminLoginFormBlock.innerHTML = wholeForm;
  }
}
function loadCRUDForm(action) {
  let formBlock = document.getElementById("formBlock");

  let formHeadTag = "<form id='" + action + "-form'>";
  let formContent = "";
  let formTailTag = "</form>";
  let submitBtn_text =
    `<button class="btn btn-primary" onclick="CRUD('` +
    action +
    `')" >` +
    action +
    "</button>";
  let submitBtn = centerElement(submitBtn_text);
  if (action == "search" || action == "insert" || action == "update") {
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    let input_BookName = createInput("BookName", "text", "BookName");
    let input_Author = createInput("Author", "text", "Author");
    let input_Status = create_Status_Dropdown();
    let input_Year = create_Year_Dropdown(2009, 2023);
    let input_price = createInput("Price", "text", "Price");

    formContent =
      input_Book_ID +
      input_BookName +
      input_Author +
      input_Status +
      input_Year +
      input_price;
    let formTailTag = "</form>";

    let wholeForm = formHeadTag + formContent + formTailTag + submitBtn;
    if (formBlock == null) {
      console.log("form not found");
    } else {
      formBlock.innerHTML = wholeForm;
    }
  } else if (action == "delete") {
    let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
    formContent = input_Book_ID;
    formBlock.innerHTML = formHeadTag + formContent + formTailTag + submitBtn;
  }
}
function CRUD(action) {
  var form = document.getElementById(action + "-form");
  var data = new FormData(form);
  if (!form) {
    console.log(action + "-form not found");
  }

  var xhr = new XMLHttpRequest();
  let processer = "";
  if (action == "search") {
    processer = "/admin/process/searchBook.php";
  } else if (action == "update") {
    processer = "/admin/process/updateBook.php";
  } else if (action == "insert") {
    processer = "/admin/process/insertBook.php";
  } else if (action == "delete") {
    processer = "/admin/process/deleteBook.php";
  }
  xhr.open("POST", processer);

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      //reset form after AJAX success.
      //form.reset();
      let response = this.responseText;
      document.getElementById("result").innerHTML = centerForm(response);
      if (action == "search") {
        paging();
      }
    }
  };
}

function searchBook() {
  CRUD("search");
}

function login() {
  var form = document.getElementById("loginForm");
  var data = new FormData(form);
  if (!form) {
    console.log("login form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/login.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "login succeed") {
        form.reset();
        location.replace("/admin/mainPage.php");
      } else {
        alert(response);
      }
    }
  };
}

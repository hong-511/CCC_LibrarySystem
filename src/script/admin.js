function adminPageInitialize() {
  setPageNumberTo1();
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

function clearResult() {
  document.getElementById("result").innerHTML = "";
}

function setConditionsNull(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/session/setConditionsNull.php");

  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "Conditions null") {
        searchBook();
      } else {
        triggerModal("Error", response);
      }
    }
  };
}

function loadSearchForm() {
  setConditionsNull();
  let formBlock = document.getElementById("formBlock");
  let formHeadTag = `<form id="searchForm">`;
  let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
  let input_BookName = createInput("BookName", "text", "BookName");
  let input_Author = createInput("Author", "text", "Author");
  let input_Status = create_Status_Dropdown();
  let currentYear = new Date().getFullYear();
  let input_Year = create_Year_Dropdown(2009, currentYear);
  let input_price = createInput("Price", "text", "Price");
  let formContent =
    input_Book_ID +
    input_BookName +
    input_Author +
    input_Status +
    input_Year +
    input_price;
  let formTailTag = "</form>";
  let searchBtnHTML = `<button class="btn btn-primary" onclick="setBookConditionsInSession()" >search</button>`;
  let searchBtn = centerElement(searchBtnHTML);
  let wholeForm = formHeadTag + formContent + formTailTag + searchBtn;
  if (formBlock == null) {
    console.log("form block not found");
  } else {
    formBlock.innerHTML = wholeForm;
  }
  clearResult();
}

function setBookConditionsInSession(){
  setPageNumberTo1();
  var form = document.getElementById("searchForm");
  var data = new FormData(form);
  if (!form) {
    console.log("searchForm not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/session/setBookConditions.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "Book Conditions set") {
        searchBook();
      } else {
        triggerModal("Error", response);
      }
    }
  };
}

function searchBook() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/searchBook.php");

  //send the form data
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "No result") {
        triggerModal("Server respond", response);
      } else {
        document.getElementById("result").innerHTML = centerForm(response);
        paging();
      }
    }
  };
}

function loadInsertForm() {
  let formHeadTag = `<form id="insertForm">`;
  let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
  let input_BookName = createInput("BookName", "text", "BookName");
  let input_Author = createInput("Author", "text", "Author");
  let input_Status = create_Status_Dropdown();
  let currentYear = new Date().getFullYear();
  let input_Year = create_Year_Dropdown(2009, currentYear);
  let input_price = createInput("Price", "text", "Price");
  let formContent =
    input_Book_ID +
    input_BookName +
    input_Author +
    input_Status +
    input_Year +
    input_price;
  let formTailTag = "</form>";
  let insertBtnHTML = `<button class="btn btn-primary" onclick="insertNewBook()" >insert</button>`;
  let insertBtn = centerElement(insertBtnHTML);
  let wholeForm = formHeadTag + formContent + formTailTag + insertBtn;

  let formBlock = document.getElementById("formBlock");
  if (formBlock == null) {
    console.log("form block not found");
  } else {
    formBlock.innerHTML = wholeForm;
  }
  clearResult();
}

function insertNewBook() {
  var form = document.getElementById("insertForm");
  var data = new FormData(form);
  if (!form) {
    console.log("insertForm not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/insertNewBook.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "insert succeed") {
        triggerModal("Succeed", response);
        form.reset();
      }
      else{
        triggerModal("Error", response);
      }
    }
  };
}


function loadUpdateForm() {
  let formBlock = document.getElementById("formBlock");
  let formHeadTag = `<form id="updateForm">`;
  let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
  let input_BookName = createInput("BookName", "text", "BookName");
  let input_Author = createInput("Author", "text", "Author");
  let input_Status = create_Status_Dropdown();
  let currentYear = new Date().getFullYear();
  let input_Year = create_Year_Dropdown(2009, currentYear);
  let input_price = createInput("Price", "text", "Price");
  let formContent =
    input_Book_ID +
    input_BookName +
    input_Author +
    input_Status +
    input_Year +
    input_price;
  let formTailTag = "</form>";
  let updateBtnHTML = `<button class="btn btn-primary" onclick="updateBook()" >update</button>`;
  let updateBtn = centerElement(updateBtnHTML);
  let wholeForm = formHeadTag + formContent + formTailTag + updateBtn;
  if (formBlock == null) {
    console.log("form block not found");
  } else {
    formBlock.innerHTML = wholeForm;
  }
  clearResult();
}

function updateBook() {
  var form = document.getElementById("updateForm");
  var data = new FormData(form);
  if (!form) {
    console.log("updateForm not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/updateBook.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "update succeed") {
        triggerModal("Succeed", response);
        form.reset();
      }
      else{
        triggerModal("Error", response);
      }
    }
  };
}

function loadDeleteForm() {
  let formHeadTag = `<form id="deleteForm">`;
  let formContent = "";
  let input_Book_ID = createInput("Book_ID", "text", "Book_ID");
  formContent = input_Book_ID;
  let formTailTag = "</form>";
  let deleteBtnHTML = `<button class="btn btn-primary" onclick="deleteBook()" >delete</button>`;
  let deleteBtn = centerElement(deleteBtnHTML);
  let formBlock = document.getElementById("formBlock");
  if (formBlock == null) {
    console.log("form block not found");
  } else {
    formBlock.innerHTML = formHeadTag + formContent + formTailTag + deleteBtn;
  }
  clearResult();
}

function deleteBook() {
  var form = document.getElementById("deleteForm");
  var data = new FormData(form);
  if (!form) {
    console.log("deleteform not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/admin/process/deleteBook.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;    
      if (response == "delete succeed") {
        triggerModal("Succeed", response);
        form.reset();
      }
      else{
        triggerModal("Error", response);
      }
    }
  };
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
        triggerModal("Error", response);
      }
    }
  };
}

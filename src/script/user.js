function checkLoginStatus() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/session/getReaderID.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "not logged in") {
        loadUserLoginForm();
      } else if (response == "logged in") {
        location.replace("/user/userPage.php");
      }
    }
  };
}
function loadUserLoginForm() {
  let formHeadTag = `<form  id="loginForm">`;
  let input_ID = createInput("ID", "text", "Reader_ID");
  let input_pwd = createInput("Password", "password", "Password");
  let formTailTag = "</form>";
  let loginBtnHTML = `<button class="btn btn-warning" onclick="login()">login</button>`;
  let loginBtn = centerElement(loginBtnHTML);
  let wholeForm = formHeadTag + input_ID + input_pwd + formTailTag + loginBtn;
  let userLoginFormBlock = document.getElementById("userLoginFormBlock");
  if (userLoginFormBlock == null) {
    console.log("form not found");
  } else {
    userLoginFormBlock.innerHTML = wholeForm;
  }
}

function login() {
  var form = document.getElementById("loginForm");
  var data = new FormData(form);
  if (!form) {
    console.log("login form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/login.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "login succeed") {
        form.reset();
        location.replace("/user/userPage.php");
      }
      else{
        alert(response);
      }
    }
  };
}

function getNextReaderID() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/register/nextReaderID.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      let input_id = document.getElementById("Reader_ID");
      input_id.setAttribute("value", response);
    }
  };
}

function loadRegisterForm() {
  let formHeadTag = "<form  id='registerForm'>";
  let input_ID = createReadonlyInput("ID", "text", "Reader_ID", "fetching...");
  let input_name = createInput("Name", "text", "Name");
  let input_email = createInput("email", "text", "email");
  let input_phone = createInput("phone", "text", "phone");
  let input_pwd_1 = createInput("Password", "password", "Password1");
  let input_pwd_2 = createInput("check Password", "password", "Password2");
  let formTailTag = "</form>";

  let btnHTML = `<button class="btn btn-warning" onclick="registerUser()">Send</button>`;
  let submitBtn = centerElement(btnHTML);
  let wholeForm =
    formHeadTag +
    input_ID +
    input_name +
    input_email +
    input_phone +
    input_pwd_1 +
    input_pwd_2 +
    formTailTag +
    submitBtn;
  let registerFormBlock = document.getElementById("registerFormBlock");
  if (registerFormBlock == null) {
    console.log("form not found");
  } else {
    registerFormBlock.innerHTML = wholeForm;
  }
  getNextReaderID();
}

function registerUser() {
  var form = document.getElementById("registerForm");
  var data = new FormData(form);
  if (!form) {
    console.log("register form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/register/addReader.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      alert(response);
      if (response == "Register succeed") {
        form.reset();
        location.replace("/user/loginPage.php");
      }
    }
  };
}

function loadSearchForm() {
  let formHeadTag = "<form id='search-form'>";
  let input_BookID = createInput("Book_ID", "text", "Book_ID");
  let input_BookName = createInput("BookName", "text", "BookName");
  let input_Author = createInput("Author", "text", "Author");
  let formTailTag = "</form>";
  let searchButton = centerElement(
    `<button class="btn btn-info" onclick="setSearchMode('with_data')">Search</button>`
  );
  let borrowButton = alignLeftElement(
    `<button class="btn btn-warning" onclick="borrowBook()">Borrow</button>`
  );
  let wholeForm =
    formHeadTag +
    input_BookID +
    input_BookName +
    input_Author +
    formTailTag +
    searchButton +
    borrowButton;

  let formBlock = document.getElementById("formBlock");
  if (formBlock == null) {
    console.log("form not found");
  } else {
    formBlock.innerHTML = wholeForm;
  }
}

function initialize() {
  setDefaultSession("set");
  displayReaderName();
}

function displayReaderName() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/getReaderName.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response != "User not found") {
        document.getElementById("username").innerHTML = response;
      } else {
        alert("user unfound");
      }
    }
  };
}

function logout() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/session/resetReaderID.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "reset succeed") {
        location.replace("/user/loginPage.php");
      } else {
        alert("logout failed");
      }
    }
  };
}

let sessionSet;

function setDefaultSession(action) {
  //(action == set) is for initailize
  //(action == search) includes set session and does the search
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/session/setDefault.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "set default finished") {
        sessionSet = true;
        if (action == "search") {
          searchBook();
        }
      }
    }
  };
}

function setInputSession() {
  var form = document.getElementById("search-form");
  var data = new FormData(form);
  if (!form) {
    console.log("search-form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/session/setInput.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "set input finished") {
        sessionSet = true;
        searchBook();
      }
    }
  };
}
//setSearchMode
function activateSearch() {
  loadSearchForm();
  setSearchMode("default");
}

//set session
function setSearchMode(status) {
  sessionSet = false;
  if (status == "default") {
    setDefaultSession("search");
  } else if (status == "with_data") {
    setInputSession();
  }
}
// search with the data stored in session
function searchBook() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/searchBook.php");

  //send the form data
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      //reset form after AJAX success.
      //form.reset();
      let response = this.responseText;
      document.getElementById("result").innerHTML = centerForm(response);
      paging();
    }
  };
}

function borrowBook() {
  var form = document.getElementById("borrowed");
  var data = new FormData(form);
  if (!form) {
    console.log("borrowed form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/borrowBook.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      //reset form after AJAX success.
      form.reset();
      let response = this.responseText;
      if (response == "Borrowing is successful") {
        alert("borrow success");
        searchBook();
      }
    }
  };
}

function displayBorrowedBooks() {
  document.getElementById("formBlock").innerHTML = "";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/getBorrowedBooks.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let returnBtnHTML = `<button class="btn btn-warning" onclick="returnBooks()">Return</button>`;
      let returnButton = alignLeftElement(returnBtnHTML);
      let response = this.responseText;
      document.getElementById("result").innerHTML =
        returnButton + centerForm(response);
    }
  };
}

function returnBooks() {
  var form = document.getElementById("return");
  var data = new FormData(form);
  if (!form) {
    console.log("return form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/returnBooks.php");

  //parameter is empty because there is no form
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "Returning is successful") {
        alert("returning succeed");
        displayBorrowedBooks();
      }
    }
  };
}

function displayActivityHistory() {
  document.getElementById("formBlock").innerHTML = "";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/user/process/history.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      document.getElementById("result").innerHTML = response;
    }
  };
}

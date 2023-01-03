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

function loadSearchForm() {
  console.log("load Search Form");
  let formHeadTag = "<form id='search-form'>";
  let input_BookID = createInput("Book_ID", "text", "Book_ID");
  let input_BookName = createInput("BookName", "text", "BookName");
  let input_Author = createInput("Author", "text", "Author");
  let formTailTag = "</form>";
  let searchButton = centerElement(
    `<button class="btn btn-info" onclick="searchBook_1('with_data')">Search</button>`
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
}
let sessionSet;

function setDefaultSession(action) {
  //(action == set) is for initailize
  //(action == search) includes set session and does the search
  console.log("session default");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/session_setDefault.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      console.log(response);
      if (response == "set default finished") {
        sessionSet = true;
        if (action == "search") {
          searchBook_2();
        }
      }
    }
  };
}

function setInputSession() {
  var form = document.getElementById("search-form");
  var data = new FormData(form);
  if (form) {
    console.log(form.elements);
  } else {
    console.log("search-form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/session_setInput.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      console.log(response);
      if (response == "set input finished") {
        sessionSet = true;
        searchBook_2();
      }
    }
  };
}

function activateSearch() {
  console.log("activate search");
  loadSearchForm();
  searchBook_1("default");
}

//set session
function searchBook_1(status) {
  console.log("search: " + status);
  sessionSet = false;
  if (status == "default") {
    setDefaultSession("search");
  } else if (status == "with_data") {
    setInputSession();
  }
}
// do the actual search
function searchBook_2() {
  console.log("in s2 " + sessionSet);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/searchBook.php");

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
  console.log("borrow Book");
  var form = document.getElementById("borrowed");
  var data = new FormData(form);
  if (form) {
    console.log(form.elements);
  } else {
    console.log("borrowed form not found");
  }
  //console.log("html form: "+form.elements['BookName'].value);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/borrowBook.php");

  //send the form data
  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      //reset form after AJAX success.
      form.reset();
      let response = this.responseText;
      console.log("borrow response: " + response);
      if (response == "Borrowing is successful") {
        alert("borrow success");
        searchBook_2();
      }
    }
  };
}
function paging() {
  paging_setBlock();
  paging_setPageNumber();
}
function paging_setBlock() {
  let pagingBlock = `<ul class="pagination justify-content-center">
    <li class="page-item">
      <button class="page-link" aria-label="Previous" onclick="previousPage()">
        <span aria-hidden="true">&laquo;</span>
      </button>
    </li>
    <li class="page-item"><button class="page-link" id="currentPage"></button></li>
    <li class="page-item">
      <button class="page-link" aria-label="Next" onclick="nextPage()">
        <span aria-hidden="true">&raquo;</span>
      </button>
    </li>
  </ul>`;
  document.getElementById("pagination").innerHTML = pagingBlock;
}

function paging_setPageNumber() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/session_pageNumber.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let pageNumber = this.responseText;
      //console.log("pageNumber: " + pageNumber);
      document.getElementById("currentPage").innerHTML = pageNumber;
    }
  };
}

function nextPage() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/session_nextPage.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      console.log(response);
      if (response == "next Page success") {
        searchBook_1("with_data");
      }
    }
  };
}

function previousPage() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/session_previousPage.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      console.log(response);
      if (response == "previous Page success") {
        searchBook_1("with_data");
      }
    }
  };
}

function displayBorrowedBooks() {
  document.getElementById("formBlock").innerHTML = "";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/getBorrowedBooks.php");

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
  if (form) {
    console.log(form.elements);
  } else {
    console.log("return form not found");
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/signIn/user_process/returnBooks.php");

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

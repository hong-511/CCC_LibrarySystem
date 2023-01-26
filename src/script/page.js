function paging() {
  setBlock();
  displayPageNumber();
}
function setBlock() {
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

function displayPageNumber() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/sharedProcess/session/pageNumber.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let pageNumber = this.responseText;
      document.getElementById("currentPage").innerHTML = pageNumber;
    }
  };
}

function nextPage() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/sharedProcess/session/nextPage.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      
      if(response == "next Page success") {
        searchBook();
      }
      else{
        triggerModal("Warning", response);
      }
    }
  };
}

function previousPage() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/sharedProcess/session/previousPage.php");

  //parameter is empty because there is no form
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response == "previous Page success") {
        searchBook();
      }
    }
  };
}

function setPageNumberTo1() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/sharedProcess/session/resetPageNumber.php");

  //send the form data
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      let response = this.responseText;
      if (response != "page number set") {
        triggerModal("Error", response);
      }
    }
  };
}
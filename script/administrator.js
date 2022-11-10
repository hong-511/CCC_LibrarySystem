class Book{
    constructor(name, author, price, year, status){
        this.name=name;
        this.author=author;
        this.price=price;
        this.year=year;
        this.status='onShelf';
    }
}
//the element used to display the select functionality
let displayBlock=document.getElementById("displayBlock");

//PHP for add book
let addBookPHPFileName="/action_page.php";
//click the button to show the form to add book
let displayAddBookFormButton=document.getElementById("displayAddBookFormButton");
displayAddBookFormButton.addEventListener("click",displayAddBookForm);
function displayAddBookForm(){
    displayBlock.innerHTML=
        `<form action="`+addBookPHPFileName+`">
            <label for="bookName">書名:</label>
            <input type="text" id="bookName" name="bookName" placeholder="請輸入書名" size="40">
            <br>
            <label for="author">作者:</label>
            <input type="text" id="author" name="author" placeholder="請輸入作者" size="40">
            <br>
            <label for="bookYear">年分:</label>
            <select id="bookYear" name="bookYear"></select>
            <br>
            <label for="bookYear">價錢:</label>
            <select id="bookYear" name="bookYear"></select>
            <br>
            <input class="btn btn-primary" type="submit" value="新增">
        </form>`;
}





let displayReaderInformationButton=document.getElementById("displayReaderInformationButton");
displayReaderInformationButton.addEventListener("click",displayReader);
function displayReader(){
    alert("waiting php to display reader information");
}
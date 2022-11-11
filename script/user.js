let maxYear=2022;
let minYear=1980;
let dropdownList=document.getElementById("bookYear");

let newOption=document.createElement("option");
    newOption.setAttribute("value",null);
    newOption.innerHTML= '';
    dropdownList.append(newOption);

for(let i=minYear; i<=maxYear; i++){
    let newOption=document.createElement("option");
    newOption.setAttribute("value",i);
    newOption.innerHTML=i;
    dropdownList.append(newOption);
}

function showAllBooks(){
    console.log("show book");
    let bookDisplayBlock=document.getElementById("bookSearchResult");
    bookDisplayBlock.innerHTML=`
        <table class="table table-striped-rows">
            <tr>
                <td>書籍名稱</td>
                <td>作者</td>
                <td>年份</td>
            </tr>
            <tr>
                <td>小王子</td>
                <td>prince</td>
                <td>2022</td>
            </tr>
        </table>`;
}
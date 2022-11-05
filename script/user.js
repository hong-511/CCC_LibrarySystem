let maxYear=2022;
let minYear=1980;
let dropdownList=document.getElementById("bookYear");
for(let i=minYear; i<=maxYear; i++){
    let newOption=document.createElement("option");
    newOption.setAttribute("value",i);
    newOption.innerHTML=i;
    dropdownList.append(newOption);
}
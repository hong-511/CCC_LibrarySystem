//select user button
let userButton=document.getElementById("userButton");
userButton.addEventListener("click",chooseIdentity);
//select administrator button
let administratorButton=document.getElementById("administratorButton");
administratorButton.addEventListener("click",chooseIdentity);
//select register
let registerButton=document.getElementById("registerButton");
registerButton.addEventListener("click",chooseIdentity)
//input form
let inputBlock=document.getElementById("inputBlock");
//submit register info button
let submitButton=document.getElementById("submitRegisterInfo");
submitButton.setAttribute("style","display:none");

//loginButton
let loginButton=document.getElementById("loginButton");
loginButton.setAttribute("style","display:none");

function chooseIdentity(event){
    let clickButton = event.target
    if(clickButton==userButton || clickButton.id=="administratorButton"){
        inputBlock.innerHTML=`<div class="form-group">
                                    帳號 &nbsp&nbsp
                                    <input  id="account" type="text" placeholder="請輸入你的帳號" size="40">
                                    <br>
                                    <br>
                                </div>
                                <div class="form-group">
                                    密碼 &nbsp&nbsp
                                    <input  id="password" type="password" placeholder="請輸入你的密碼" size="40">
                                    <br>
                                    <br>
                                </div>
                            `;
        //display login button
        loginButton.setAttribute("style","display:inline-block");
        //hide submit button
        submitButton.setAttribute("style","display:none");

        //change jump page
        if(clickButton.id=="userButton"){
            loginButton.setAttribute("href","./user.html");
        }
        else if(clickButton.id=="administratorButton"){
            loginButton.setAttribute("href","./administrator.html");
        }
        
    }
    else if(clickButton==registerButton){
        inputBlock.innerHTML=`
        <div class="form-group"> 
            帳號 &nbsp&nbsp
            <input  id="account" type="text" placeholder="請輸入帳號" size="40">
            <br>
            <br>
        </div>
        <div class="form-group">
            密碼 &nbsp&nbsp
            <input  id="password" type="password" placeholder="請輸入密碼" size="40">
            <br>
            <br>
        </div>
        <div class="form-group">
            姓名 &nbsp&nbsp
            <input  id="name" type="text" placeholder="請輸入你的姓名" size="40">
            <br>
            <br>
        </div>
        <div class="form-group">
            email &nbsp&nbsp
            <input  id="email" type="email" placeholder="請輸入你的電子郵件" size="40">
            <br>
            <br>
        </div>
        <div class="form-group">
            電話 &nbsp&nbsp
            <input  id="tel" type="tel" placeholder="請輸入你的電話" size="40">
            <br>
            <br>
        </div>
        `;
        //hide login button
        loginButton.setAttribute("style","display:none");
        //display submit button
        submitButton.setAttribute("style","display:inline-block");
    }
}
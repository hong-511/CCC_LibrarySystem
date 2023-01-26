<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Name = $_POST["Name"];
    $Password1 = $_POST["Password1"];
    $Password2 = $_POST["Password2"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $userProfileVerified = false;

    if($Name == NULL)
        echo "Name empty !!!";
    else if($email== NULL)  
        echo "email empty !!!";
    else if($phone == NULL)
        echo "phone empty !!!"; 
    else if($Password1 == NULL)
        echo "Password empty !!!";  
    else if($Password2 == NULL)
        echo "check Password empty !!!";  
    else if($Password1 != $Password2)//confirm passsword same
        echo "Two password doesn't match!!!"; 
    else{
        $userProfileVerified = true;
    } 
     
    if($userProfileVerified){
        $query = ("select * from reader where Reader_ID=?");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Reader_ID));
        $result = $stmt->fetchAll();
        if($result != NULL)
            echo "Dulplicate Reader ID !!!";
        else if($Password1 != NULL && $Password2 != NULL && $Name != NULL){
            //hash password
            $hashedPassword = password_hash($Password1, PASSWORD_DEFAULT);
            
            $query = ("insert into reader values(?,?,?,?,?)");
            $stmt= $db->prepare($query);//執行SQL語法
            $result = $stmt->execute(array($Reader_ID, $Name, $hashedPassword, $email, $phone));
            echo "Register succeed";
        }
    }
?>
<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Name = $_POST["Name"];
    $Password1 = $_POST["Password1"];
    $Password2 = $_POST["Password2"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if($email== NULL)  
        header("Location:userSignUp.php"); 
    if($Password1 == NULL)
        header("Location:userSignUp.php"); 
    if($Password2 == NULL)
        header("Location:userSignUp.php"); 
    if($Password1 != $Password2)//confirm passsword same
        header("Location:userSignUp.php"); 
    if($Name == NULL)
        header("Location:userSignUp.php"); 
    if($phone == NULL)
        header("Location:userSignUp.php"); 
    
    $query = ("select * from reader where Reader_ID=?");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($Reader_ID));
    $result = $stmt->fetchAll();
    if($result != NULL)
        echo"This user Exist!!!<br/>";
    else if($Password1 != NULL && $Password2 != NULL && $Name != NULL){
        //設定要使用的SQL指令
        $query = ("insert into reader values(?,?,?,?,?)");
        $stmt= $db->prepare($query);//執行SQL語法
        $result = $stmt->execute(array($Reader_ID,$Name,$Password1,$email, $phone));
        header("Location:../index.php");
    }
?>
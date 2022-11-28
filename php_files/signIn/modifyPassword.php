<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Name = $_POST["UserName"];
    $Password = $_POST["NewPassword"];
    if($Reader_ID == NULL)  
        header("Location:modifyPasswordPage.php"); 
    if($Name == NULL)
        header("Location:modifyPasswordPage.php");
    if($Password == NULL)
        header("Location:modifyPasswordPage.php");
    
    $query = ("select * from reader where Reader_ID=? and Name=?");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($Reader_ID, $Name));
    $result = $stmt->fetchAll();
    if($result != NULL)
        {
            $query = ("update reader set Password=?
                       where Reader_ID=? and Name=?");
	        $stmt= $db->prepare($query);//執行SQL語法
	        $result = $stmt->execute(array($Password, $Reader_ID, $Name));
            header("Location:userSignIn.php");
        }
    else if($Reader_ID == NULL & $Name == NULL & $Password == NULL){
        header("Location:../signUp/userSignUp.php");
    }
       
?>
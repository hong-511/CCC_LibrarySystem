<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Password = $_POST["Password"];
    if($Reader_ID == NULL)  
        header("Location:userSignIn.php"); 
    if($Password == NULL)
        header("Location:userSignIn.php");
    
    $query = ("select * from reader where Reader_ID=? and Password=?");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($Reader_ID, $Password));
    $result = $stmt->fetchAll();
    if($result != NULL)
        header("Location:userPage.php");
    else
        header("Location:userSignIn.php");
?>

<?php
    header("Content-type:text/html;charset=utf-8");
    include_once "../db_connect.php";
	
    $id = $_POST["id"];
    $password = $_POST["password"];
    if($id == NULL)  
        header("Location:adminSignIn.php"); 
    if($phone == NULL)
        header("Location:adminSignIn.php");
    
    $query = ("select * from administer where Administer_ID=? and Password=?");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($id, $password));
    $result = $stmt->fetchAll();
    if($result != NULL)
        header("Location:adminPage.php");
    else
        header("Location:adminSignIn.php");
?>

<?php
    header("Content-type:text/html;charset=utf-8");
    include_once "../connectDatabase.php";
	
    $id = $_POST["id"];
    $password = $_POST["password"];

    $loginDataVerified = false;

    if($id == NULL)  
        echo "Please enter ID";
    else if($password == NULL)
        echo "Please enter password";
    else{
        $loginDataVerified = true;
    }
    
    if($loginDataVerified){
        $query = ("select * from administer where Administer_ID=? and Password=?");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute(array($id, $password));
        $result = $stmt->fetchAll();
        if($result != NULL)
            echo "login succeed";
        else
            echo "Login failed, please check ID and password again";
    }
?>

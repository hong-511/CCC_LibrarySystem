<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Name = $_POST["UserName"];
    $Password = $_POST["NewPassword"];
    $checkedPassword = $_POST["checkedNewPassword"];

    $newProfileVerified = false;

    if($Reader_ID == NULL)  
        echo "Reader ID empty";
    else if($Name == NULL)
        echo "Name empty";
    else if($Password == NULL)
        echo "Password empty";
    else if($checkedPassword != $Password)
        echo "Two passwords don't match";
    else{
        $newProfileVerified = true;
    }
    
    if($newProfileVerified){
        $query = ("select * from reader where Reader_ID=? and Name=?");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Reader_ID, $Name));
        $result = $stmt->fetchAll();
        if($result != NULL && $checkedPassword == $Password)
        {
            $query = ("update reader set Password=?
                    where Reader_ID=? and Name=?");
            $stmt= $db->prepare($query);//執行SQL語法
            $result = $stmt->execute(array($Password, $Reader_ID, $Name));
            echo "edit succeed";
        }
        else{
            echo "Can't find this user, please check ID and Name and try again,";
        }
    }
       
?>
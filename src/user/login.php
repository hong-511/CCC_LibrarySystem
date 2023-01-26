<?php
    session_start();
    header("Content-type:text/html;charset=utf-8");
    include_once "../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Password = $_POST["Password"];
    if($Reader_ID == NULL)
        echo "Please input your ID";  
    else if($Password == NULL)
        echo "Please input your Password";
    else{
        $query = ("select * from reader where Reader_ID=?");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Reader_ID));
        $result = $stmt->fetchAll();
        if($result != NULL){
            $hashedPasswordInDatabase = $result[0]['Password'];
            $isPasswordCorrect = password_verify($Password, $hashedPasswordInDatabase);
            if($isPasswordCorrect){
                $_SESSION['Reader_ID'] = $Reader_ID;
                /*initial user page*/
                $_SESSION['pageNumber'] = 1;
                echo "login succeed";
            }
            else{
                echo "password incorrect";
            }
        }
        else{
            echo "Can't find this user, please check your ID and Password and try again";
        }
    }
?>
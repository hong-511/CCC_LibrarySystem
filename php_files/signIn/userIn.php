<?php
    session_start();
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
    $Reader_ID = $_POST["Reader_ID"];
    $Password = $_POST["Password"];
    if($Reader_ID == NULL)
        echo "Please input your ID<br/>";  
    else if($Password == NULL)
        echo "Please input your Password<br/>";
    else{
        $query = ("select * from reader where Reader_ID=? and Password=?");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Reader_ID, $Password));
        $result = $stmt->fetchAll();
        if($result != NULL){
            $_SESSION['Reader_ID'] = $Reader_ID;
            /*initial user page*/
            $_SESSION['PageType'] = 0;
            $_SESSION['DidSearch'] = false;
            /**count available books max Page**/
            $query = ("select count(*) as number from book  where Status = 'available'");
            $stmt= $db->prepare($query);//執行SQL語法
            $stmt->execute();
            $result = $stmt->fetchAll();
            $_SESSION['AvailableMaxPage'] = $result[0]['number']/20 + 1;//count max page
            /**count all books max Page**/
            $query = ("select count(*) as number from book");
            $stmt= $db->prepare($query);//執行SQL語法
            $stmt->execute();
            $result = $stmt->fetchAll();
            $_SESSION['MaxPage'] = $result[0]['number']/20 + 1;//count max page
            header("Location:userPage.php");
        }
        else{
            echo "Can't find this user, Please check your ID and Password and try again<br/>";
            echo "If you didn't register, Please register and try again<br/>";
            //header("Location:userSignIn.php");
        }
    }
    echo"<br/><input type = 'button' onclick='history.back()' value = 'Go Back'></input>";
?>

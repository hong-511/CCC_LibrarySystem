<?php
    session_start();
    include_once "../../db_connect.php";

    $Book_ID = $_POST["Book_ID"];
    $query = ("select Status from book where Book_ID=? ");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($Book_ID));
    $result = $stmt->fetchAll();
    if($result[0]['Status'] == "available"){
        /****update book status****/
        $query = ("update book set Status = 'issued' where Book_ID= ".$Book_ID);
	    $stmt= $db->prepare($query);//執行SQL語法
	    $result = $stmt->execute();
        /****insert borrow inform into process table****/
        $query = ("select count(*) as number from process");//how many data in process
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        $Process_ID = $result[0]['number'] + 1; 
        $Reader_ID = $_SESSION['Reader_ID'];   
        $Date = "null";
        $Type = "borrow";

        $query = ("insert into process values(?,?,?,?,?)");
        $stmt= $db->prepare($query);//執行SQL語法
        $result = $stmt->execute(array($Process_ID,$Reader_ID,$Book_ID,$Date,$Type));
        echo "Borrowing is successful<br/>";
    }
    else{
        echo "You can't borrow this book<br/>";
    }
    echo"<br/><input type = 'button' onclick='history.back()' value = 'Go Back'></input>";
?>
<?php
    session_start();
    include_once "../../db_connect.php";//link to database

    $borrowIDlist = $_POST["borrowIDlist"];
    /****update book status****/
    $query = ("update book set Status = 'issued' where Book_ID= ?");
    $stmt= $db->prepare($query);//執行SQL語法
    foreach($borrowIDlist as $Book_ID){
        $result = $stmt->execute(array($Book_ID));
    }

    //how many data in process
    $query = ("select count(*) as number from process");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    /****insert borrow information into process table****/
    $Process_ID = $result[0]['number'] + 1; 
    $Reader_ID = $_SESSION['Reader_ID'];   
    $Date = date("Y/m/d");;
    $Type = "borrow";
    $Administer_ID = 1;
    $query = ("insert into process values(?,?,?,?,?,?)");
    $stmt= $db->prepare($query);//執行SQL語法
    foreach($borrowIDlist as $Book_ID){
        $result = $stmt->execute(array($Process_ID++,$Reader_ID,$Book_ID,$Administer_ID,$Date,$Type));
    }
    echo "Borrowing is successful";
?>
<?php
    session_start();
    include_once "../../db_connect.php";
	
    $Reader_ID = $_SESSION['Reader_ID'];
    $query = ("select * from reader where Reader_ID=?");
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute(array($Reader_ID));
    $result = $stmt->fetchAll();
    if($result != NULL){
        echo $result[0]['Name'];
    }
    else{
        echo "User not found";
    }
?>

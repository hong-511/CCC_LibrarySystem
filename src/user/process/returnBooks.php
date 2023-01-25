<?php
    session_start();
    include_once "../../connectDatabase.php";//link to database

    /****return button was pressed****/
    $returnIDlist = $_POST["returnIDlist"];

    try {
        /****update book status****/
        $query = ("update book set Status = 'available' where Book_ID= ?");
        $stmt= $db->prepare($query);//執行SQL語法
        foreach($returnIDlist as $Book_ID){
            $result = $stmt->execute(array($Book_ID));
        }
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    /****insert return information into process table****/
    $query = ("select count(*) as number from process");//how many data in process
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    $Process_ID = $result[0]['number'] + 1; 
    $Reader_ID = $_SESSION['Reader_ID'];   
    $Date = date("Y/m/d");;
    $Type = "return";
    $Administer_ID = 1;
    $query = ("insert into process values(?,?,?,?,?,?)");
    $stmt= $db->prepare($query);//執行SQL語法
    foreach($returnIDlist as $Book_ID){
        $result = $stmt->execute(array($Process_ID++,$Reader_ID,$Book_ID,$Administer_ID,$Date,$Type));
    }
    echo "Returning is successful";
?>
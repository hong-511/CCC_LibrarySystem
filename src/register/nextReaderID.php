<?php
    include_once "../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
    
    $query = ("select count(*) as number from reader");//how many data in reader
    $stmt= $db->prepare($query);//執行SQL語法
    $stmt->execute();
    $result = $stmt->fetchAll();
    $Reader_ID = $result[0]['number'] + 1;
    echo $Reader_ID;
?>
<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
    $type = 0;
    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    if($Book_ID != NULL)  
        $type = $type + 1;  
    if($BookName != NULL)
        $type = $type + 2;
    if($Author != NULL)      
        $type = $type + 4;
    switch($type){
        case 0:
            echo("error<br/>");
            $stmt = NULL;
            break;
        case 1:
            $query = ("select * from book where Book_ID=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($Book_ID));
            break;
        case 2:
            $query = ("select * from book where BookName=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($BookName));
            break;
        case 3:
            $query = ("select * from book where Book_ID=? and BookName=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($Book_ID,$BookName));
            break;
        case 4:
            $query = ("select * from book where Author=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($Author));
            break;
        case 5:
            $query = ("select * from book where Book_ID=? and Author=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($Book_ID,$Author));
            break;
        case 6:
            $query = ("select * from book where BookName=? and Author=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($BookName,$Author));
            break;
        case 7:
            $query = ("select * from book where Book_ID=? and BookName=? and Author=?");
            $stmt= $db->prepare($query);//執行SQL語法
	        $stmt->execute(array($Book_ID,$BookName,$Author));
            break;
    }
        
    if($stmt != NULL){
        $result = $stmt->fetchAll();
        if($result != NULL){
            echo"<table border='1'>
                <tr>
                    <th>Book_ID</th>
                    <th>BookName</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Year</th>
                    <th>Price</th>
                </tr>";
            
            for($i=0; $i<count($result); $i++){
                echo"<tr>";
                echo"<td>".$result[$i]['Book_ID']."</td>";
                echo"<td>".$result[$i]['BookName']."</td>";
                echo"<td>".$result[$i]['Author']."</td>";
                echo"<td>".$result[$i]['Status']."</td>";
                echo"<td>".$result[$i]['Year']."</td>";
                echo"<td>".$result[$i]['Price']."</td>";
                echo"</tr>";
            }
        }
    }    
    else
        $result = NULL;
    
    if($result == NULL)
        echo"NO result<br/>";
    else
        echo"</table>";
    echo"<br/><input type = 'button' onclick='history.back()' value = 'Go Back'></input>";
?>

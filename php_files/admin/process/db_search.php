<?php
    header("Content-type:text/html;charset=utf-8");
    //echo "Hi! This is db_search.php file.<br/> ";
    include_once "../../db_connect.php";//設定想要新增入資料庫的資料內容如下

    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];
    $count = 0;
    $array = [];
    if($Book_ID != NULL){
        if($count != 0)
            $part1 = " and ";
        else
            $part1 = "";
        $part1 = $part1." Book_ID=? ";
        $array[$count++] = $Book_ID;
        
    }
    else{
        $part1 = "";
    }
    if($BookName != NULL){
        if($count != 0)
            $part2 = " and ";
        else
            $part2 = "";
        $part2 = $part2." BookName like ? ";
        $array[$count++] = "%".$BookName."%";
    }
    else{
        $part2 = "";
    }
    if($Author != NULL){
        if($count != 0)
            $part3 = " and ";
        else
            $part3 = "";
        $part3 = $part3." Author like ? ";
        $array[$count++] = "%".$Author."%";
    }
    else{
        $part3 = "";
    }
    if($Status != "unknown"){
        if($count != 0)
            $part4 = " and ";
        else
            $part4 = "";
        $part4 = $part4." Status=? ";
        $array[$count++] = $Status;
    }
    else{
        $part4 = "";
    }
    if($Year != "unknown"){
        if($count != 0)
            $part5 = " and ";
        else
            $part5 = "";
        $part5 = $part5." Year=? ";
        $array[$count++] = $Year;
    }
    else{
        $part5 = "";
    }
    if($Price != NULL){
        if($count != 0)
            $part6 = " and ";
        else
            $part6 = "";
        $part6 = $part6." Price=? ";
        $array[$count++] = $Price;
    }
    else{
        $part6 = "";
    }
    //echo "count is ".$count."<br/> ";
    if($count == 0){
        echo"NO conditions!!!<br/>";
    }
    else{
        $query = ("select * from book where ".$part1.$part2.$part3.$part4.$part5.$part6);
        //echo $query."<br/> ";
        $stmt= $db->prepare($query);//執行SQL語法
        if($count == 1){
            $stmt->execute(array($array[0]));
        }
        else if($count == 2){
            $stmt->execute(array($array[0], $array[1]));
        }
        else if($count == 3){
            $stmt->execute(array($array[0], $array[1], $array[2]));
        }
        else if($count == 4){
            $stmt->execute(array($array[0], $array[1], $array[2], $array[3]));
        }
        else if($count == 5){
            $stmt->execute(array($array[0], $array[1], $array[2], $array[3], $array[4]));
        }
        else if($count == 6){
            $stmt->execute(array($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]));
        }
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
            echo"</table>";
        }
        else
            echo"NO result<br/>";
    }
?>
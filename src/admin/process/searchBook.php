<?php
    header("Content-type:text/html;charset=utf-8");
    session_start();
    include_once "../../connectDatabase.php";//設定想要新增入資料庫的資料內容如下

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
        $page = $_SESSION['pageNumber'];
        echo "<div id='pagination'></div>";
        //echo"Now Page : $page<br/>";
        //TODO set highest page number if session-highest page number is not set
        $offset = ($page-1)*20;
        if($result != NULL){
            if($offset > count($result)){
                echo"Don't have this page !!!";
            }
            else{
                echo"<table class='table table-striped table-hover'>
                    <tr>
                        <th>Book_ID</th>
                        <th>BookName</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Year</th>
                        <th>Price</th>
                    </tr>";
                
                for($i=0; $i<20 && $i+$offset <count($result); $i++){
                    echo"<tr>";
                    echo"<td>".$result[$i+$offset]['Book_ID']."</td>";
                    echo"<td>".$result[$i+$offset]['BookName']."</td>";
                    echo"<td>".$result[$i+$offset]['Author']."</td>";
                    echo"<td>".$result[$i+$offset]['Status']."</td>";
                    echo"<td>".$result[$i+$offset]['Year']."</td>";
                    echo"<td>".$result[$i+$offset]['Price']."</td>";
                    echo"</tr>";
                }
                echo"</table>";
            }
        }
        else
            echo"No result";
    }
?>
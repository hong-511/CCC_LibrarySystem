<?php
    session_start();
    include_once "../../connectDatabase.php";//link to database
    
    /*search result from database*/
    $Book_ID = $_SESSION["Book_ID"];
    $BookName = $_SESSION["BookName"];
    $Author = $_SESSION["Author"];
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
    try {
        if($count == 0){
            $query = ("select * from book ");
            $stmt= $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        else{
            $query = ("select * from book where ".$part1.$part2.$part3);
            $stmt= $db->prepare($query);
            if($count == 1){
                $stmt->execute(array($array[0]));
            }
            else if($count == 2){
                $stmt->execute(array($array[0], $array[1]));
            }
            else if($count == 3){
                $stmt->execute(array($array[0], $array[1], $array[2]));
            }
            $result = $stmt->fetchAll();
        }
        $page = $_SESSION['pageNumber'];
        echo "<div id='pagination'></div>";

        //set highest page number
        for($i=0; $i < count($result); $i++){
            $tempPageOffset = ($i-1)*20;
            if($tempPageOffset > count($result)){
                $_SESSION['maxPageNumber'] = $i - 1;
                break;
            }
        }

        $offset = ($page-1)*20;         
        if($result != NULL){
            if($offset > count($result)){
                echo"Don't have this page !!!";
            }
            else{
                echo"<form id ='borrowed'><table class='table table-striped table-hover'>
                <tr>
                    <th>Select</th>
                    <th>Book_ID</th>
                    <th>BookName</th>
                    <th>Author</th>
                    <th>Status</th>
                </tr>";
                for($i=0; $i<20 && $i+$offset < count($result); $i++){
                    echo"<tr>";
                    if($result[$i+$offset]['Status'] == 'available')
                        echo"<td><input type = 'checkbox' name='borrowIDlist[]' value = ".$result[$i+($page-1)*20]['Book_ID']."></td>"; 
                    else
                        echo"<td><input type = 'checkbox' name='borrowIDlist[]' value = ".$result[$i+($page-1)*20]['Book_ID']." disabled></td>"; 
                    echo"<td>".$result[$i+$offset]['Book_ID']."</td>";
                    echo"<td>".$result[$i+$offset]['BookName']."</td>";
                    echo"<td>".$result[$i+$offset]['Author']."</td>";
                    echo"<td>".$result[$i+$offset]['Status']."</td>";
                    echo"</tr>";
                }
                    echo"</table></form>";
            }
            
        }
        else{
            echo"NO result";
        }
    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<?php
    session_start();
    include_once "../../db_connect.php";//link to database

    /*select book ID that user borrowed */
    $query = 
    ("(SELECT Book_ID, COUNT(Book_ID) AS number FROM process WHERE Reader_ID = ? AND Type = 'borrow' GROUP BY Book_ID) 
        except 
        (SELECT Book_ID, COUNT(Book_ID) AS number FROM process WHERE Reader_ID = ? AND Type = 'return' GROUP BY Book_ID)");
    $stmt= $db->prepare($query);//執行SQL語法   
    $stmt->execute(array($_SESSION['Reader_ID'],$_SESSION['Reader_ID']));
    $result = $stmt->fetchAll();
    $result_ID = $result;
    /*output book ID that user didn't return*/
    $query = ("select Book_ID, BookName, Author from book where Book_ID = ?");
    $stmt= $db->prepare($query);//執行SQL語法
    echo"<form  id='return'>";
        echo"<table class='table table-striped table-hover'>
            <tr>
                <th>Select</th>
                <th>Book_ID</th>
                <th>BookName</th>
                <th>Author</th>
            </tr>";
        for($i=0; $i<count($result_ID); $i++){
            $stmt->execute(array($result_ID[$i]['Book_ID']));
            $result = $stmt->fetchAll();
            echo"<tr>";
            echo"<td><input type = 'checkbox' name='returnIDlist[]' value = ".$result[0]['Book_ID']."></td>"; 
            echo"<td>".$result[0]['Book_ID']."</td>";
            echo"<td>".$result[0]['BookName']."</td>";
            echo"<td>".$result[0]['Author']."</td>";
            echo"</tr>";
        }   
        echo"</table>"; 
    echo "</form>";
?>
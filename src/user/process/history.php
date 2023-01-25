<?php
    session_start();
    include_once "../../connectDatabase.php";//link to database

    try {
        /*select book ID that user borrowed */
        $query = 
        ("select Name, Book_ID, Date, Type FROM record WHERE Reader_ID = ? ");
        $stmt= $db->prepare($query); 
        $stmt->execute(array($_SESSION['Reader_ID']));
        $result = $stmt->fetchAll();
        $result_ID = $result;
        echo "<table class='table table-striped table-hover'>
                <tr>
                    <th>Name</th>
                    <th>Book_ID</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>";
        for($i=0; $i<count($result); $i++){
            echo "<tr>";
            echo "<td>" . $result[$i]['Name'] . "</td>";
            echo "<td>" . $result[$i]['Book_ID'] . "</td>";
            echo "<td>" . $result[$i]['Date'] . "</td>";
            echo "<td>" . $result[$i]['Type'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>
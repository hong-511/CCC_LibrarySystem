<html>
	<head>
		<title> Database System Admin Page </title>
	</head>
	
	<body>	
        <h1>Admin Page</h1>	
    <p> By <font size="5"> <strong> CCC team </strong> </font></p>
    <hr>
	<?php
        //header("Content-type:text/html;charset=utf-8");
        include_once "db_connect.php";//link database
        
        echo"<table border='5'>
        <tr>
            <th>ID</th>
            <th>Phone</th>
            <th>Live</th>
        </tr>";
        $query = ("select * from students");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute();
        $result = $stmt->fetchAll();

        for($i=0; $i<count($result); $i++){
            echo"<tr>";
            echo"<td>".$result[$i]['id']."</td>";
            echo"<td>".$result[$i]['phone']."</td>";
            echo"<td>".$result[$i]['live']."</td>";
            echo"</tr>.";
        }
        echo"</table>";
    ?>
    <hr>
    <!-- search -->
    <form  action=db_search.php method="post">
        <?php
            echo "This is for search.<br/>";
        ?>
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="id" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>Phone :</strong> </font></label>
            <input type="text" name="phone"><br/>
        </div><br/>

        <div>
            <label><font size="3"> <strong>Live :</strong> </font></label>
            <input type="text" name="live"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Search">
        </div>
    </form>
    <hr>
    <!-- Insert -->
    <form  action=db_insert.php method="post">
        <?php
            echo "This is for insert.<br/>";
        ?>
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="id" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>Phone :</strong> </font></label>
            <input type="text" name="phone"><br/>
        </div><br/>

        <div>
            <label><font size="3"> <strong>Live :</strong> </font></label>
            <input type="text" name="live"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Insert">
        </div>
    </form>
    <hr>
    <!-- Update -->
    <form  action=db_update.php method="post">
        
        <?php
            echo "This is for update.<br/>";
        ?>
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="id" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>Phone :</strong> </font></label>
            <input type="text" name="phone"><br/>
        </div><br/>

        <div>
            <label><font size="3"> <strong>Live :</strong> </font></label>
            <input type="text" name="live"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
	</body>	
</html>
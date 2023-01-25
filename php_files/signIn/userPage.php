<html>
	<head>
		<title> Database System User Page </title>
	</head>
	
	<body>	
        <h1>User Page</h1>	
    <p> By <font size="5"> <strong> CCC team </strong> </font></p>
    <hr>
    <!-- search -->
    <form  action=/signIn/user_process/db_search.php method="post">
        <?php
            echo "This is for search.<br/>";
        ?>
        <div>
            <label><font size="3"> <strong>Book_ID :</strong> </font></label>
            <input type="text" name="Book_ID" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>BookName :</strong> </font></label>
            <input type="text" name="BookName"><br/>
        </div><br/>

        <div>
            <label><font size="3"> <strong>Author :</strong> </font></label>
            <input type="text" name="Author"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Search">
        </div>
    </form>
    <hr>
    <!-- change page -->
    <form  action=userPage.php method="get">
        <div>
            <label><font size="3"> <strong>Page Number :</strong> </font></label>
            <select name="pageNumber">
                <?php
                    include_once "../db_connect.php";//link database
                    $query = ("select * from book");
                    $stmt= $db->prepare($query);//執行SQL語法
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $maxPage = count($result)/20 + 1;
                    for($i=1; $i<$maxPage; $i++)
                        echo"<option value = ".$i.">".$i."</option>";
                ?>
            </select>
        </div>
        <!-- submit -->
        <div>
            <input type="submit" value="Change">
        </div>
    </form>
    <hr>
    <?php
        //header("Content-type:text/html;charset=utf-8");
        include_once "../db_connect.php";//link database
        if(!isset($_GET["pageNumber"]))
            $page = 1;
        else
            $page = $_GET["pageNumber"];
        echo"Now Page : $page<br/>";
        echo"<table border='5'>
        <tr>
            <th>Book_ID</th>
            <th>BookName</th>
            <th>Author</th>
            <th>Status</th>
            <th>Year</th>
        </tr>";
        $query = ("select * from book");
        $stmt= $db->prepare($query);//執行SQL語法
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) >= 20)
            $number = 20;
        else
            $number = count($result);
        //$maxPage = count($result)/20 + 1;
        for($i=0; $i<20 && $i+($page-1)*20 <count($result); $i++){
            echo"<tr>";
            echo"<td>".$result[$i+($page-1)*20]['Book_ID']."</td>";
            echo"<td>".$result[$i+($page-1)*20]['BookName']."</td>";
            echo"<td>".$result[$i+($page-1)*20]['Author']."</td>";
            echo"<td>".$result[$i+($page-1)*20]['Status']."</td>";
            echo"<td>".$result[$i+($page-1)*20]['Year']."</td>";
            echo"</tr>";
        }
    ?>
	</body>	
</html>
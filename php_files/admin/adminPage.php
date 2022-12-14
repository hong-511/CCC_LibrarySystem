<html>
	<head>
		<title> Database System Admin Page </title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" onclick="loadSearchForm('search')">search</button>
                    <button class="btn btn-primary" onclick="loadSearchForm('insert')">insert</button>
                    <button class="btn btn-primary" onclick="loadSearchForm('update')">update</button>
                    <button class="btn btn-primary" onclick="loadSearchForm('delete')">delete</button>
                </div>
            </div>
            <div id="formBlock"></div>
        </div>
        <h1>Admin Page</h1>
    <!-- change page -->
    <form  action=adminPage.php method="get">
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
            <th>Price</th>
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
            echo"<td>".$result[$i+($page-1)*20]['Price']."</td>";
            echo"</tr>.";
        }
    ?>
        <script src="../script/form.js"></script>
        <script src="../script/admin.js"></script>
	</body>	
</html>
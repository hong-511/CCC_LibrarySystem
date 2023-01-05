<html>
	<head>
		<title> Database System Admin Page </title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <div class="col-3">
                    <a class="navbar-brand" href="/index.php">
                        <img src="/asset/a.ico" alt="Book icon" width="30" height="24">
                        圖書借閱系統
                    </a>
                </div> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/signIn/userSignIn.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/signUp/usersignUp.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/adminSignIn.php">Admin</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row mb-5 mt-3">
                <div class="col"></div>
                <div class="col">
                    <h1>Admin Page</h1>
                </div>
                <div class="col"></div>
            </div>
            
            <div class="row mb-5">
                <div class="col">
                    <button class="btn btn-warning" onclick="loadCRUDForm('search')">search</button>
                </div>
                <div class="col">
                    <button class="btn btn-warning" onclick="loadCRUDForm('insert')">insert</button>
                </div>
                <div class="col">
                    <button class="btn btn-warning" onclick="loadCRUDForm('update')">update</button>
                </div>
                <div class="col">
                    <button class="btn btn-warning" onclick="loadCRUDForm('delete')">delete</button>
                </div>
                </div>
            </div>
            <div id="formBlock"></div>
        </div>
        
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
        echo"<table class='table table-striped table-hover'>
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
            echo"</tr>";
        }
    ?>
        <script src="../script/form.js"></script>
        <script src="../script/admin.js"></script>
	</body>	
</html>
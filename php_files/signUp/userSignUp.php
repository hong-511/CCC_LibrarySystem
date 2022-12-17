<html>
	<head>
		<title> Sign Up Page </title>
	</head>
	
	<body>	
        <h1>User Sign Up</h1>	
    <!--<p> By <font size="5"> <strong> CCC team </strong> </font></p>-->
    <hr>
    <!-- Sign In -->
    <form  action=addReader.php method="post">
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <?php
                header("Content-type:text/html;charset=utf-8");
                include_once "../db_connect.php";//設定想要新增入資料庫的資料內容如下
                /****insert borrow information into process table****/
                $query = ("select count(*) as number from reader");//how many data in process
                $stmt= $db->prepare($query);//執行SQL語法
                $stmt->execute();
                $result = $stmt->fetchAll();
                $Reader_ID = $result[0]['number'] + 1;
                echo "<input type='hidden' name='Reader_ID' value = ". $Reader_ID ." />";
                echo "<input type='text' name='Reader_ID2' value = ". $Reader_ID ." disabled />";
            ?>
        </div><br/>
        <div>
            <label><font size="3"> <strong>Name :</strong> </font></label>
            <input type="text" name="Name" />
        </div><br/>
        <div>
            <label><font size="3"> <strong>email :</strong> </font></label>
            <input type="text" name="email" />
        </div><br/>
        <div>
            <label><font size="3"> <strong>phone :</strong> </font></label>
            <input type="text" name="phone" />
        </div><br/>
        <div>
            <label><font size="3"> <strong>Password :</strong> </font></label>
            <input type="password" name="Password1"><br/>
        </div><br/>
        <div>
            <label><font size="3"> <strong>check Password :</strong> </font></label>
            <input type="password" name="Password2"><br/>
        </div><br/>
        
        <!-- submit -->
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
	</body>	
</html>

<?php	
    include_once "../../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];
    //設定要使用的SQL指令
	$query = ("insert into book values(?,?,?,?,?,?)");
	$stmt= $db->prepare($query);//執行SQL語法
	$result = $stmt->execute(array($Book_ID,$BookName,$Author,$Status,$Year,$Price));

    echo "finish insert";
    //TODO:check if insert succeed and search for the inserted book
?>

<?php	
    //echo "Hi! This is db_action.php file.<br/> ";
    include_once "../../db_connect.php";//設定想要新增入資料庫的資料內容如下
	
	//使用預處理寫法是為了防止「sql injection」

    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];
    
    //設定要使用的SQL指令
	$query = ("update book set BookName=?,Author=?,Status=?,Year=?,Price=?
                where Book_ID=?");
	$stmt= $db->prepare($query);//執行SQL語法
	$result = $stmt->execute(array($BookName,$Author,$Status,$Year,$Price,$Book_ID));
    header("Location:../adminPage.php");
?>

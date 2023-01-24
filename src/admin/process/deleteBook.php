<?php	
    include_once "../../connectDatabase.php";
	
	//使用預處理寫法是為了防止「sql injection」

    $Book_ID = $_POST["Book_ID"];
    
    //設定要使用的SQL指令
	$query = ("delete from book where Book_ID=?");
	$stmt= $db->prepare($query);//執行SQL語法
	$result = $stmt->execute(array($Book_ID));

    echo "finish delete";
    //TODO:check if delete succeed and return delete succeed
?>

<?php	
    //echo "Hi! This is db_action.php file.<br/> ";
    include_once "../../db_connect.php";
	
	//使用預處理寫法是為了防止「sql injection」

    $Book_ID = $_POST["Book_ID"];
    
    //設定要使用的SQL指令
	$query = ("delete from book where Book_ID=?");
	$stmt= $db->prepare($query);//執行SQL語法
	$result = $stmt->execute(array($Book_ID));
    header("Location:../adminPage.php");
?>

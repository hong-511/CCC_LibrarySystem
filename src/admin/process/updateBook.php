<?php	
    include_once "../../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
	//使用預處理寫法是為了防止「sql injection」

    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];

    try{
        //check if the target book exists
        $query = ("select * from book where Book_ID=?");
        $stmt = $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Book_ID));
        $result = $stmt->fetchAll();
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    if($result != null){
        try{
            //update book data
            $query = ("update book set BookName=?,Author=?,Status=?,Year=?,Price=?
                        where Book_ID=?");
            $stmt= $db->prepare($query);//執行SQL語法
            $result = $stmt->execute(array($BookName,$Author,$Status,$Year,$Price,$Book_ID));

            //check if update succeed
            $query = ("select * from book where Book_ID=? and BookName=? and Author=? and Status=? and Year=? and Price=?");
            $stmt = $db->prepare($query);//執行SQL語法
            $stmt->execute(array($Book_ID, $BookName, $Author, $Status, $Year, $Price));
            $result = $stmt->fetchAll();
        if($result != null){
            echo "update succeed";
        }
        else {
            echo "update failed";
        }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    else {
        echo "There is no such book in database, please check book ID and try again";
    }

    
    
?>

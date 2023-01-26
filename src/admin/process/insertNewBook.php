<?php	
    include_once "../../connectDatabase.php";//設定想要新增入資料庫的資料內容如下
	
    $Book_ID = $_POST["Book_ID"];
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Status = $_POST["Status"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];

    try{
        //insert a new book
        $query = ("insert into book values(?,?,?,?,?,?)");
        $stmt= $db->prepare($query);//執行SQL語法
        $result = $stmt->execute(array($Book_ID,$BookName,$Author,$Status,$Year,$Price));

        //check if insert succeed
        $query = ("select * from book where Book_ID=? and BookName=? and Author=? and Status=? and Year=? and Price=?");
        $stmt = $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Book_ID, $BookName, $Author, $Status, $Year, $Price));
        $result = $stmt->fetchAll();
        if($result != null){
            echo "insert succeed";
        }
        else {
            echo "insert failed";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>

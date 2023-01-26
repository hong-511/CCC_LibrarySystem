<?php	
    include_once "../../connectDatabase.php";

    $Book_ID = $_POST["Book_ID"];
    // check if the book that admin wants to delete is still in database
    try{
        $query = ("select * from book where Book_ID=?");
        $stmt = $db->prepare($query);//執行SQL語法
        $stmt->execute(array($Book_ID));
        $result = $stmt->fetchAll();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    if($result == null){
        echo "There is no such book with this book ID, please check your book ID and try again";
    }
    else{
        try{
            //delete book
            $query = ("delete from book where Book_ID=?");
            $stmt= $db->prepare($query);//執行SQL語法
            $result = $stmt->execute(array($Book_ID));

            //check if delete succeed
            $query = ("select * from book where Book_ID=?");
            $stmt = $db->prepare($query);//執行SQL語法
            $stmt->execute(array($Book_ID));
            $result = $stmt->fetchAll();
            if($result == null){
                echo "delete succeed";
            }
            else {
                echo "delete failed";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }    
?>

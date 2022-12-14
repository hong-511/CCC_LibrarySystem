<form method="post">
    <div>  
        <input type='submit' name= 'initial_page' value='Initial Page'>
        <br/><br/>
    </div>
    <div>
        <input type='submit' name= 'my_page' value='My Page'>
        <br/><br/>
    </div>
</form>
<?php
    session_start();
    date_default_timezone_set('Asia/Taipei');//set time
    include_once "../db_connect.php";//link to database
    if(isset($_POST["initial_page"]) || isset($_POST["change"]) || isset($_POST["search"]) || isset($_POST["borrow"])){     
        /****initial button was pressed****/
        echo"<form  method='post'>
        <div>
            <label><font size='3'> <strong>Book_ID :</strong> </font></label>
            <input type='text' name='Book_ID'>
        </div><br/>
        <div>
            <label><font size='3'> <strong>BookName :</strong> </font></label>
            <input type='text' name='BookName'><br/>
        </div><br/>
        <div>
            <label><font size='3'> <strong>Author :</strong> </font></label>
            <input type='text' name='Author'><br/>
        </div><br/>
        <div>
            <label for ='page'>Page</label>
            <input type='number' name='pageNumber' value = ".$_SESSION['pageNumber']." min='1' max='100'>
            <input type='submit' name= 'change' value='Change'>
        </div>";
        if(isset($_POST["change"])){/****change page button was pressed****/
            $_SESSION['pageNumber'] = $_POST["pageNumber"];
        }
        else if(isset($_POST["search"])){/****search button was pressed****/
            $_SESSION["Book_ID"]= $_POST["Book_ID"];
            $_SESSION["BookName"] = $_POST["BookName"];
            $_SESSION["Author"] = $_POST["Author"];
        }
        else if(isset($_POST["borrow"])){
            /****borrow button was pressed****/
            $borrowIDlist = $_POST["borrowIDlist"];
            /****update book status****/
            $query = ("update book set Status = 'issued' where Book_ID= ?");
            $stmt= $db->prepare($query);//執行SQL語法
            foreach($borrowIDlist as $Book_ID){
                $result = $stmt->execute(array($Book_ID));
            }
            /****insert borrow information into process table****/
            $query = ("select count(*) as number from process");//how many data in process
            $stmt= $db->prepare($query);//執行SQL語法
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            $Process_ID = $result[0]['number'] + 1; 
            $Reader_ID = $_SESSION['Reader_ID'];   
            $Date = date("Y/m/d");;
            $Type = "borrow";
            $Administer_ID = 1;
            $query = ("insert into process values(?,?,?,?,?,?)");
            $stmt= $db->prepare($query);//執行SQL語法
            foreach($borrowIDlist as $Book_ID){
                $result = $stmt->execute(array($Process_ID++,$Reader_ID,$Book_ID,$Administer_ID,$Date,$Type));
            }
            echo "Borrowing is successful<br/>";
        }
        else{
            $_SESSION['pageNumber'] = 1;
            $_SESSION["Book_ID"]= null;
            $_SESSION["BookName"] = null;
            $_SESSION["Author"] = null;
        }
        /*search result from database*/
        $Book_ID = $_SESSION["Book_ID"];
        $BookName = $_SESSION["BookName"];
        $Author = $_SESSION["Author"];
        $count = 0;
        $array = [];
        if($Book_ID != NULL){
            if($count != 0)
                $part1 = " and ";
            else
                $part1 = "";
            $part1 = $part1." Book_ID=? ";
            $array[$count++] = $Book_ID;
            
        }
        else{
            $part1 = "";
        }
        if($BookName != NULL){
            if($count != 0)
                $part2 = " and ";
            else
                $part2 = "";
            $part2 = $part2." BookName like ? ";
            $array[$count++] = "%".$BookName."%";
        }
        else{
            $part2 = "";
        }
        if($Author != NULL){
            if($count != 0)
                $part3 = " and ";
            else
                $part3 = "";
            $part3 = $part3." Author like ? ";
            $array[$count++] = "%".$Author."%";
        }
        else{
            $part3 = "";
        }
        if($count == 0){
            $query = ("select * from book ");
            $stmt= $db->prepare($query);//執行SQL語法
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        else{
            $query = ("select * from book where ".$part1.$part2.$part3);
            //echo $query."<br/> ";
            $stmt= $db->prepare($query);//執行SQL語法
            if($count == 1){
                $stmt->execute(array($array[0]));
            }
            else if($count == 2){
                $stmt->execute(array($array[0], $array[1]));
            }
            else if($count == 3){
                $stmt->execute(array($array[0], $array[1], $array[2]));
            }
            $result = $stmt->fetchAll();
        }
        $page = $_SESSION['pageNumber'];
        echo"Now Page : $page<br/>";
        $offset = ($page-1)*20;         
        if($result != NULL){
            if($offset > count($result)){
                echo"Don't have this page !!!";
            }
            else{
                echo"<table border='5'>
                <tr>
                    <th>Select</th>
                    <th>Book_ID</th>
                    <th>BookName</th>
                    <th>Author</th>
                    <th>Status</th>
                </tr>";
                for($i=0; $i<20 && $i+$offset <count($result); $i++){
                    echo"<tr>";
                    if($result[$i+$offset]['Status'] == 'available')
                        echo"<td><input type = 'checkbox' name='borrowIDlist[]' value = ".$result[$i+($page-1)*20]['Book_ID']."></td>"; 
                    else
                        echo"<td><input type = 'checkbox' name='borrowIDlist[]' value = ".$result[$i+($page-1)*20]['Book_ID']." disabled></td>"; 
                    echo"<td>".$result[$i+$offset]['Book_ID']."</td>";
                    echo"<td>".$result[$i+$offset]['BookName']."</td>";
                    echo"<td>".$result[$i+$offset]['Author']."</td>";
                    echo"<td>".$result[$i+$offset]['Status']."</td>";
                    echo"</tr>";
                }
                    echo"</table>";
            }
            
        }
        else
            echo"NO result<br/>";

        echo"<div>  
            <input type='submit' name='search' value='Search'>
            <input type='submit' name='borrow' value='Borrow'>
        </div>
        </form>";
    }
    else if(isset($_POST["my_page"]) || isset($_POST["return"]) ){
        if(isset($_POST["return"])){
            /****return button was pressed****/
            $returnIDlist = $_POST["returnIDlist"];
            /****update book status****/
            $query = ("update book set Status = 'available' where Book_ID= ?");
            $stmt= $db->prepare($query);//執行SQL語法
            foreach($returnIDlist as $Book_ID){
                $result = $stmt->execute(array($Book_ID));
            }
            /****insert return information into process table****/
            $query = ("select count(*) as number from process");//how many data in process
            $stmt= $db->prepare($query);//執行SQL語法
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            $Process_ID = $result[0]['number'] + 1; 
            $Reader_ID = $_SESSION['Reader_ID'];   
            $Date = date("Y/m/d");;
            $Type = "return";
            $Administer_ID = 1;
            $query = ("insert into process values(?,?,?,?,?,?)");
            $stmt= $db->prepare($query);//執行SQL語法
            foreach($returnIDlist as $Book_ID){
                $result = $stmt->execute(array($Process_ID++,$Reader_ID,$Book_ID,$Administer_ID,$Date,$Type));
            }
            echo "Returning is successful<br/>";
        }
        /*select book ID that user borrowed */
        $query = 
        ("(SELECT Book_ID, COUNT(Book_ID) AS number FROM process WHERE Reader_ID = ? AND Type = 'borrow' GROUP BY Book_ID) 
            except 
          (SELECT Book_ID, COUNT(Book_ID) AS number FROM process WHERE Reader_ID = ? AND Type = 'return' GROUP BY Book_ID)");
        $stmt= $db->prepare($query);//執行SQL語法   
        $stmt->execute(array($_SESSION['Reader_ID'],$_SESSION['Reader_ID']));
        $result = $stmt->fetchAll();
        $result_ID = $result;
        /*output book ID that user didn't return*/
        $query = ("select Book_ID, BookName, Author from book where Book_ID = ?");
        $stmt= $db->prepare($query);//執行SQL語法
        echo"<form  method='post'>";
            echo"<table border='5'>
                <tr>
                    <th>Select</th>
                    <th>Book_ID</th>
                    <th>BookName</th>
                    <th>Author</th>
                </tr>";
            for($i=0; $i<count($result_ID); $i++){
                $stmt->execute(array($result_ID[$i]['Book_ID']));
                $result = $stmt->fetchAll();
                echo"<tr>";
                echo"<td><input type = 'checkbox' name='returnIDlist[]' value = ".$result[0]['Book_ID']."></td>"; 
                echo"<td>".$result[0]['Book_ID']."</td>";
                echo"<td>".$result[0]['BookName']."</td>";
                echo"<td>".$result[0]['Author']."</td>";
                echo"</tr>";
            }   
            echo"</table>"; 
        echo"<div>  
            <input type='submit' name='return' value='Return Book'>
        </div>
        </form>";
    }
?>

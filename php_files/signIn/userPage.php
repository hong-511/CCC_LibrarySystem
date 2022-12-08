<!-- Borrow -->
<form  action=/signIn/user_process/borrow.php method="post">
        
        <?php
            echo "This is for borrow.<br/>";
        ?>
        <div>
            <label><font size="3"> <strong>Book_ID :</strong> </font></label>
            <input type="text" name="Book_ID" />
        </div><br/>
        
        <!-- submit -->
        <div>
            <input type="submit" value="Borrow">
        </div>
</form>

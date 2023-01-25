<?php
    session_start();
	
    $_SESSION['Reader_ID']=null;
    if(isset($_SESSION['Reader_ID'])){
        echo "session-ReaderID reset failed";
    }
    else{
        echo "reset succeed";
    }
?>

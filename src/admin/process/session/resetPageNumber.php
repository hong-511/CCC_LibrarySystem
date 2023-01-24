<?php
    session_start();
    $_SESSION['pageNumber']=1;
    if(isset($_SESSION['pageNumber'])){
        echo "page number set";
    }
    else{
        echo "session-pageNumber reset failed";
    }
?>
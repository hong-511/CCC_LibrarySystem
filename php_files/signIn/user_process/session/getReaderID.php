<?php
    session_start();
    if(isset($_SESSION['Reader_ID'])){
        echo "logged in";
    }
    else{
        echo "not logged in";
    }
?>
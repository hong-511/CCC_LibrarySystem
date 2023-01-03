<?php
    session_start();
    $_SESSION["Book_ID"]= $_POST["Book_ID"];
    $_SESSION["BookName"] = $_POST["BookName"];
    $_SESSION["Author"] = $_POST["Author"];
    echo "set input finished"
?>
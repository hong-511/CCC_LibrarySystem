<?php
    session_start();
    $currentPage = $_SESSION['pageNumber'];
    $_SESSION['pageNumber'] = $currentPage + 1;
    echo "next Page success";
?>
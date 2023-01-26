<?php
    session_start();
    $currentPage = $_SESSION['pageNumber'];
    $newPage = $currentPage + 1;
    $maxPageNumber = $_SESSION['maxPageNumber'];
    if($newPage <= $maxPageNumber){
        $_SESSION['pageNumber'] = $newPage;
        echo "next Page success";
    }
    else{
        echo "This is the end of the search result"; 
    }
?>
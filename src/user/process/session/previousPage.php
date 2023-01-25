<?php
    session_start();
    $currentPage = $_SESSION['pageNumber'];
    if ($currentPage >= 2){
        $_SESSION['pageNumber'] = $currentPage - 1;
    }
    echo "previous Page success";
?>
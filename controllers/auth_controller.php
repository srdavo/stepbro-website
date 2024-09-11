<?php
function checkSession(){
    if (!isset($_SESSION["id"])) {
        $currentPage = basename($_SERVER['PHP_SELF']);
        $allowedPages = ['index.php'];
        if (!in_array($currentPage, $allowedPages)) {
            header ("location: index");        
            exit();
        }
    }else{
        $currentPage = basename($_SERVER['PHP_SELF']);
        $allowedPages = ['index.php'];
        if (in_array($currentPage, $allowedPages)) {
            header ("location: home");
            exit();
        }  
    }
}

?>
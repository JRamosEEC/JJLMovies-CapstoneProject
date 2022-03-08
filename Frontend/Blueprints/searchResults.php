<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");

    $searchTxt = $_GET['searchTxt'];

    $searchResults = searchMovie($searchTxt);

    
?>
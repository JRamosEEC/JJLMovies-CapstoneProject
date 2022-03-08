<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");

    $searchTxt = $_GET['searchTxt'];

    $searchResults = searchMovie($searchTxt);

    $resultHtmlStr = "";

    foreach($searchResults as $row){
        $resultHtmlStr=$row['UserAccountID'];//getting the userAccount id from the accounts table
    }

    echo $searchTxt;
?>
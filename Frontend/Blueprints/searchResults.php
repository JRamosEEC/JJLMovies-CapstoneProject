<?php
    require (__DIR__ . "/../../Backend/dbQuery.php");

    $searchTxt = $_GET['searchTxt'];

    $searchResults = searchMovie($searchTxt);

    foreach($searchResults as $row){
        $userID=$r['UserAccountID'];//getting the userAccount id from the accounts table
    }
?>
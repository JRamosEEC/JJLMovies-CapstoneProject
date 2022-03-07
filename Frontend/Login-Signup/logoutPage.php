<?php

    session_start();

    unset($_SESSION['user']);
    unset($_SESSION['FName']);
    unset($_SESSION['LName']);

    session_destroy();

    header("Location: ../MoviePage/homePage.php");
?>

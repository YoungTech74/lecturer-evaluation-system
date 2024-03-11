<?php
    include_once '../connection.php';

    if(!$_SESSION['lecturer_user']){
        header('location: ../login.php');
    }
?>
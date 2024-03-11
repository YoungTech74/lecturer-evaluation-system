<?php
    include_once '../connection.php';

    if(!$_SESSION['HOD_user']){
        header('location: ../index.php');
    }
?>
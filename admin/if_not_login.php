<?php
    include_once '../connection.php';

    if(!$_SESSION['admin_user']){
        header('location: ../index.php');
    }
?>
<?php
    include_once '../connection.php';

    if(!$_SESSION['student_user']){
        header('location: ../index.php');
    }
?>
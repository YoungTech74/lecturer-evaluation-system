<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'lecturer_eva_db');
if(!$conn){
    die(mysqli_error($conn));
}
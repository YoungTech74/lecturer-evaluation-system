<?php
      include_once './if_not_login.php';
include_once '../connection.php';

$message = "";
$id = $_GET['program_id'];

$deleteCourse = mysqli_query($conn, "DELETE FROM program_list WHERE id = '$id';") or die(mysqli_error($conn));
if ($deleteCourse) {
    $message = true;
}

if (isset($message)) {
    $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show"">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        program Deleted Successfully
    </div>';
    ?>
    <script>
    setTimeout(() => {
            window.location = './program.php'
            }, 10);
        </script>
    <?php

}
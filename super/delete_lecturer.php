<?php
      include_once './if_not_login.php';
include_once '../connection.php';
$message = "";

$id = $_GET['lecturer_id'];

$deleteCourse = mysqli_query($conn, "DELETE FROM lecturers WHERE id = '$id';") or die(mysqli_error($conn));
if($deleteCourse){
    $message = "";
}

if (isset($message)) {
    $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show"">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Lecturer Deleted Successfully
    </div>';
    ?>
    <script>
    setTimeout(() => {
            window.location = './lecturer_list.php'
            }, 10);
        </script>
    <?php

}
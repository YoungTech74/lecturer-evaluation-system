<?php
include_once 'connection.php';

// error_reporting(0);
    $error = "";

    if(isset($_POST['proceedBtn'])){

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);


    

            $adminCount = 0;
            $checkAdmin =  "SELECT * FROM admins WHERE admins.username = '".$username."' && admins.user_type = '".$user_type."'" or die(mysqli_error($conn));
            $adminResult = mysqli_query($conn, $checkAdmin);
            $adminCount = mysqli_num_rows($adminResult);
            $adminRow = mysqli_fetch_assoc($adminResult);


            $userCount = 0;
            $checkUser =  "SELECT * FROM users WHERE users.username = '".$username."' && users.user_type = '".$user_type."'" or die(mysqli_error($conn));
            $userResult = mysqli_query($conn, $checkUser);
            $userCount = mysqli_num_rows($userResult);
            $userRow = mysqli_fetch_assoc($userResult);

            
            $hodCount = 0;
            $checkHod =  "SELECT * FROM hod_list WHERE hod_list.hod_name = '".$username."' && hod_list.user_type = '".$user_type."'" or die(mysqli_error($conn));
            $hodResult = mysqli_query($conn, $checkHod);
            $hodCount = mysqli_num_rows($hodResult);
            $hodRow = mysqli_fetch_assoc($hodResult);

            
            $lecturerCount = 0;
            $checkLecture =  "SELECT * FROM lecturers WHERE lecturers.lecturer_name = '".$username."' && lecturers.user_type = '".$user_type."'" or die(mysqli_error($conn));
            $lecturerResult = mysqli_query($conn, $checkLecture);
            $lecturerCount = mysqli_num_rows($lecturerResult);
            $lecturerRow = mysqli_fetch_assoc($lecturerResult);
            
            if($userCount === 1 || $adminCount === 1 || $hodCount === 1 || $lecturerCount === 1){
            
                if($adminRow['user_type'] === 'Admin'){
                    $_SESSION['admin_id'] = $adminRow['id'];
                    header('location: ./admin/new_password.php');

                }else if($hodRow['user_type'] === 'HOD') {
                  $_SESSION['HOD_id'] = $hodRow['id'];
                  header('location: ./hod/new_password.php');

                }else if($lecturerRow['user_type'] === 'Lecturer'){
                  $_SESSION['lecturer_id'] = $lecturerRow['l_id'];
                    header('location: ./lecturer/new_password.php');

                }else if($userRow['user_type'] === 'Student'){
                  $_SESSION['student_id'] = $userRow['id'];
                  header('location: ./student/new_password.php');
                }else {
                  $error = '<div class="alert alert-danger alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Invalid login Details
                  </div>';
                }
      
        }else {
          $error = '<div class="alert alert-danger alert-dismissible fade show"">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Invalid login Details
        </div>';
        }
 

        }
       
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./include/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

    <h5 class="login-box-msg">Enter Your Details to Proceed</h5>
        <h5 class="text-danger"><?php echo $error ;?></h5>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>


           <div class="input-group mb-3">
          <select name="user_type" id="user_type" class="form-select form-control form-control-sm" required>
            <option>Select User Type</option>
            <option value="Admin">Admin</option>
            <option value="HOD">HOD</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-4" style="margin: auto; margin-bottom: 10px;">
            <button type="submit" name="proceedBtn" class="btn btn-primary btn-block">Proceed</button>
          </div>
          
        </div>
      </form>
     

      <p class="mb-1">
        <a style="margin-left: 27%;" href="login.php">I Remember my password</a>
      </p>
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->




<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>

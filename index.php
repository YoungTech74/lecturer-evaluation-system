<?php
// session_start();

include_once './connection.php';

    $error = "";
 

    if(isset($_POST['loginBtn'])){

      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $hashPassword = md5($password);



          $adminCount = 0;
          $checkAdmin =  "SELECT * FROM admins WHERE admins.username = '".$username."' && admins.password = '".$hashPassword."'" or die(mysqli_error($conn));
          $adminResult = mysqli_query($conn, $checkAdmin);
          $adminRow = mysqli_fetch_assoc($adminResult);
          $adminCount = mysqli_num_rows($adminResult);


          $userCount = 0;
          $checkUser =  "SELECT * FROM users WHERE users.username = '".$username."' && users.password = '".$hashPassword."'" or die(mysqli_error($conn));
          $userResult = mysqli_query($conn, $checkUser);
          $userRow = mysqli_fetch_assoc($userResult);
          $userCount = mysqli_num_rows($userResult);

          
          $hodCount = 0;
          $checkHod =  "SELECT * FROM hod_list WHERE hod_list.hod_name = '".$username."' && hod_list.password = '".$hashPassword."'" or die(mysqli_error($conn));
          $hodResult = mysqli_query($conn, $checkHod);
          $hodRow = mysqli_fetch_assoc($hodResult);
          $hodCount = mysqli_num_rows($hodResult);

          
          $lecturerCount = 0;
          $checkLecture =  "SELECT * FROM lecturers WHERE lecturers.lecturer_name = '".$username."' && lecturers.password = '".$hashPassword."'" or die(mysqli_error($conn));
          $lecturerResult = mysqli_query($conn, $checkLecture);
          $lecturerRow = mysqli_fetch_assoc($lecturerResult);
          $lecturerCount = mysqli_num_rows($lecturerResult);
          
          if($userCount === 1 || $adminCount === 1 || $hodCount === 1 || $lecturerCount === 1){
          
              if($adminRow['user_type'] == 'Admin'){
                  // $_SESSION['Admin'] = $username;
                  $_SESSION['admin_id'] = $adminRow['id'];
                  $_SESSION['admin_user'] = $adminRow['username'];
                  $_SESSION['admin_level'] = $adminRow['level'];
                  $_SESSION['admin_program'] = $adminRow['program'];
                  $_SESSION['admin_dep'] = $adminRow['department'];
                  $_SESSION['admin_fullname'] = $adminRow['full_name'];
                  header('location: ./admin/dashboard.php');

              }else if($adminRow['user_type'] == 'Super') {
                $_SESSION['admin_id'] = $adminRow['id'];
                $_SESSION['admin_user'] = $adminRow['username'];
                $_SESSION['admin_level'] = $adminRow['level'];
                $_SESSION['admin_program'] = $adminRow['program'];
                $_SESSION['admin_dep'] = $adminRow['department'];
                $_SESSION['admin_fullname'] = $adminRow['full_name'];
                header('location: ./super/dashboard.php');

                }else if($hodRow['user_type'] == 'HOD') {
                  $_SESSION['HOD_user'] = $hodRow['hod_name'];
                  $_SESSION['HOD_dep'] = $hodRow['department'];
                  header('location: HOD/dashboard.php');

              }else if($lecturerRow['user_type'] == 'Lecturer'){
                $_SESSION['lecturer_user'] = $lecturerRow['lecturer_name'];  
                $_SESSION['lecturer_level'] = $lecturerRow['level']; 
                $_SESSION['lecturer_program'] = $lecturerRow['program'];
                $_SESSION['lecturer_dep'] = $lecturerRow['department']; 
                header('location: lecturer/dashboard.php');

              }else if($userRow['user_type'] == 'Student'){
                $_SESSION['user_id'] = $userRow['id'];  
                $_SESSION['student_user'] = $userRow['username'];  
                $_SESSION['student_level'] = $userRow['level']; 
                $_SESSION['student_program'] = $userRow['program']; 
                $_SESSION['student_dep'] = $userRow['department']; 
                header('location: student/dashboard.php');
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
  <title>Log In</title>

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
        <img src="./images/images.jpeg" alt="" style="margin-left: 25%; border-radius: 50%; margin-bottom: 5px; height: 130px; width: 130px;">
      <h1 class="login-box-msg">Sign In</h1>
        <h5 id="geterr" class="text-danger m-auto" >
        <small><?php echo $error; ?></small>
      <form action="" method="POST" id="mform" >

        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username"  name="username" placeholder="Username" required>
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

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-4" style="margin: auto; margin-bottom: 10px;">
            <input type="submit" name="loginBtn" class="btn btn-primary btn-block" value="SignIn">
          </div>
          
        </div>
      </form>
     

      <p class="mb-1">
        <a style="margin-left: 20%;" href="forgot_password.php">I forgot my password</a>
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

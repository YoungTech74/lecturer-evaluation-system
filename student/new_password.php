<?php
include_once '../connection.php';

// error_reporting(0);
    $error = "";
    $message = "";

    $userId = $_SESSION['student_id'];
  
    $getUserDetails = "SELECT * FROM users WHERE id = '$userId';" or die(mysqli_error($conn));
    $result2 = mysqli_query($conn, $getUserDetails);


       
if (isset($_POST['newPasswordBtn'])) {
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $new_password_confirm = mysqli_real_escape_string($conn, $_POST['new_password_confirm']);


    $new_password_hash = md5($new_password);
    

    if ($new_password !== $new_password_confirm) {
         $error = 'Password do Not match!';
    } else {
        $updatePassword = "UPDATE users SET password = '$new_password_hash' WHERE id ='$userId';" or die(mysqli_error($conn));
        $updateResult = mysqli_query($conn, $updatePassword);

        if ($updateResult) {
              $message = '<div class="alert alert-success alert-dismissible fade show text-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Your Password has been changed Successfully
            </div>';
            ?>
                <script>
                    setTimeout(() => {
                        window.location = '../index.php';
                    }, 2000);
                </script>
            <?php
        
        } else {
          $message = '<div class="alert alert-danger alert-dismissible fade show"">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Something went wrong while changing your password
      </div>';
      ?>
          <script>
              setTimeout(() => {
                  window.location = './new_password.php';
              }, 4000);
          </script>
      <?php
        }
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
    <span><?php echo $message; ?></span>
    <h5 class="login-box-msg">Choose New password</h5>
        <h6 class="text-danger" style="margin-left: 20%; padding: 5px; font-size: italic;" ><?php echo $error ;?></h5>

      <form action="" method="POST">

      <div class="input-group mb-3">
          <input type="hidden" class="form-control" name="id" placeholder="Username" required value="<?php echo $id; ?>">
        </div>


        <div class="input-group mb-3">
          <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="new_password_confirm" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-4" style="margin: auto; margin-bottom: 10px;">
            <button type="submit" name="newPasswordBtn" class="btn btn-primary btn-block">Change</button>
          </div>
          
        </div>
      </form>
     

      <p class="mb-1">
        <a style="margin-left: 27%;" href="../index.php">I Remember my password</a>
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

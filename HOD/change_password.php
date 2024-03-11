<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $message = "";
      $notMatched = "";

      

    if (isset($_POST['reset_password'])) {

        $password = md5($_POST['old_password']);
        $newpassword = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $username = $_SESSION['HOD_user'];

        if ($newpassword !== $confirm_password) {
            $notMatched = 'Password do not match!';
        } else {
            $sql = mysqli_query($conn, "SELECT * FROM hod_list WHERE hod_name = '$username' AND Password = '$password'");


            if (mysqli_num_rows($sql) > 0) {
                $updatePassword = mysqli_query($conn, "UPDATE hod_list SET password = '$newpassword' WHERE hod_name = '$username' AND Password = '$password'");
                if ($updatePassword) {
                    $message = '<div class="alert alert-success bg-success" style="background: green;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Your Password has been updated successfully!
                </div>';
                    ?>
                <script>
                    setTimeout(() => {
                        window.location = '../index.php';
                    }, 2000);
                </script>
            <?php

                }
            } else {
                $message = '<div class="alert alert-danger bg-danger" style="background: red;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Your old Password is incorrect!.
                </div>';
                ?>
                <script>
                    setTimeout(() => {
                        document.getElementById('getMessage').style.display = 'none';
                    }, 3000);
                </script>
            <?php
            }
        }
    }


    ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-4 text-center">Reset Your Password</h3>
            <span id="getMessage"><?php echo $message; ?></span>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Old Password</label>
							<input type="password" name="old_password" class="form-control form-control-sm" required>
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">New Password</label>
							<input type="password" name="new_password" class="form-control form-control-sm" required value="">
						</div>  
					</div>

                      
                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control form-control-sm" required>
                            <small class="text-danger"><?php echo $notMatched; ?></small>
						</div>  
					</div>

				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="reset_password">Change Now</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './dashboard.php'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div><br><br><br><br> <br><br><br><br>
<?php
           include_once './include/js_libraries.php';
            include_once 'footer.php';
    ?>

</body>
</html>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>

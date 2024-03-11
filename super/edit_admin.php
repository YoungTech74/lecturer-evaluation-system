<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $message = "";
      $notMatch = "";

      $username = "";
      $department = "";
      $program = "";
      $level = "";
      $password = "";
      
      $admin_id = $_GET['admin_id'];
      $getAdmin = mysqli_query($conn, "SELECT * FROM admins WHERE id = '$admin_id'");
      while($admin = mysqli_fetch_assoc($getAdmin)){
        $username = $admin['username'];
        $department = $admin['department'];
        $program = $admin['program'];
        $level = $admin['level'];
        $password = $admin['password'];
      }

      if(isset($_POST['UpdateAdmin'])){

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // $password_hash = md5($password);

         if($password !== $confirm_password){
            $notMatch = 'Password do not match!';
        } else{
            $updateAdmin = mysqli_query($conn, "UPDATE admins SET username = '$username', department = '$department', program = '$program', level = '$level', user_type = 'Admin', password = '$password', date_created = current_timestamp() WHERE id = '$admin_id';");
            if($updateAdmin){

                $message = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Your Profile Has been Updated Successfully.
            </div>';
            ?>
                <script>
                    setTimeout(() => {
                       window.location = '../login.php';
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
            <h3 class="float-left p-2">Update Profile</h3>
            <span id="message"><?php echo $message; ?></span>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Admin Name</label>
							<input type="text" name="username" class="form-control form-control-sm" required value="<?php echo $username; ?>">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Department</label>
							<input type="text" name="department" class="form-control form-control-sm" readonly value="<?php echo $department; ?>">
						</div>  
					</div>


                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Program</label>
							<input type="text" name="program" class="form-control form-control-sm" readonly value="<?php echo $program; ?>">
						</div>  
					</div>


                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Level</label>
							<input type="text" name="level" class="form-control form-control-sm" readonly value="<?php echo $level; ?>">
						</div>  
					</div>


                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" class="form-control form-control-sm" required value="<?php echo $password; ?>">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control form-control-sm" required value="<?php echo $password; ?>">
						</div>  <small style="font-tyle: italic; color: red;"><?php echo $notMatch; ?></small>
					</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="UpdateAdmin">Update</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './admin_list.php'">Cancel</button>
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

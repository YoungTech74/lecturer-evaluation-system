<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $message = "";
      $notMatch = "";
      

      if(isset($_POST['addUser'])){

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $password_hash = md5($password);

        $count = 0;
        $checkUser = "SELECT * FROM users WHERE  reg_no = '$reg_no' && users.admin_id = '$_SESSION[admin_id]';";
        $result = mysqli_query($conn, $checkUser);

        $count = mysqli_num_rows($result);
        if($count > 0){
            $message = '<div class="alert alert-danger alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                User already exist with this Registration Number.
            </div>';
            ?>
            <script>
            setTimeout(() => {
                document.getElementById('message').style.display = 'none';
                    }, 4000);
                </script>
            <?php

        }else if($password !== $confirm_password){
            $notMatch = 'Password do not match!';
        } else{
            $today = date("Y-m-d");
            $insertUser = mysqli_query($conn, "INSERT INTO users VALUES(0, '$_SESSION[admin_id]', '$username', '$reg_no', '$department', '$program', '$level', 'Student', '$password_hash', '$today');");
            if($insertUser){

                $message = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Student Added Successfully.
            </div>';
            ?>
                <script>
                    setTimeout(() => {
                        document.getElementById('message').style.display = 'none';
                    }, 4000);
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
            <h3 class="float-left p-2">New Student</h3>
            <span id="message"><?php echo $message; ?></span>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Student Name</label>
							<input type="text" name="username" class="form-control form-control-sm" required value="">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Registration Number</label>
							<input type="text" name="reg_no" class="form-control form-control-sm" required value="">
						</div>  
					</div>

                        <?php
                            $getAdminRecords = mysqli_query($conn, "SELECT * FROM admins");
                            while($admin = mysqli_fetch_assoc($getAdminRecords)){
                                $department = $admin['department'];
                                $program = $admin['program'];
                                $level = $admin['level'];
                            }
                        ?>
                    
                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Department</label>
							<input type="text" name="department" class="form-control form-control-sm" readonly value="<?php echo $department; ?>">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">program</label>
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
							<input type="password" name="password" class="form-control form-control-sm" required value="">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control form-control-sm" required value="">
						</div>  <small style="font-tyle: italic; color: red;"><?php echo $notMatch; ?></small>
					</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addUser">Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './student_list.php'">Cancel</button>
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

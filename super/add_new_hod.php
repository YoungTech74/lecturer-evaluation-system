<?php
    include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

    $success = "";
    $notMatchPassword = "";

      if(isset($_POST['addHodBtn'])){

        $hod_name = mysqli_real_escape_string($conn, $_POST['hod_name']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        $password_hash = md5($password);

        $count = 0;
        $getRecord = mysqli_query($conn, "SELECT * FROM hod_list WHERE hod_name = '$hod_name' && department = '$department' && admin_id = '$_SESSION[admin_id]'");
      
            if(mysqli_num_rows($getRecord) > 0){
               $success = '<div class="alert alert-danger alert-dismissible fade show"">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            HOD with these information already exist!
                        </div>';
                ?>
                    <script>
                        setTimeout(() => {
                            document.getElementById('success').style.display = 'none';
                        }, 5000);
                    </script>
                <?php
            }else if($password !== $confirm_password){
                $notMatchPassword = 'Password does not match!';

            }else {
                $insertRecord = mysqli_query($conn, "INSERT INTO hod_list VALUES(0, '$_SESSION[admin_id]', '$hod_name', '$department', '$password_hash', 'HOD', current_timestamp());");
                if($insertRecord){
                    $success = '<div class="alert alert-success alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    New HOD Added successfully.
                </div>';

                ?>
                    <script>
                        setTimeout(() => {
                            document.getElementById('success').style.display = 'none';
                        }, 5000);
                    </script>
                <?php
                }
            }
        }
    //   }
  ?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New HOD</h3>
           
           <!-------------------------- display success message -------------------- -->
                
                <span id="success"><?php echo $success; ?></span>
                
			<form action="" method="POST">
				
				<div class="row">

					<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">HOD Name</label>
							<input type="text" name="hod_name" id="lecturer_name" class="form-control form-control-sm" required value="">
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

                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" id="lecturer_name" class="form-control form-control-sm" required value="">
						</div>

					</div>
                

                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" id="lecturer_name" class="form-control form-control-sm" required value="">
						</div><small class="text-danger"><?php echo $notMatchPassword; ?></small>

					</div>
                

				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addHodBtn" > Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './hod_list.php'">Cancel</button>
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


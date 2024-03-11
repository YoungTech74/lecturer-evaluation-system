<?php
        include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

    $success = "";
    $notMatchPassword = "";

      if(isset($_POST['addLecturerBtn'])){

        $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        $password_hash = md5($password);


        $count = 0;
        $getRecord = mysqli_query($conn, "SELECT * FROM lecturers WHERE lecturer_name = '$lecturer_name' && department = '$department' && course_title = '$course_title' && course_code = '$course_code' && program = '$program' && level = '$level'");
      
            if(mysqli_num_rows($getRecord) > 0){
               $success = '<div class="alert alert-danger alert-dismissible fade show"">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Lecturer with these information already exist!
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
                $percentile = round(100, 2);
                $insertRecord = mysqli_query($conn, "INSERT INTO lecturers VALUES(0, '$_SESSION[admin_id]', '$lecturer_name', '$department', '$program', '$level', '$course_code', '$course_title', '$percentile%', 'Lecturer', '$password_hash', current_timestamp());");
                if($insertRecord){
                    $success = '<div class="alert alert-success alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    New Lecturer Added successfully.
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
            <h3 class="float-left p-2">New Lecturer</h3>
           
           <!-------------------------- display success message -------------------- -->
                
                <span id="success"><?php echo $success; ?></span>
                
			<form action="" method="POST">
				
				<div class="row">

					<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Lecturer Name</label>
							<input type="text" name="lecturer_name" id="lecturer_name" class="form-control form-control-sm" required value="">
						</div>
					</div>
                

                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<select name="course_title" id="course_code" class="form-select form-control-sm" required >
                                <option>Select Course Title</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM course_list WHERE admin_id = '$_SESSION[admin_id]';");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['course_title']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>

                    

                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Course Code</label>
							<select name="course_code" id="course_code" class="form-select form-control-sm" required >
                                <option>Select Course Code</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM course_list WHERE admin_id = '$_SESSION[admin_id]';");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['course_code']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>


                    <?php
                            $getAdminRecords = mysqli_query($conn, "SELECT * FROM admins WHERE admins.id = '$_SESSION[admin_id]'");
                            while($admin = mysqli_fetch_assoc($getAdminRecords)){
                                $department = $admin['department'];
                                $program = $admin['program'];
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
					<button class="btn btn-primary mr-2" type="submit" name="addLecturerBtn" > Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './lecturer_list.php'">Cancel</button>
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


<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

    $success = "";
    $notMatchPassword = "";
    $lecturer_name = "";
    $department = "";
    $course_title = "";
    $course_code = "";

    $id = $_GET['lecturer_id'];

    $getLecturer = mysqli_query($conn, "SELECT * FROM lecturers WHERE l_id = '$id'");
    while($lecturer = mysqli_fetch_assoc($getLecturer)){
        $lecturer_name = $lecturer['lecturer_name'];
        $department = $lecturer['department'];
        $course_title = $lecturer['course_title'];
        $course_code = $lecturer['course_code'];
        $passworddb = $lecturer['password'];
    }

    // $oldPassword = md5($passworddb);

      if(isset($_POST['updateLecturerBtn'])){

        $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        $password_hash = md5($password);

    
                $updateRecord = mysqli_query($conn, "UPDATE  lecturers SET lecturer_name = '$lecturer_name', course_code = '$course_code', course_title = '$course_title', password = '$password' WHERE l_id = '$id';");
                if($updateRecord){
                    $success = '<div class="alert alert-success alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Lecturer Record Updated successfully.
                </div>';

                ?>
                    <script>
                        setTimeout(() => {
                            window.location = './lecturer_list.php';
                        }, 5000);
                    </script>
                <?php
                }
            }

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
							<input type="text" name="lecturer_name" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $lecturer_name; ?>">
						</div>
					</div>
                

                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<select name="course_title" id="course_code" class="form-select form-control-sm" required >
                                <option><?php echo $course_title; ?></option>
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
                                <option><?php echo $course_code; ?> </option>
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

                    
                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $passworddb; ?>">
						</div>

					</div>
                

                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="text" name="confirm_password" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $passworddb; ?>">
						</div><small class="text-danger"><?php echo $notMatchPassword; ?></small>

					</div>
                
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-info mr-2" type="submit" name="updateLecturerBtn" > Update</button>
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


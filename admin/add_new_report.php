<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 


      $message = "";

      if(isset($_POST['addReport'])){

        $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $lecture_hall = mysqli_real_escape_string($conn, $_POST['lecture_hall']);
        $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);
        $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);


        //----------------------------- get lecturer id from lecturers table ------------------------
        $get_lecturer_id = mysqli_query($conn, "SELECT * FROM lecturers");
        while($get_id = mysqli_fetch_assoc($get_lecturer_id)){
            $l_id = $get_id['l_id'];
        }
    

            $count = 0;
            $checkDuplicate = mysqli_query($conn, "SELECT * FROM reports WHERE course_title = '$course_title' && course_code = '$course_code' && lecturer_name = '$lecturer_name' && time_in = '$time_in' && time_out = '$time_out' && level = '$level' && lecture_hall = '$lecture_hall'");
            $count = mysqli_num_rows($checkDuplicate);
            if($count > 0){
                $message = '<div class="alert alert-danger alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    This Report Has already been Added.
                </div>';
                ?>
                    <script>
                        setTimeout(() => {
                            document.getElementById('success').style.display = 'none';
                        }, 5000);
                    </script>
                <?php
            }else {
                $pending = '<span class="btn btn-xs btn btn-info" style="padding: 5px 10px;">Pending</span>';
             ?>

             <?php
            $insertRecord = mysqli_query($conn, "INSERT INTO reports VALUES(0,'$_SESSION[admin_id]', '$department', '$course_title', '$course_code', '$lecturer_name', '$time_in', '$time_out', 0, '$level', '$lecture_hall',  'Inactive', '$pending', current_timestamp())") or die(mysqli_error($db));
            
            if($insertRecord){
                   $message = '<div class="alert alert-success alert-dismissible fade show"">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Report Added Successfully.
                        </div>';
                ?>
                    <script>
                        setTimeout(() => {
                            document.getElementById('success').style.display = 'none';
                        }, 5000);
                    </script>
                <?php
              
                //------------------------- check if lecturer details already exist---------------- 
                $check_lecturers_reports = mysqli_query($conn, "SELECT * FROM lecturers_reports WHERE admin_id = '$_SESSION[admin_id]' && l_name = '$lecturer_name' && level = '$level'");
                if(mysqli_num_rows($check_lecturers_reports) === 0){
                    mysqli_query($conn, "INSERT INTO lecturers_reports VALUES (0,  '$_SESSION[admin_id]', '$level', '$lecturer_name', 0, 0, current_timestamp())");
                }
            }else {
                $message = '<div class="alert alert-danger alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Something Went wrong!
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
      
 ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <span id="success"><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New Report</h3>
			<form action=""  method="POST">


				
				<div class="row">
     
                    <div class="col-md-4 ">
                        <div class="form-group">
							<label for="" class="control-label">Lecturer Name</label>
							<select name="lecturer_name" class="form-select form-control-sm" required>
                                <option>Select Lecturer Name</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM lecturers WHERE admin_id = '$_SESSION[admin_id]';");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['lecturer_name']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>


                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Course Code</label>
							<select name="course_code" class="form-select form-control-sm" required>
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



                    <div class="col-md-4 ">
                        <div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<select name="course_title" class="form-select form-control-sm" required>
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
			


                    
                    <?php
                            $getAdminRecords = mysqli_query($conn, "SELECT * FROM admins WHERE admins.id = '$_SESSION[admin_id]';");
                            while($admin = mysqli_fetch_assoc($getAdminRecords)){
                                $level = $admin['level'];
                                $department = $admin['department'];
                            }
                        ?>
                    

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Level</label>
							<input type="text" name="level" class="form-control form-control-sm" readonly value="<?php echo $level; ?>">
						</div>  
					</div>


                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Department</label>
							<input type="text" name="department" class="form-control form-control-sm" readonly value="<?php echo $department; ?>">
						</div>  
					</div>



                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Lecture Hall</label>
							<input type="text" name="lecture_hall" class="form-control form-control-sm" required value="">
						</div>
					</div>



                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Time In</label>
							<input type="text" name="time_in" class="form-control form-control-sm" required value="">
						</div>
					</div>

                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Time Out</label>
							<input type="text" name="time_out" class="form-control form-control-sm" required value="">
						</div>
					</div>

                   
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addReport">Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './report_list.php'">Cancel</button>
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

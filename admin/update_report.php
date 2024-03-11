<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 


      $message = "";
      $lecturer_name = "";
      $course_code = "";
      $course_title = "";
      $time_in = "";
      $time_out = "";
      $level = "";
      $lecture_hall = "";

    $report_id = $_GET['report_id'];

      $report_date = date("Y-m-d");


    $getReport = mysqli_query($conn, "SELECT * FROM reports WHERE id = '$report_id'");
	while ($row = mysqli_fetch_assoc($getReport)) {
    $lecturer_name = $row['lecturer_name'];
    $course_code = $row['course_code'];
    $course_title = $row['course_title'];
    $time_in = $row['time_in'];
    $time_out = $row['time_out'];
    $level = $row['level'];
    $lecture_hall = $row['lecture_hall'];
}

if(isset($_POST['updateReport'])){

    $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $lecture_hall = mysqli_real_escape_string($conn, $_POST['lecture_hall']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);
    $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);
    $leave_time = mysqli_real_escape_string($conn, $_POST['leave_time']);
    

   
      

        $updateRecord = mysqli_query($conn, "UPDATE  reports SET course_title = '$course_title', course_code = '$course_code', lecturer_name = '$lecturer_name', time_in = '$time_in', time_out = '$time_out', leave_time = '$leave_time', level = '$level', lecture_hall = '$lecture_hall', status =  'Active', l_status = '$status', date_created = current_timestamp() WHERE id = '$report_id'") or die(mysqli_error($db));
        if($updateRecord){
               $message = '<div class="alert alert-success alert-dismissible fade show"">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Report Updated and Uploaded Successfully.
                    </div>';
            ?>
                <script>
                    setTimeout(() => {
                        document.getElementById('success').style.display = 'none';
                        window.location = 'report_list.php';
                    }, 4000);
                </script>
            <?php

         

                if($status === 'Present'){
                    mysqli_query($conn, "UPDATE  lecturers_reports SET percentile = percentile + 5 , l_count = l_count + 1 WHERE  admin_id = '$_SESSION[admin_id]' && l_name = '$lecturer_name' && level = '$level' ") or die(mysqli_error($db));
                }else if($status === 'Absent') {
                    mysqli_query($conn, "UPDATE  lecturers_reports SET percentile = percentile - 5, l_count = l_count + 1 WHERE   admin_id = '$_SESSION[admin_id]' && l_name = '$lecturer_name' && level = '$level' ") or die(mysqli_error($db));
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
            <span id="success"><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2">
          
            <h3 class="float-left p-2">Update Report</h3>

         

            <form action=""  method="POST">
				
          
				<div class="row">
     
                <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Lecturer Name</label>
							<input type="text" name="lecturer_name" class="form-control form-control-sm" readonly value="<?php echo $lecturer_name; ?>">
						</div>
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Course Code</label>
							<input type="text" name="course_code" class="form-control form-control-sm" readonly value="<?php echo $course_code; ?>">
						</div>
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<input type="text" name="course_title" class="form-control form-control-sm"  readonly value="<?php echo $course_title; ?>">
						</div>
					</div>


                    <div class="row">

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Level</label>
							<input type="text" name="level" class="form-control form-control-sm"  readonly value="<?php echo $level; ?>">
						</div>
					</div>
				

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Lecture Hall</label>
							<input type="text" name="lecture_hall" class="form-control form-control-sm"  readonly value="<?php echo $lecture_hall; ?>">
						</div>
					</div>

                    <div class="col-md-4 border-right">

						<div class="form-group">
							<label for="" class="control-label">Status</label>
                            <select name="status" id="" class="form-select form-control-sm">
                                <option>Select Status</option>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
					</div>

                    <div class="row">

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Time In</label>
							<input type="text" name="time_in" class="form-control form-control-sm" readonly value="<?php echo $time_in; ?>">
						</div>
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Time Out</label>
							<input type="text" name="time_out" class="form-control form-control-sm" readonly value="<?php echo $time_out; ?>">
						</div>
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Time Left</label>
							<input type="text" name="leave_time" class="form-control form-control-sm" required value="">
						</div>
					</div>
                    </div>

                   
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="updateReport">Update</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './report_list.php'">Cancel</button>
				</div>
			</form>

	
		</div>


	</div>
</div>
</div>
</div>


<br><br><br><br> <br><br><br><br>
<?php 
        include_once './include/js_libraries.php';
        // include_once 'footer.php';
   ?>

</body>
</html>


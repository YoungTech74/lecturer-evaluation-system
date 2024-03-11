<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 


      $message = "";
      $lecturer_name = "";
      $course_title = "";
      $course_code = "";
      $level = "";
      $lecture_hall = "";
      $time_in = "";
      $time_out = "";

      $id = $_GET['report_id'];

      $getReport = mysqli_query($conn, "SELECT * FROM reports WHERE id = '$id'");
      while($report = mysqli_fetch_assoc($getReport)){
        $lecturer_name = $report['lecturer_name'];
        $course_title = $report['course_title'];
        $course_code = $report['course_code'];
        $level = $report['level'];
        $lecture_hall = $report['lecture_hall'];
        $time_in = $report['time_in'];
        $time_out = $report['time_out'];
      }

      if(isset($_POST['updateReport'])){

        $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $lecture_hall = mysqli_real_escape_string($conn, $_POST['lecture_hall']);
        $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);
        $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);
    

       

            $updateReport = mysqli_query($conn, "UPDATE reports SET admin_name = '$_SESSION[admin_user]', course_title = '$course_title', course_code = '$course_code', lecturer_name = '$lecturer_name', time_in = '$time_in', time_out = '$time_out', level = '$level', lecture_hall = '$lecture_hall'   WHERE id = '$id';") or die(mysqli_error($db));
            
            if($updateReport){
                   $message = '<div class="alert alert-success alert-dismissible fade show"">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Report Updated Successfully.
                        </div>';
                ?>
                    <script>
                        setTimeout(() => {
                           window.location = 'report_list.php';
                        }, 4000);
                    </script>
                <?php
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

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <span id="success"><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">Update Report</h3>
			<form action=""  method="POST">
				
				<div class="row">
     
                    <div class="col-md-4 ">
                        <div class="form-group">
							<label for="" class="control-label">Lecturer Name</label>
							<select name="lecturer_name" class="form-select form-control-sm" required>
                                <option><?php echo $lecturer_name; ?></option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM lecturers");
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
                                <option><?php echo $course_code; ?></option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM course_list");
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
                                <option><?php echo $course_title; ?></option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM course_list");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['course_title']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>
					</div>


                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Level</label>
							<select name="level" class="form-select form-control-sm" required>
                                <option><?php echo $level; ?></option>
                                <?php
                                $levels = array("100 L", "200 L", "300 L", "400 L", "500 L", "600 L");
                                    foreach($levels as $level){?>
                                        <option><?php echo $level ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>
				

                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Lecture Hall</label>
							<input type="text" name="lecture_hall" class="form-control form-control-sm" required value="<?php echo $lecture_hall; ?>">
						</div>
					</div>


                    <div class="row">

                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Time In</label>
							<input type="text" name="time_in" class="form-control form-control-sm" required value="<?php echo $time_in; ?>">
						</div>
					</div>

                    <div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Time Out</label>
							<input type="text" name="time_out" class="form-control form-control-sm" required value="<?php echo $time_out; ?>">
						</div>
					</div>

                   
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-info mr-2" type="submit" name="updateReport">Update</button>
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

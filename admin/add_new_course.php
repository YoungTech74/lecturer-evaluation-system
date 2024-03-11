<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $course_code_error = "";
      $course_title_error = "";
      $message = "";

      if(isset($_POST['addCourse'])){

        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_type = mysqli_real_escape_string($conn, $_POST['course_type']);
        $credit_unit = mysqli_real_escape_string($conn, $_POST['credit_unit']);

        if(!strlen($course_code) == 6){
            $course_code_error = "Character must be exact 6 characters!";

        }else if(!preg_match("/^[a-z A-Z]*$/", $course_title)){
            $course_title_error = "Please enter only text!";
        }else {
            $checkCourse = mysqli_query($conn, "SELECT * FROM course_list WHERE course_code = '$course_code' && course_title = '$course_title' && course_type = '$course_type' && 
            credit_unit = '$credit_unit'; ");
            if(mysqli_num_rows($checkCourse) > 0){
                $message = '<div class="alert alert-danger text-white alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        This Course has been Added already!
                </div>';
                ?>
                <script>
                setTimeout(() => {
                    document.getElementById('message').style.display = 'none';
                        }, 4000);
                    </script>
                <?php
            }else {
            $insertRecord = mysqli_query($conn, "INSERT INTO course_list VALUES(0, '$_SESSION[admin_id]', '$course_code', '$course_title', '$course_type', '$credit_unit');") or die(mysqli_error($db));
            if($insertRecord){
                 $message = '<div class="alert alert-success text-white alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    New Course Added Successfully!
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
      }
 ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <!------------------------- display error or success message  ------------------->
            <span id="message"><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New Courses</h3>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-6 border-right">

						<div class="form-group">
							<label for="" class="control-label">Course Code</label>
							<input type="text" name="course_code" class="form-control form-control-sm" required value="" minLength="6" maxLength="6">
                            <span style="font-style: italic;">Min or Max of 6 Characters.</span>
						</div>
                        
                        <div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<input type="text" name="course_title" class="form-control form-control-sm" required value="" >
						</div>
					</div>


                    <div class="col-md-6 border-right">

						<div class="form-group">
							<label for="" class="control-label">Course Type</label>
							<select name="course_type" class="form-select form-control-sm" required>
                                <option value="">Select course type</option>
                                <option value="Elective Course">Elective Course</option>
                                <option value="Core Course">Core Course</option>
                            </select>
						</div>

                        <div class="form-group">
							<label for="" class="control-label">Credit Unit</label>
							<select name="credit_unit" class="form-select form-control-sm" required>
                                <option >Select Credit Unit</option>
                                <option value="1 Unit">1 Unit</option>
                                <option value="2 Unit">2 Unit</option>
                                <option value="3 Unit">3 Unit</option>
                                <option value="4 Unit">4 Unit</option>
                                <option value="5 Unit">5 Unit</option>
                                <option value="6 Unit">6 Unit</option>
                               
                            </select>
						</div>
					</div>

				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addCourse">Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './courses.php'">Cancel</button>
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

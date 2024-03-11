<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $id = $_GET['course_id'];

      $course_code_error = "";
      $course_title_error = "";

      $course_code_value = "";
      $course_title_value = "";
      $course_type_value = "";
      $credit_unit_value = "";
      $message = "";

      $getValues =  mysqli_query($conn, "SELECT * FROM course_list WHERE id = '$id';") or die(mysqli_query($conn));
      while($row = mysqli_fetch_assoc($getValues)){
        $course_code_value = $row['course_code'];
        $course_title_value = $row['course_title'];
        $course_type_value = $row['course_type'];
        $credit_unit_value = $row['credit_unit'];
      }


      if(isset($_POST['updateCourseBtn'])){

        $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_type = mysqli_real_escape_string($conn, $_POST['course_type']);
        $credit_unit = mysqli_real_escape_string($conn, $_POST['credit_unit']);

      
            $updateRecord = mysqli_query($conn, "UPDATE course_list SET course_code = '$course_code', course_title = '$course_title', course_type = '$course_type', credit_unit = '$credit_unit' WHERE id = '$id';") or die(mysqli_error($db));
            
            if($updateRecord){
                  $message = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Records Updated Successfully.
            </div>';
            ?>
            <script>
            setTimeout(() => {
                    window.location = './courses.php'
                    }, 4000);
                </script>
            <?php

            }
        }
      
 ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <span><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2">
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-6 border-right">

                        <div class="form-group">
							<label for="" class="control-label">Course Code</label>
							<input type="text" name="course_code" class="form-control form-control-sm" required value="<?php echo $course_code_value; ?>" maxlength="6" minlength="6">
                            <span style="font-style: italic;">Min or Max of 6 characters</span>
						</div>
                        
                        <div class="form-group">
							<label for="" class="control-label">Course Title</label>
							<input type="text" name="course_title" class="form-control form-control-sm" required value="<?php echo $course_title_value; ?>" >
						</div>
					</div>

                    <div class="col-md-6 border-right">
                        

                        <div class="form-group">
                                <label for="" class="control-label">Course Type</label>
                                <select name="course_type" id="" class="form-select form-control-sm">
                                    <option><?php echo $course_type_value; ?></option>
                                    <?php
                                    $all_course_type = array("Course Core", "Elective Course");
                                    foreach ($all_course_type as $course) {?>
                                        <option value="<?php echo $course ; ?>"><?php echo $course; ?></option>
                                    <?php
                                        # code...
                                    }
                                ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="" class="control-label">Credit Unit</label>
                                <select name="credit_unit" id="" class="form-select form-control-sm">
                                    <option><?php echo $credit_unit_value; ?></option>
                                    <?php
                                    $all_credit_unit = array('1 Unit', '2 Unit', '3 Unit', '4 Unit', '5 Unit', '6 Unit');
                                    foreach($all_credit_unit as $credit){?>
                                        <option value="<?php echo $credit; ?>"><?php echo $credit; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="" class="control-label">Credit Unit</label>
							<input type="text" name="credit_unit" class="form-control form-control-sm" required value="<?php echo $credit_unit_value; ?>" >
						</div>
					</div> -->

			
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="updateCourseBtn">Update</button>
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

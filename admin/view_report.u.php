<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

      $lecturer_name = "";
      $course_title = "";
      $course_code = "";
      $level = "";
      $lecture_hall = "";
      $time_in = "";
      $time_out = "";
      $NoRecord = "";

      $goToUpdatedList = "";

   
    $today = date("Y-m-d");
    $id = $_GET['updated_id'];
    $count1 = 0;
    // $getRecord = mysqli_query($conn, "SELECT * FROM reports WHERE status = 'Inactive' AND date_created = '$today' ORDER BY id DESC");
    $getRecord = mysqli_query($conn, "SELECT * FROM reports WHERE id = '$id' ORDER BY id DESC");
    $count1 = mysqli_num_rows($getRecord);
if ($count1) {
    
    ?>
            
<style>
    .input_report > input{
        border: none;
        margin-top: -30px;
        height: 20px;
        width: 67%;
    }
    .input_report > input:focus{
        border: none;
        margin-top: -30px;
        height: 20px;
        width: 67%;
        outline: none;
        
    }
    .input_report > label{
        margin-bottom: -30px;

    }
</style>
<!-- <center> -->
<div class="main_container content-wrapper container-fluid" style="width: 80%;">

<div class="col-lg-12">
	<div class="card ps-5">
   
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">Lecturer Information</h3>
			
           
				<div class="row">
                 
                <?php
                  while ($row = mysqli_fetch_assoc($getRecord)) {
                      ?>
                   <div class="col-md-5 mb-2 ms-2 border-righ" style="box-shadow: 5px 5px 8px grey, -5px -1px 8px grey; border-radius: 10px;">
                        <div class="input_report ps-1"><br>
                            
                        <label for="" style="font-size: 15px;">Lecturer Name : </label><input type="text" value="<?php echo $row['lecturer_name']; ?>" readonly><br>
                        <label for="">Course Code : </label><input type="text" value="<?php echo $row['course_code']; ?>" readonly><br>
                        <label for="">Course Title : </label><input type="text" value="<?php echo $row['course_title']; ?>" readonly><br>
                        <label for="">Level : </label><input type="text" value="<?php echo $row['level']; ?>" readonly><br>
                        <label for="">Lecture Hall : </label><input type="text" value="<?php echo $row['lecture_hall']; ?>" readonly><br>
                        <label for="">Time In : </label><input type="text" value="<?php echo $row['time_in']; ?>" readonly><br>
                        <label for="">Time Out : </label><input type="text" value="<?php echo $row['time_out']; ?>" readonly><br>
                        <label for="">Leave Time : </label><input type="text" value="<?php echo $row['leave_time']; ?>" readonly><br>
                        <label for="">Status : </label><input type="text" value="<?php echo $row['l_status']; ?>" readonly><br><br>
                       
                        <a href="updated_report_list.php" class="btn btn-xs btn btn-dark pl-3 pe-3">Back</a><br><br>
                          
                        </div>
					</div>
          <?php
                  }
}
                ?>
                </div>
			
		</div>
	</div>
   
</div>
</div>
</div><br><br><br><br> <br><br><br><br>

<!-- </center> -->
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

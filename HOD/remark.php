<?php
      include_once 'if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

    $success = "";


    if(isset($_SESSION['HOD_user'])){
      
      $lecturer_name = "";
      $course_title = "";
      $course_code = "";
      $level = "";
      $lecture_hall = "";
      $time_in = "";
      $time_out = "";
      $time_out = "";
      $time_left = "";
      $lecture_date = "";

      $remark_id = $_GET['remark_id'];

    $sql = mysqli_query($conn, "SELECT * FROM reports WHERE id = '$remark_id'");
    while ($row = mysqli_fetch_assoc($sql)) {

    $lecturer_name = $row['lecturer_name'];
    $course_code = $row['course_code'];
    $course_title = $row['course_title'];
    $level = $row['level'];
    $lecture_hall = $row['lecture_hall'];
    $time_in = $row['time_in'];
    $time_out = $row['time_out'];
    $time_left = $row['leave_time'];
    $lecture_date = $row['date_created'];
}



if(isset($_POST['remark_btn'])){

    $remark = mysqli_real_escape_string($conn, $_POST['remark']);
    $lecturer_name = mysqli_real_escape_string($conn, $_POST['lecturer_name']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $lecture_hall = mysqli_real_escape_string($conn, $_POST['lecture_hall']);
    $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);
    $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);
    $time_left = mysqli_real_escape_string($conn, $_POST['time_left']);
    $lecture_date = mysqli_real_escape_string($conn, $_POST['lecture_date']);

    $countRemark = 0;

    $checkEvaluation =  "SELECT * FROM student_remark WHERE student_name = '$_SESSION[HOD_user]' && (remark = '$remark' || remark != '$remark') && lecturer_name = '$lecturer_name' && course_code = '$course_code' && course_title = '$course_title' && level = '$level' && 
    lecture_hall = '$lecture_hall' && time_in = '$time_in' && time_out = '$time_out' && time_left = '$time_left' && lecture_date = '$lecture_date'";
    $result = mysqli_query($conn, $checkEvaluation);
    $countRemark = mysqli_num_rows($result);

    if($countRemark > 0){
        $success = '<div class="alert alert-danger alert-dismissible fade show"">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            you have given a remark on this lecture already. Thank You!
        </div>';
        ?>
        <script>
            setTimeout(() => {
                window.location = 'today_report.php';
            }, 5000);
        </script>
    <?php
    }else {
        $insertRecord = mysqli_query($conn, "INSERT INTO student_remark VALUES(0, '$_SESSION[HOD_user]', '$remark', '$lecturer_name', '$course_code', '$course_title', '$level', 
        '$lecture_hall', '$time_in', '$time_out', '$time_left', '$lecture_date', current_timestamp())");
        if($insertRecord){
            $success = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                your remark has been submitted successfully. Thank you!
            </div>';
            ?>
                <script>
                    setTimeout(() => {
                        window.location = 'today_report.php';
                    }, 4000);
                </script>
            <?php
    
        }else {
            $success = '<div class="alert alert-danger alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               Something went wrong
            </div>';
        }
    }
    }

 
?>            
<style>
    .input_report {
        width: 100%;
    }
     .first_input{
        border: none;
        outline: none;
        margin-top: -30px;
        height: 20px;
         /* width: 100%;  */
         width: 57%; 
        
    } 
    .lecture_hall {
        border: none;
        outline: none;
        margin-top: -30px;
        height: 20px;
         /* width: 100%;  */
         width: 67%;
    }

</style>

<div class="main_container content-wrapper container-fluid" style="width: 80%;">

<div class="col-lg-12">
	<div class="card ps-5">
   
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">Evaluate Lecture</h3>
            <span><?php echo $success; ?></span>
			
            <div class="row">
              
                   <div class="col-md-5 mb-2 ms-2 border-righ" style="box-shadow: 5px 5px 8px grey, -5px -1px 8px grey; border-radius: 10px;">
                        <div class="input_report ps-1"><br>
                        
            <form action="" method="POST">
              
                            <label for="">Lecturer Name : </label><input class="first_input" type="text" name="lecturer_name" value="<?php echo $lecturer_name;  ?>" readonly><br>
                            <label for="">Course Code : </label><input class="first_input" type="text" name="course_code" value="<?php echo $course_code; ?>" readonly><br>
                            <label for="">Course Title : </label><input class="first_input" type="text" name="course_title" value="<?php echo $course_title ?>" readonly><br>
                            <label for="">Level : </label><input  class="first_input"type="text" name="level" value="<?php echo $level; ?>" readonly><br>
                            <label for="">Lecture Hall : </label><input class="lecture_hall" type="text" name="lecture_hall" value="<?php echo $lecture_hall; ?>" readonly><br>
                            <label for="">Time In : </label><input class="first_input" type="text" name="time_in" value="<?php echo $time_in; ?>" readonly><br>
                            <label for="">Time Out : </label><input class="first_input" type="text" name="time_out" value="<?php echo $time_out ?>" readonly><br>
                            <label for="">Time Left : </label><input class="first_input" type="text" name="time_left" value="<?php echo $time_left ?>" readonly><br>
                            <label for="">Lecture Date : </label><input class="first_input" type="text" name="lecture_date" value="<?php echo $lecture_date; ?>" readonly><br><br>

                            <center>
                            <div class="">
                                
                                <h2>Remark</h2>
                                Exellent <input type="radio" value="Excellent" name="remark" required> &nbsp;&nbsp;&nbsp;  V-Gppd <input type="radio" value="V-Gppd" name="remark" required> <br><br>
                                
                                Fair <input type="radio" value="Fair" name="remark" required>&nbsp;&nbsp;&nbsp;  Good <input type="radio" value="Good" name="remark" required> <br><br>
                                
                                Poor <input type="radio" value="Poor" name="remark" required> &nbsp;&nbsp;&nbsp; V-Poor <input type="radio" value="V-Poor" name="remark" required> <br><br>
                            
                            
                            </div>
                            </center>
                <input type="submit" value="Submit" class="btn btn-xs btn btn-primary" name="remark_btn">
                <a class="float-right btn btn-xs btn btn-danger" href="today_report.php">Cancel</a><br><br>
            </form>
           
			
		</div>
	</div>
   
</div>
</div>
</div>
<?php
    }else {
        $success = '<div class="alert alert-warning alert-dismissible fade show"">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            You need to login first before you can evaluate lectures.
         </div>';
    }
?>
      <br><br><br><br> <br><br><br><br>
</div>
</div>
</div>
 

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

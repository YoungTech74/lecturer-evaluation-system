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

    //-------------------------------- if search button is clicked-----------------------
    if(isset($_POST['reportBtn'])) {
        $getSearch = mysqli_query($conn, "SELECT * FROM student_remark WHERE lecturer_name = '$_SESSION[lecturer_user]' && (course_code = '$_POST[report_date]' || course_title = '$_POST[report_date]')");
        if(mysqli_num_rows($getSearch) == 0){
            $NoRecord = true;
        }
        if($getSearch) {?>
		<head>
			<link rel="stylesheet" href="../style.css">
		</head>
    <div class="main_container content-wrapper" style="width: 80%;">
    <div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">

        <span class="p-2 bg-warning" style="box-shadow: 5px 5px 8px grey; border-radius: 10px; margin-left: 35%;">Today's Date: <?php echo date("Y-m-d : D"); ?></span><br>

        <?php
               if($NoRecord){?>

                <h5 class="float-left p-5 ">There is NO Records for Your Search, Please Try again!</h5>

                <?php
             }else {?>

                <h5 class="float-left p-5 ">Students Remarks On: <span> <?php echo $_POST['report_date']; ?></span> Are as Follows</h5>


                <?php
             }
        ?>

			<div class="card-tools">

            <div class="float-right">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" placeholder="Search Report By Date" name='report_date'>&nbsp;&nbsp;
                        </div>

                        <div class="col-md-4">
                            <input type="submit" name='reportBtn' class="btn btn-block btn-sm btn-default btn-flat border-primary" value="Search"> 
                            
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Remark</th>
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Level</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Time Left</th>
						<th>Lecture Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
                     
                     while($search= mysqli_fetch_assoc($getSearch)):
                         ?>
					<tr>
                        
						<td data-label="Student Name"><b><?php echo $search['student_name'] ?></b></td>
						<td data-label="Remark"><b><?php echo $search['remark'] ?></b></td>
						<td data-label="Lecturer Name"><b><?php echo $search['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $search['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $search['course_title'] ?></b></td>
						<td data-label="Level"><b><?php echo $search['level'] ?></b></td>
						<td data-label="Time In"><b><?php echo $search['time_in'] ?></b></td>
						<td data-label="Time Out"><b><?php echo $search['time_out'] ?></b></td>
						<td data-label="Time Left"><b><?php echo $search['time_left'] ?></b></td>
						<td data-label="Lecture Date"><b><?php echo $search['lecture_date'] ?></b></td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>


        <br><br><br><br> <br><br><br><br>
            <?php
        }

    //------------------------------ if the search button is not clicked -------------------------
    } else {

        $count2 = 0;
        $sql = mysqli_query($conn, "SELECT * FROM student_remark WHERE lecturer_name = '$_SESSION[lecturer_user]' ORDER BY id DESC LIMIT 5");
       if($sql){?>
	   <head>
		<link rel="stylesheet" href="../style.css">
	   </head>
<div class="main_container content-wrapper" style="width: 80%;">
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">

        <span class="p-2 bg-warning" style="box-shadow: 5px 5px 8px grey; border-radius: 10px; margin-left: 35%;">Today's Date: <?php echo date("Y-m-d"); ?></span><br>

        <h5 class="float-left ml-30 p-5 ">Student Remark on Your Lectures</h5>
			<div class="card-tools">

            <div class="float-right">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" placeholder="Search Report By Date" name='report_date'>&nbsp;&nbsp;
                        </div>

                        <div class="col-md-4">
                            <input type="submit" name='reportBtn' class="btn btn-block btn-sm btn-default btn-flat border-primary" value="Search"> 
                            
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered">
				<thead>
					<tr>
                    <th>Student Name</th>
						<th>Remark</th>
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Level</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Time Left</th>
						<th>Lecture Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					while($row2= mysqli_fetch_assoc($sql)):
					?>
					<tr>
                    	<td data-label="STudent Name"><b><?php echo $row2['student_name'] ?></b></td>
						<td data-label="Remark"><b><?php echo $row2['remark'] ?></b></td>
						<td data-label="Lecturer Name"><b><?php echo $row2['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $row2['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $row2['course_title'] ?></b></td>
						<td data-label="Level"><b><?php echo $row2['level'] ?></b></td>
						<td data-label="Time In"><b><?php echo $row2['time_in'] ?></b></td>
						<td data-label="Time Out"><b><?php echo $row2['time_out'] ?></b></td>
						<td data-label="Time Left"><b><?php echo $row2['time_left'] ?></b></td>
						<td data-label="Lecture Hall"><b><?php echo $row2['lecture_date'] ?></b></td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>


        <br><br><br><br> <br><br><br><br>
            <?php
        }
    }

 ?>

 
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

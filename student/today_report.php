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

    $today = date("Y-m-d");
    $count1 = 0;
    $getRecord = mysqli_query($conn, "SELECT * FROM reports WHERE status = 'Inactive' AND date_created = '$today' AND level = '$_SESSION[student_level]' ORDER BY id DESC");
    $count1 = mysqli_num_rows($getRecord);
    if($count1){
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
            <h3 class="float-left p-2">Today's Lectures</h3>
			
           
				<div class="row">
                 
                <?php
                      while($row = mysqli_fetch_assoc($getRecord)){
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
                        <label for="">Time Left : </label><input type="text" value="<?php echo $row['leave_time']; ?>" readonly><br>
                        <label for="">Status : </label><input type="text" value="<?php echo $row['l_status']; ?>" readonly><br><br>

                        </div>
					</div>
          <?php
                }
                ?>
                </div>
			
		</div>
	</div>
   
</div>
</div>
</div><br><br><br><br> <br><br><br><br>
       <?php
    }else {
    // }


    //-------------------------------- if search button is clicked-----------------------
    if(isset($_POST['reportBtn'])) {
        $getSearch = mysqli_query($conn, "SELECT * FROM reports WHERE date_created = '$_POST[report_date]'");
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

                <h5 class="float-left p-5 ">There is NO Lectures on: <span> <?php echo $_POST['report_date']; ?></span></h5>

                <?php
             }else {?>

                <h5 class="float-left p-5 ">Lectures Held On: <span> <?php echo $_POST['report_date']; ?></span> Are as Follows</h5>


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
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Level</th>
						<th>Lecture Hall</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Time Left</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                     
                     while($search= mysqli_fetch_assoc($getSearch)):
                         ?>
					<tr>
                        
						<td data-label="Lecturer Name"><b><?php echo $search['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $search['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $search['course_title'] ?></b></td>
						<td data-label="Level"><b><?php echo $search['level'] ?></b></td>
						<td data-label="Lecture Hall"><b><?php echo $search['lecture_hall'] ?></b></td>
						<td data-label="Time In"><b><?php echo $search['time_in'] ?></b></td>
						<td data-label="Time Out"><b><?php echo $search['time_out'] ?></b></td>
						<td data-label="Leave Time"><b><?php echo $search['leave_time'] ?></b></td>

						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item " href="./remark.php?remark_id=<?php echo $search['id'] ?>"> <span class="btn btn-xs btn btn-info"> Remark</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_report.php?program_id=<?php echo $search['id'] ?>"><span class="btn btn-xs btn btn-danger"> Delete</span></a>
		                    </div>
						</td>
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
        $sql = mysqli_query($conn, "SELECT * FROM reports WHERE status = 'Active' ORDER BY id DESC LIMIT 3");
       if($sql){?>
       <head>
        <link rel="stylesheet" href="../style.css">
       </head>
<div class="main_container content-wrapper" style="width: 80%;">
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">

        <span class="p-2 bg-warning" style="box-shadow: 5px 5px 8px grey; border-radius: 10px; margin-left: 35%;">Today's Date: <?php echo date("Y-m-d"); ?></span><br>

        <h5 class="float-left ml-30 p-5 ">There is NO Update on Today's Lectures Yet, Please Give Your Remark On These Old Lectures</h5>
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
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Level</th>
						<th>Lecture Hall</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Time Left</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					while($row2= mysqli_fetch_assoc($sql)):
					?>
					<tr>
						<td data-label="Lecturer Name"><b><?php echo $row2['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $row2['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $row2['course_title'] ?></b></td>
						<td data-label="Level"><b><?php echo $row2['level'] ?></b></td>
						<td data-label="Lecture Hall"><b><?php echo $row2['lecture_hall'] ?></b></td>
						<td data-label="Time In"><b><?php echo $row2['time_in'] ?></b></td>
						<td data-label="Time Out"><b><?php echo $row2['time_out'] ?></b></td>
						<td data-label="Time Left"><b><?php echo $row2['leave_time'] ?></b></td>

						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item " href="./remark.php?remark_id=<?php echo $row2['id'] ?>"> <span class="btn btn-xs btn btn-info"> Remark</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_report.php?program_id=<?php echo $row2['id'] ?>"><span class="btn btn-xs btn btn-danger"> Delete</span></a>
		                    </div>
						</td>
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

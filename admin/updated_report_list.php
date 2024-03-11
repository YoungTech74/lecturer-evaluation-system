<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 
 ?>


<?php
	$noMatchSearch = ""; 

	if(isset($_POST['reportBtn'])){
		$getSearch = mysqli_query($conn, "SELECT * FROM reports WHERE date_created = '$_POST[report_date]' && admin_id = '$_SESSION[admin_id]' && status = 'Active'");
		
		if(mysqli_num_rows($getSearch) == 0){
			$noMatchSearch = true;
			
		}?>
			
			<head>
				<link rel="stylesheet" href="../style.css">
			</head>
<div class="main_container content-wrapper" style="width: 80%;">
<div class="col-lg-12"><br>
<?php
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>
				<script>
					setTimeout(() => {
						window.location.href  = window.location.href;
					}, 3000);
				</script>
			<?php
		}
	?>
	<div class="card card-outline card-success">
		<div class="card-header">
			<?php
				if($noMatchSearch){?>
					<h5 class="float-left">No Matched Records For <?php echo $_POST['report_date']; ?>, Please Search again</h5>
					<?php
				}else {?>
					<h5 class="float-left">Matched Records For <?php echo $_POST['report_date']; ?> Are as Follows</h5>
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
			<table class="table">
				<thead>
					<tr>
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Date Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					while($rowSearch = mysqli_fetch_assoc($getSearch)):
					?>
					<tr>
						<td data-label="Lecturer Name"><b><?php echo $rowSearch['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $rowSearch['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $rowSearch['course_title'] ?></b></td>
						<td data-label="Date Created"><b><?php echo ucwords($rowSearch['date_created']) ?></b></td>
						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
							<div class="dropdown-menu" style="">
		                      <a class="dropdown-item " href="./view_report.u.php?updated_id=<?php echo $rowSearch['id'] ?>"> <span class="btn btn-xs btn btn-info m-auto pe-3 pl-3"> View</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_report.u.php?updated_id=<?php echo $rowSearch['id'] ?>"><span class="btn btn-xs btn btn-danger pe-3 pl-3"> Delete</span></a>
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

			<?php
		
	}else {
		//------------------------ if search btn is not pressed -------------------
		$noUpdate = "";
		$sql = mysqli_query($conn, "SELECT *  FROM reports WHERE status = 'active' && admin_id = '$_SESSION[admin_id]'  ORDER BY id DESC");
		if(mysqli_num_rows($sql) == 0){
			$noUpdate = true;
		}
		?>
		
<div class="main_container content-wrapper" style="width: 80%;">
<div class="col-lg-12"><br>
<?php
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>
				<script>
					setTimeout(() => {
						window.location.href  = window.location.href;
					}, 3000);
				</script>
			<?php
		}
	?>
	<head>
		<link rel="stylesheet" href="../style.css">
	</head>
	<div class="card card-outline card-success">
		<div class="card-header">
			<?php
				if($noUpdate){?>
        			<h3 class="float-left">There is no updated reports yet</h3>
					<?php
				}else {?>
        			<h3 class="float-left">List of Updated Reports</h3>
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
			<table class="table">
				<thead>
					<tr>
						<th>Lecturer Name</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Dae Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					
					while($row= mysqli_fetch_assoc($sql)):
					?>
					<tr>
						<td data-label="Lecturer Name"><b><?php echo $row['lecturer_name'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $row['course_code'] ?></b></td>
						<td data-label="Course Title"><b><?php echo $row['course_title'] ?></b></td>
						<td data-label="Date Created"><b><?php echo ucwords($row['date_created']) ?></b></td>
						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item " href="./view_report.u.php?updated_id=<?php echo $row['id'] ?>"> <span class="btn btn-xs btn btn-info m-auto pe-3 pl-3"> View</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_report.u.php?updated_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-danger pe-3 pl-3"> Delete</span></a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div><br><br><br><br><br><br><br><br>

	<?php

	}
?>

<script>
    //--------------------- function to delete course ----------------------
    function confirmDelete(e){
        var confirmBeforeDelete = confirm("Are you sure you want to delete this Report?");
        if(confirmBeforeDelete){
            window.location.href = e.attr("href");
        }
    }
</script>
<?php 
        include_once './include/js_libraries.php';
        include_once 'footer.php';
   ?>
</body>
</html>
<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

	$noRecords = "";

	  $qry = mysqli_query($conn, "SELECT *  FROM reports WHERE status = 'Inactive' && admin_id = '$_SESSION[admin_id]'");
	  if(mysqli_num_rows($qry) == 0){
		$noRecords = true;
	  }
 ?>
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
				if($noRecords){?>
        			<h3 class="float-left">There is no Reports, Please Add new</h3>
					<?php
				}else{?>
        			<h3 class="float-left">Reports List To be Updated</h3>
				<?php
				}
			?>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./add_new_report.php"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th>Course Title</th>
						<th>Course Code</th>
						<th>Lecturer Name</th>
						<th>Date Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
				
					
					while($row= mysqli_fetch_assoc($qry)):
					?>
					<tr>
						<td data-label="Course Title"><b><?php echo $row['course_title'] ?></b></td>
						<td data-label="Course Code"><b><?php echo $row['course_code'] ?></b></td>
						<td data-label="Lecturer Name"><b><?php echo $row['lecturer_name'] ?></b></td>
						<td data-label="Date Created"><b><?php echo ucwords($row['date_created']) ?></b></td>
						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item" href="./view_report.php?report_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-info m-auto pe-3 pl-3"> View</span></a>
		                      <div class="dropdown-divider"></div>

		                      <a class="dropdown-item" href="./update_report.php?report_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-success m-auto pe-3 pl-3"> Update</span></a>
		                      <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="./edit_report.php?report_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-primary m-auto pe-3 pl-3"> Edit</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_report.php?report_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-danger m-auto pe-3 pl-3"> Delete</span></a>
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


<script>
    //--------------------- function to delete course ----------------------
    function confirmDelete(e){
        var confirmBeforeDelete = confirm("Are you sure you want to delete this Course?");
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
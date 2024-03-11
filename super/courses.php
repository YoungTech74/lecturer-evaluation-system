<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 
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
        <h3 class="float-left">List of Courses</h3>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./add_new_course.php"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table" id="list">
				<thead>
					<tr>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Course Type</th>
						<th>Credit Unit</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$fetchCourses = mysqli_query($conn, "SELECT *  FROM course_list WHERE course_list.admin_id = '$_SESSION[admin_id]';");
					while($row= mysqli_fetch_assoc($fetchCourses)):
					?>
					<tr>
						<td data-label="Course Code"><b><?php echo $row['course_code'] ?></b></td>
						<td data-label="Course title"><b><?php echo ucwords($row['course_title']) ?></b></td>
						<td data-label="Course type"><b><?php echo $row['course_type'] ?></b></td>
						<td data-label="Credit unit"><b><?php echo $row['credit_unit'] ?></b></td>
						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item" href="./edit_course.php?course_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-info">Edit</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_course.php?course_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-danger">Delete</span></a>
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
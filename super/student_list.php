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
        <h3 class="float-left">Student Lists</h3>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./add_new_student.php"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>

						<th>Name</th>
						<th>Reg No</th>
						<th>Department</th>
						<th>Program</th>
						<th>Level</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					
					$sql = mysqli_query($conn, "SELECT *  FROM users WHERE users.admin_id = '$_SESSION[admin_id]' ORDER BY username DESC");
					while($row= mysqli_fetch_assoc($sql)):
					?>
					<tr>
					<?php
						if(mysqli_num_rows($sql) == 0){
							echo '<center><h2>There is no User</h2></center>';
						}else {?>
						<td data-label="Name"><b><?php echo $row['username'] ?></b></td>
						<td data-label="Reg No"><b><?php echo ucwords($row['reg_no']) ?></b></td>
						<td data-label="Department"><b><?php echo $row['department'] ?></b></td>
						<td data-label="Program"><b><?php echo $row['program'] ?></b></td>
						<td data-label="Level"><b><?php echo $row['level'] ?></b></td>
						<td data-label="Action" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item " href="./edit_student.php?student_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-info pe-3 pl-3">Edit</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item " href="./delete_student.php?student_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-danger pe-3 pl-3">Delete</span></a>
		                    </div>
						</td>
						<?php
						}
					?>
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
        var confirmBeforeDelete = confirm("Are you sure you want to delete this User?");
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
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
        <h3 class="float-left">List of HOD</h3>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./add_new_hod.php"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th>HOD Name</th>
						<th>Department</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
				
					$getHod = mysqli_query($conn, "SELECT *  FROM hod_list WHERE hod_list.admin_id = '$_SESSION[admin_id]'");
					while($row = mysqli_fetch_assoc($getHod)):
					?>
					<tr>
						<td data-label="HOD" width="10%"><b><?php echo $row['hod_name'] ?></b></td>
						<td data-label="Department" width="40%"><b><?php echo $row['department'] ?></b></td>
						<td data-label="Action" width="20%" class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item" href="./edit_hod.php?hod_id=<?php echo $row['id'] ?>"><span class="btn btn-xs btn btn-info pe-3 pl-3 ">Edit</span></a>
		                      <div class="dropdown-divider"></div>
		                      <a onclick="javascript: confirmDelete(event); return false;" class="dropdown-item" href="./delete_hod.php?hod_id=<?php echo $row['id'] ?>"><span class=" pe-3 pl-3 btn btn-xs btn btn-danger">Delete</span></a>
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
        var confirmBeforeDelete = confirm("Are you sure you want to delete this HOD?");
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
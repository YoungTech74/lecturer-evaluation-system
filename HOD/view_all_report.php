<?php
   include_once './if_not_login.php';
   include_once '../connection.php';
   include_once './header.php'; 
   include_once './navbar.php'; 
   include_once './sidebar.php'; 

   $message = "";

if(isset($_POST['level_btn'])){

	$level = mysqli_real_escape_string($conn, $_POST['level']);

	$getlevel = mysqli_query($conn, "SELECT * FROM lecturers_reports WHERE level = '$level'");
	if(mysqli_num_rows($getlevel) > 0){
		$_SESSION['level'] = $level;
		?>
		<script>
			window.location = './report_matrix.php';
		</script>
		<?php
		// header('location: ./report_matrix');
	}else {
		$message = '<div class="alert alert-danger alert-dismissible fade show text-center">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			There is no report for this level yet!
	</div>';
	}

}


 
?>


<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-4 text-center">Please Choose Level</h3>
            <span id="getMessage"><?php echo $message; ?></span>

			<form action="" method="POST">
				
				<div class="row">

					<div class="col-md-12 border-right">
						<div class="form-group">
							<label for="" class="control-label">Level</label>
							<select name="level" id="" class="form-select">
								<option>Select Level</option>
								<?php
									$levels = array("100L", "200L", "300L", "400L", "500L", "600L");
									foreach($levels as $level){?>
										<option><?php echo $level; ?></option>
										<?php
									}
								?>
							</select>
						</div>  
					</div>


				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="level_btn">Next</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './dashboard.php'">Cancel</button>
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


<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

        $message = "";
      if(isset($_POST['addDepartment'])){

        $department = mysqli_real_escape_string($conn, $_POST['department']);

            $checkDepartment = mysqli_query($conn, "SELECT * FROM department WHERE name = '$department' && department.admin_id = '$_SESSION[admin_id]';");
            if(mysqli_num_rows($checkDepartment)){
                $message = '<div class="alert alert-danger text-white alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    This Department has been Added already!
            </div>';
            ?>
            <script>
            setTimeout(() => {
                document.getElementById('message').style.display = 'none';
                    }, 4000);
                </script>
            <?php
            }else {
            $insertRecord = mysqli_query($conn, "INSERT INTO department VALUES(0, '$_SESSION[admin_id]', '$department', current_timestamp());") or die(mysqli_error($db));
            if($insertRecord){
                  $message = '<div class="alert alert-success text-white alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        New Department Added Successfully!
                </div>';
                ?>
                <script>
                setTimeout(() => {
                    document.getElementById('message').style.display = 'none';
                        }, 4000);
                    </script>
                <?php
            }
        }
    }
      
 ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <!-------------------- display error or success message ----------------->
            <span id="message"><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2 m-auto">
            <h3 class="float-left p-2">New Department</h3>
            
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-12 border-right">

						<div class="form-group">
							<label for="" class="control-label">Department Name</label>
							<input type="text" name="department" class="form-control form-control-sm" required value="">
						</div>

                                <hr>
                        <div class="col-lg-12 text-right justify-content-center d-flex pb-3">
                            <button class="btn btn-primary mr-2" type="submit" name="addDepartment">Add</button>
                            <button class="btn btn-secondary" type="button" onclick="location.href = './department.php'">Cancel</button>
                        </div>
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

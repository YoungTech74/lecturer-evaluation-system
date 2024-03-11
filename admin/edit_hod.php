<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

    $success = "";
    $notMatchPassword = "";
    $hod_name = "";
    $department = "";
    $password = "";

    $id = $_GET['hod_id'];

    $getHod = mysqli_query($conn, "SELECT * FROM hod_list WHERE id = '$id'");
    while($hod = mysqli_fetch_assoc($getHod)){

        $hod_name = $hod['hod_name'];
        $department = $hod['department'];
        $password = $hod['password'];
    }


      if(isset($_POST['updateHod'])){

        $hod_name = mysqli_real_escape_string($conn, $_POST['hod_name']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // $password_hash = md5($password);

        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

       
                $updateHod = mysqli_query($conn, "UPDATE hod_list SET hod_name = '$hod_name', department = '$department', password = '$password' WHERE id = '$id';");
                if($updateHod){
                    $success = '<div class="alert alert-success alert-dismissible fade show"">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    HOD Record Updated successfully.
                </div>';

                ?>
                    <script>
                        setTimeout(() => {
                            window.location = 'hod_list.php';
                        }, 3000);
                    </script>
                <?php
                }
            }
 
  ?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">Update HOD</h3>
           
           <!-------------------------- display success message -------------------- -->
                
                <span id="success"><?php echo $success; ?></span>
                
			<form action="" method="POST">
				
				<div class="row">

					<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">HOD Name</label>
							<input type="text" name="hod_name" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $hod_name; ?>">
						</div>

					</div>
                

                    <div class="col-md-4">
                        <div class="form-group">
							<label for="" class="control-label">Department</label>
							<select name="department" id="course_code" class="form-select form-control-sm" required >
                                <option><?php echo $department; ?></option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM department");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>

                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $password; ?>">
						</div>

					</div>
                

                    	<div class="col-md-4">

						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" id="lecturer_name" class="form-control form-control-sm" required value="<?php echo $password; ?>">
						</div><small class="text-danger"><?php echo $notMatchPassword; ?></small>

					</div>
                

				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="updateHod" > Update</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './hod_list.php'">Cancel</button>
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


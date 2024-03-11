<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $message = "";
      $notMatch = "";
      

      if(isset($_POST['addAdmin'])){

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        $password_hash = md5($password);

        $count = 0;
        $checkAdmin = "SELECT * FROM admins WHERE  username = '$username' && department = '$department' && program = '$program' && level = '$level'";
        $result = mysqli_query($conn, $checkAdmin);

        $count = mysqli_num_rows($result);

        if($count > 0){
            $message = '<div class="alert alert-danger alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Admin already exist with these info.
            </div>';
            ?>
            <script>
            setTimeout(() => {
                document.getElementById('message').style.display = 'none';
                    }, 4000);
                </script>
            <?php

        }else if($password !== $confirm_password){
            $notMatch = 'Passwords do not match!';
        } else{
            $insertAdmin = mysqli_query($conn, "INSERT INTO admins VALUES(0, '$username', '$department', '$program', '$level', 'Admin', '$password_hash', current_timestamp());");
            if($insertAdmin){

                $message = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Admin Added Successfully.
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
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New Admin</h3>
            <span id="message"><?php echo $message; ?></span>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Admin Name</label>
							<input type="text" name="username" class="form-control form-control-sm" required value="">
						</div>  
					</div>


                    <div class="col-md-4 border-right">
                       
						<div class="form-group">
							<label for="" class="control-label">Department</label>
							<select name="department" class="form-select form-control-sm" required>
                                <option >Select Department</option>
                                <?php
                            $sql = mysqli_query($conn, "SELECT * FROM department");
                            while($department = mysqli_fetch_assoc($sql)){?>
                                <option ><?php echo $department['name']; ?></option>
                                <?php
                            }
                        ?>
                            </select>
						</div>
					</div>


                    <div class="col-md-4 border-right">
                       
                       <div class="form-group">
                           <label for="" class="control-label">Program</label>
                           <select name="program" class="form-select form-control-sm" required>
                               <option >Select Program</option>
                               <?php
                           $sql = mysqli_query($conn, "SELECT * FROM program_list");
                           while($program = mysqli_fetch_assoc($sql)){?>
                               <option ><?php echo $program['name']; ?></option>
                               <?php
                           }
                       ?>
                           </select>
                       </div>
                   </div>


                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Level</label>
							<select name="level" class="form-select form-control-sm" required>
                                <option >Select Level</option>
                                <option value="100L">100 Level</option>
                                <option value="200L">200 Level</option>
                                <option value="300L">300 Level</option>
                                <option value="400L">400 Level</option>
                                <option value="500L">500 Level</option>
                                <option value="600L">600 Level</option>
                            </select>
						</div>
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" class="form-control form-control-sm" required value="">
						</div>  
					</div>

                    <div class="col-md-4 border-right">
						<div class="form-group">
							<label for="" class="control-label">Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control form-control-sm" required value="">
						</div>  <small style="font-tyle: italic; color: red;"><?php echo $notMatch; ?></small>
					</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addAdmin">Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './admin_list.php'">Cancel</button>
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

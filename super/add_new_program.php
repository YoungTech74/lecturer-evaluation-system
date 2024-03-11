<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 


      $message = "";

      if(isset($_POST['addProgram'])){

        $program_name = mysqli_real_escape_string($conn, $_POST['program_name']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
    
            $checkProgram = mysqli_query($conn, "SELECT * FROM program_list WHERE name = '$program_name' && program_list.admin_id = '$_SESSION[admin_id]';");
            if(mysqli_num_rows($checkProgram) > 0){
                $message = '<div class="alert alert-danger text-white alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        This Program has been Added already!
                </div>';
                ?>
                <script>
                setTimeout(() => {
                    document.getElementById('message').style.display = 'none';
                        }, 4000);
                    </script>
                <?php
            }else {     
            $insertRecord = mysqli_query($conn, "INSERT INTO program_list VALUES(0, '$_SESSION[admin_id]', '$program_name', '$department', current_timestamp());") or die(mysqli_error($db));
            if($insertRecord){
                  $message = '<div class="alert alert-success text-white alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        New Program has been Added Successfully!
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
            <!---------------- display error or success message  ------------------------->
            <span id="message"><?php echo $message; ?></span>

            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New Program</h3>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-6 border-right">

						<div class="form-group">
							<label for="" class="control-label">Program Name</label>
							<input type="text" name="program_name" class="form-control form-control-sm" required value="">
						</div>
					</div>
                      
                    <div class="col-md-6 border-right">
                        <div class="form-group">
							<label for="" class="control-label">Department Name</label>
							<select name="department" class="form-select form-control-sm" required>
                                <option>Select Department</option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM department WHERE department.admin_id = '$_SESSION[admin_id]';");
                                    while($row = mysqli_fetch_assoc($query)){?>
                                        <option><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>


				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="addProgram">Add</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './courses.php'">Cancel</button>
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

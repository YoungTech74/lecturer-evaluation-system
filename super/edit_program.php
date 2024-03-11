<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 

      $id = $_GET['program_id'];

      $program_name = "";
      $department = "";

      $getRecord = mysqli_query($conn, "SELECT * FROM program_list WHERE id ='$id';");
      while($row = mysqli_fetch_assoc($getRecord)){
        $program_name = $row['name'];
        $department = $row['department_id'];
      }
      if(isset($_POST['updateProgram'])){

        $program_name = mysqli_real_escape_string($conn, $_POST['program_name']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
    

            $insertRecord = mysqli_query($conn, "UPDATE  program_list SET name = '$program_name', department_id = '$department', create_at = NULL, updated_on = current_timestamp() WHERE id = '$id';") or die(mysqli_error($db));
            if($insertRecord){?>
                <script>
                    alert("Program Updated Successfully");
                    window.location='program.php';
                </script>
                <?php
            }
        }
      
 ?>

<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
            <h3 class="float-left p-2">New Program</h3>
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-6 border-right">

						<div class="form-group">
							<label for="" class="control-label">Program Name</label>
							<input type="text" name="program_name" class="form-control form-control-sm" required value="<?php echo $program_name; ?>">
						</div>
					</div>
                      
                    <div class="col-md-6 border-right">
                        <div class="form-group">
							<label for="" class="control-label">Department Name</label>
							<select name="department" class="form-select form-control-sm" required>
                                <option><?php echo $department; ?></option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM department");
                                    while($row2 = mysqli_fetch_assoc($query)){?>
                                        <option value="<?php echo $row2['name']; ?>"><?php echo $row2['name']; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
						</div>
					</div>


				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex pb-3">
					<button class="btn btn-primary mr-2" type="submit" name="updateProgram">Update</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = './program.php'">Cancel</button>
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

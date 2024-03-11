<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php'; 


      $id = $_GET['department_id'];

      $department = "";
      $message = "";

      $getValues =  mysqli_query($conn, "SELECT * FROM department WHERE id = '$id';") or die(mysqli_query($conn));
      while($row = mysqli_fetch_assoc($getValues)){
        $department = $row['name'];
     
      }


      if(isset($_POST['updateDepartmentBtn'])){

        $department = mysqli_real_escape_string($conn, $_POST['department']);
      

      
            $updateRecord = mysqli_query($conn, "UPDATE department SET name = '$department', date_created = current_timestamp() WHERE id = '$id';") or die(mysqli_error($db));
            if($updateRecord){
                $message = '<div class="alert alert-success alert-dismissible fade show"">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Department Updated Successfully
            </div>';
            ?>
            <script>
            setTimeout(() => {
                    window.location = './department.php'
                    }, 3000);
                </script>
            <?php
               
            }
        }
      
 ?>


<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card"><br>
		<div class="card-body">
            <span><?php echo $message; ?></span>
            <div class="card card-outline card-primary ps-2 pe-2 m-auto">
            <h3 class="float-left p-2">Update Department</h3>
            
			<form action="" id="manage_faculty" method="POST">
				
				<div class="row">

					<div class="col-md-12 border-right">

						<div class="form-group">
							<label for="" class="control-label">Department Name</label>
							<input type="text" name="department" class="form-control form-control-sm" required value="<?php echo $department; ?>">
						</div>

                                <hr>
                        <div class="col-lg-12 text-right justify-content-center d-flex pb-3">
                            <button class="btn btn-primary mr-2" type="submit" name="updateDepartmentBtn">Update</button>
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

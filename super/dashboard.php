<?php
      include_once './if_not_login.php';
      include_once '../connection.php';
      include_once './header.php'; 
      include_once './navbar.php'; 
      include_once './sidebar.php';

?>
<div class="main_container content-wrapper" style="width: 80%;">

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
            <div class="card card-outline card-primary ps-2 pe-2">
           <center> <h3 class="p-4">Welcome Back <?php echo $_SESSION['admin_user']; ?>!</h3> </center> 
	</div>
</div>
</div>
</div><br><br><br><br> <br><br><br><br><br><br><br><br><br>
<?php 
        include_once './include/js_libraries.php';
        include_once 'footer.php';
   ?>

</body>
</html>


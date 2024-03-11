
<style>
        .dropdown-btn {
            background:  rgb(223, 216, 216);
            color: black;
            padding: 16px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
           
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background: black;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgb(0,0,0,0.2);
            z-index: 1;
            text-align: center;
            margin-left: -25px;
            border-radius: 10px;
            

        }
        .dropdown-content a {
            color: green;
            padding: 12px 16px;
            text-decoration: none;
            display: block;

        }

        .dropdown-content a:hover {
            background: pink;
            color: black;
            border-radius: 10px;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropdown-btn {
            background: rgb(141, 139, 139);

        }

        .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
      }
      .btn-rounded{
            border-radius: 50px;
      }
    </style>

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./dashboard.php" class="nav-link bg-info me-3 text-white" style="border-radius: 5px;">Home</a>
      </li>
     

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
            <div class="btn-group nav-link me-3">
                  <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                   <?php
                      if(isset($_SESSION['student_user'])){?>
                        <span style="font-size: 15px;" class="me- p-3"><?php echo $_SESSION['student_user']; ?></span>
                        <?php
                      }
                   ?>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>


                  <div class="dropdown-menu ms-3" role="menu">
                    <a class="dropdown-item" href="change_password.php"><span class="fa fa-user"></span> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php"><span class="fas fa-sign-out-alt"></span> Logout</a>
                  </div>

              </div>
          </li>
     
    </ul>

    
  </nav>
  <!-- /.navbar -->

  
<?php
      include_once './if_not_login.php';
    include_once '../connection.php';
  
?>

<aside class="main-sidebar sidebar-dark-warning elevation-4" style="">

<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
  <img src="include/img/drwhite.png" alt="Logo" class="brand-image img-circle elevation-3" style="">
  <h2 class="brand-text font-weight-light text-center">LEMS</h2>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
        <ul class="nav nav-treeview">
        </ul>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Report
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right"></span>
          </p>
        </a>
        <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="today_report.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Today Report</p>
            </a>
          </li>

        </ul>
      </li>
      </li><br><br>
  </nav>
</aside>


<?php
 session_start();
include'functions.php';
if(empty($_SESSION["login"]))
    header("location:login.php");
?>
<!DOCTYPE html>
<html>
<head>
 <?php include("tamplate/header.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include("tamplate/navbar.php") ?>
  <!-- /.navbar -->

 <!-- sidebar -->
 <?php include("tamplate/sidebar.php") ?>
 <!-- /.sidebar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include("tamplate/breadcrumb.php") ?>
    <!-- /.content-header -->

    <!-- Main content -->
   
    <div id="page-wrapper">
      <div class="container-fluid">
      <?php
          if(file_exists($mod.'.php'))
              include $mod.'.php';
          else
              include 'home.php';
     ?>
   </div>
      
    </div>   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("tamplate/footer.php") ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include("tamplate/js.php") ?>
</body>
</html>

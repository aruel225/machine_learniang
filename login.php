<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sijaku:Login</title>
  <!-- Tell the browser to be responsive to screen width -->
<?php include("tamplate/header.php") ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h3 class="text-center mt-0 mb-4">
      <b>S</b>istem <b>P</b>enjadwalan <b>K</b>uliah
    </h3> 
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="?act=login" method="post">
         <?php            
            if($_POST) {
                include 'aksi.php';  
            }
        ?>
        <div class="input-group mb-3">
          <input type="text" id="inputEmail" name="user" autofocus class="form-control" placeholder="Username" autocomplete="off" required oninvalid="this.setCustomValidity('Username belum diisi')" oninput="setCustomValidity('')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" autocomplete="off" required oninvalid="this.setCustomValidity('password belum diisi')" oninput="setCustomValidity('')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">  
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
            </div>
      </form>
      <p class="mb-1">
    </div>
  </div>
</div>
<?php include("tamplate/js.php") ?>
</body>
</html>

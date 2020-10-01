<?php session_start(); ?>
 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
     
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

               <div class="info-box-content">
                <span class="info-box-text"><b>Prodi</b> </span>
                <?php  $kd_prodi = $_SESSION['kode_prodi']; ?>
                       <?php if($_SESSION['kode_level'] == '1'){
                   
                ?>
                <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_prodi ")?><br /></span>
              <?php }else{?>
                 <span class="info-box-number">  <?php 

                 $q = esc_field($_GET['q']);
                 $name = $_SESSION['kode_prodi'];
                $rows = $db->get_row("SELECT nama_prodi FROM tb_prodi WHERE kode_prodi = '$name'");
                foreach ($rows as $key => $value) {
                  echo "$value";
                }
               ?><br /></span>
               <?php } ?>
              </div>



              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Dosen</b> </span>
                <?php  $kd_prodi = $_SESSION['kode_prodi']; ?>
                       <?php if($_SESSION['kode_level'] == '1'){
                   
                ?>
                <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_dosen ")?><br /></span>
              <?php }else{?>
                 <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_dosen WHERE kode_prodi='$kd_prodi' ")?><br /></span>
               <?php } ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book-reader"></i></span>
                <div class="info-box-content">
                <span class="info-box-text"><b>Mata Kuliah</b> </span>
                    <?php  $kd_prodi = $_SESSION['kode_prodi']; ?>
                      <?php if($_SESSION['kode_level'] == '1'){  ?>
                    <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_matkul ")?><br /></span>
                  <?php }else{?>
                     <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_matkul WHERE kode_prodi='$kd_prodi' ")?><br /></span>
                   <?php } ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="nav-icon fas fa-home"></i></span>

               <div class="info-box-content">
                <span class="info-box-text"><b>Ruang</b> </span>
                    <?php  $kd_prodi = $_SESSION['kode_prodi']; ?>
                      <?php if($_SESSION['kode_level'] == '1'){  ?>
                    <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_ruang ")?><br /></span>
                  <?php }else{?>
                     <span class="info-box-number">Total: <?=$db->get_var("SELECT COUNT(*) FROM tb_ruang WHERE kode_prodi='$kd_prodi' ")?><br /></span>
                   <?php } ?>
              </div>

              <!-- /.info-box-content -->
            </div>
              
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
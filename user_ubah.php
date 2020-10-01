 <?php if ($_SESSION['kode_level'] == '1'){ ?>
<?php
    $row = $db->get_row("SELECT * FROM tb_users WHERE id_user='$_GET[ID]'"); 
?>
<section class="content">
  <div class="row">
    <div class="col-md-6">
     <?php if($_POST) include'aksi.php'?>
       <form method="post" action="?m=user_ubah&ID=<?=$row->id_user?>">
         <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><b>Data Pengguna</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>ID User <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="id_user" readonly="readonly" autocomplete="off" value="<?=$row->id_user?>"/>
              </div>

            <div class="form-group">
                 <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" autocomplete="off" value="<?=$row->nama?>"/>
            </div>

             <div class="form-group">
                 <label>Username<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" autocomplete="off" value="<?=$row->user?>"/>
            </div>
               <div class="form-group">
              <label>Level <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_level">
                    <option value=""></option>
                    <?=AG_get_level_option($row->kode_level)?>
                </select>
            </div>
            <div class="form-group">
              <label>Prodi <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_prodi">
                    <option value=""></option>
                    <?=AG_get_prodi_option($row->kode_prodi)?>
                </select>
            </div>
           
           <div class="card-footers">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
              <a href="?m=user" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Batal</a>        
          </div>
           </div>
        </div>
         </div>
         <!--  <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><b>Level Pengguna</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label>Minimal</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Level</option>
                    <option>Admin</option>
                    <option>Prodi</option>
                    <option>Dosen</option>                 
                  </select>
                </div>
                <div class="card-footers">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
              <a href="?m=user" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Batal</a>        
          </div>
           
            </div>
             /.card-body -->
          </div>
          <!-- /.card -->
          
          <!-- /.card -->
        </div>
     </form>
  </div>
</section>

<?php   }else {
     redirect_js("index.php");
    # code...
} ?>
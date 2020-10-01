 <?php if ($_SESSION['kode_level'] == '1'){ ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Tambah Pengguna</b></h3>
                    </div>
                     <?php if($_POST) include'aksi.php'?>
                     <form method="post" action="?m=user_tambah">
                        <div class="card-body">
                            <div class="form-grup">
                                  <label>Nama <span class="text-danger">*</span></label>
                                  <input class="form-control" type="text" name="nama"autocomplete="off" value="<?=$_POST["nama"]?>" required oninvalid="this.setCustomValidity('Nama belum diisi')" oninput="setCustomValidity('')"/>
                            </div>

                             <div class="form-group">
                                  <label>Username <span class="text-danger">*</span></label>
                                  <input class="form-control" type="text" name="user" autocomplete="off" value="<?=$_POST["user"]?>" required oninvalid="this.setCustomValidity('Username belum diisi')" oninput="setCustomValidity('')"/>
                            </div>

                            <div class="form-group">
                                 <label>Password <span class="text-danger">*</span></label>
                                   <input class="form-control" type="password" name="pass" value="<?=$_POST["pass"]?>" required oninvalid="this.setCustomValidity('password belum diisi')" oninput="setCustomValidity('')"/>
                            </div>
                           <div class="form-group">
                                <label>Level <span class="text-danger">*</span></label>
                                <select class="form-control" name="kode_level">
                                    <option value=""></option>
                                    <?=AG_get_level_option($_POST[kode_level])?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Prodi <span class="text-danger">*</span></label>
                                <select class="form-control" name="kode_prodi">
                                    <option value=""></option>
                                    <?=AG_get_prodi_option($_POST[kode_prodi])?>
                                </select>
                            </div>
                      

                            <div class="card-footer">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                    <a class="btn btn-danger" href="?m=user"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>                
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php   }else {
     redirect_js("index.php");
    # code...
} ?>
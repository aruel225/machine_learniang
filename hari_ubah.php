<?php
    $row = $db->get_row("SELECT * FROM tb_hari WHERE kode_hari='$_GET[ID]'"); 
?>

<section class="content">
  <div class="row">
    <div class="col-md-6">
     <?php if($_POST) include'aksi.php'?>
      <form method="post" action="?m=hari_ubah&ID=<?=$row->kode_hari?>">
         <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><b>Ubah hari</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                  <div class="form-group">
                    <label>Kode Hari <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="kode" readonly="readonly" value="<?=$row->kode_hari?>"/>
                  </div>
                <div class="form-group">
                    <label>Nama Hari <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nama" autocomplete="off" value="<?=$row->nama_hari?>"/>
                </div>

          <div class="card-footers">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
              <a href="?m=hari" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Batal</a>        
          </div>
           </div>
        </div>
         </div>
     </form>
  </div>
</section>


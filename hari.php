<section class="content">
    <div class="card">
         <div class="card-header">
            <h2><span class="card-title"><b>Ruang</b></span></h2><br>
           <div style="margin-left:0px">
           <form class="form-inline">
                <input type="hidden" name="m" value="hari" />
                <div class="form-group">
                    <button class="btn btn-success"><i class="fa fa-sync-alt"></i> Refresh</a>
                </div>                
                <div class="form-group">
                    <a class="btn btn-primary" href="?m=hari_tambah"><i class="fa fa-plus" aria-hidden="true"></i>Tambah</a>
                </div>
             </form>
           </div>
        </div>
        
       
        
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Hari</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
     <?php if ($_SESSION['kode_level'] == '2'){ 
        $q = esc_field($_GET['q']);
        $kd_prodi = $_SESSION['kode_prodi'];
        $rows = $db->get_results("SELECT * FROM tb_hari WHERE kode_prodi ='$kd_prodi' ORDER BY kode_hari");
        // var_dump($rows);
        // die;
        foreach($rows as $row){
            if($row->kode_hari==$selected)
                $a.="<option value='$row->kode_hari' selected>[$row->kode_hari] $row->nama_hari</option>";
            else
                $a.="<option value='$row->kode_hari'>[$row->kode_hari] $row->nama_hari</option>";

            }
        }elseif ($_SESSION['kode_level'] == '1'){
            $rows = $db->get_results("SELECT * FROM tb_hari ORDER BY kode_hari");
            foreach($rows as $row){
                if($row->kode_hari==$selected)
                    $a.="<option value='$row->kode_hari' selected>[$row->kode_hari] $row->nama_hari</option>";
                else
                    $a.="<option value='$row->kode_hari'>[$row->kode_hari] $row->nama_hari</option>";

                    }
        }
        ?>
    <?php


    
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=++$no ?></td>
         <td><?=$row->nama_hari?></td>
        <td><?=$row->kode_prodi?></td>
        <td class="nw">
            <a class="btn btn-xs btn-warning" href="?m=hari_ubah&ID=<?=$row->kode_hari?>"><i class="fa fa-edit"></i></a>
            <a class="btn btn-xs btn-danger" href="aksi.php?act=hari_hapus&ID=<?=$row->kode_hari?>" onclick="return confirm('Hapus data?')"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
        </td>
    </tr>
    <?php endforeach;
    ?>
    </table>
        </div>
    </div>
</section>
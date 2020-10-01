
 <?php if ($_SESSION['kode_level'] == '1'){ ?>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h2><span class="card-title"><b>Management Pengguna</b></span></h2><br>
           <div style="margin-left:0px">
               <form class="form-inline">
                    <input type="hidden" name="m" value="user" />
                    <div class="form-group">
                        <button class="btn btn-success"><i class="fa fa-sync-alt"></i> Refresh</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="?m=user_tambah"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                    </div>
            </form>
           </div>
        </div>
       
        
        <div class="card-body">
        <table class="table table-sm table-bordered table-hover table-striped">
            <thead>
                <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>Level</th>
                    <th>prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
             $rows = $db->get_results("SELECT U.id_user, U.nama, U.user, U.kode_level, U.kode_prodi,  L.nama_level, P.nama_prodi
                FROM tb_users U
                    INNER JOIN tb_level L ON U.kode_level = L.kode_level
                    INNER JOIN tb_prodi P ON U.kode_prodi = P.kode_prodi
                    WHERE U.kode_prodi = P.kode_prodi AND U.kode_level = L.kode_level
                ");

            $no=0;

            foreach($rows as $row):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->nama?></td>
                <td><?=$row->user?></td>
                <td><small class="badge badge-info"><?=$row->nama_level?></small></td>
                <td><?=$row->nama_prodi?></td>
                <td class="nw">
                    <a class="btn btn-xs btn-warning" href="?m=user_ubah&ID=<?=$row->id_user?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=user_hapus&ID=<?=$row->id_user?>" onclick="return confirm('Hapus data?')"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
                </td>
            </tr>

            <?php endforeach;?>         
        </table>
     
    
        </div>
    </div>
</section>
<?php   }else {
     redirect_js("index.php");
    # code...
} ?>
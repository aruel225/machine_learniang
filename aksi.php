
<?php
require_once'functions.php';

$demo = false;

$urls  = array(
    'hari_tambah' => 'hari',
    'hari_ubah' => 'jam',
    'hari_hapus' => 'jam',
    
    'jam_tambah' => 'jam',
    'jam_ubah' => 'jam',
    'jam_hapus' => 'jam',
    
    'waktu_tambah' => 'waktu',
    'waktu_ubah' => 'waktu',
    'waktu_hapus' => 'waktu',
    
    'kelas_tambah' => 'kelas',
    'kelas_ubah' => 'kelas',
    'kelas_hapus' => 'kelas',
    
    'dosen_tambah' => 'dosen',
    'dosen_ubah' => 'dosen',
    'dosen_hapus' => 'dosen',
    
    'matkul_tambah' => 'matkul',
    'matkul_ubah' => 'matkul',
    'matkul_hapus' => 'matkul',
    
    'ruang_tambah' => 'ruang',
    'ruang_ubah' => 'ruang',
    'ruang_hapus' => 'ruang',
    
    'absen_tambah' => 'absen',
    'absen_ubah' => 'absen',
    'absen_hapus' => 'absen',

    'user_tambah' => 'user',
    'user_ubah' => 'user',
    'user_hapus' => 'user',
    
    'password' => 'password',

            
);

/** LOGIN */ 
if ($act=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_users WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        $_SESSION['kode_prodi'] = $row->kode_prodi; 
        $_SESSION['nama'] = $row->nama;
        $_SESSION['kode_level'] =  $row->kode_level;
        // $_SESSION['kode_level'] = $row->user;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
}
if($demo && $act != 'login'){
    echo('<script>alert("Tidak diijinkan menambah, mengubah, dan menghapus data pada versi DEMO ini!")</script>');
    if(array_key_exists($mod, $urls))
        redirect_js("index.php?m=" . $urls[$mod]);
    else if(array_key_exists($act, $urls))
        redirect_js("index.php?m=" . $urls[$act]);                   
}else{     
    if ($mod=='password'){
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        $pass3 = $_POST["pass3"];
        
        $row = $db->get_row("SELECT * FROM tb_users WHERE user='$_SESSION[login]' AND pass='$pass1'");        
        
        if($pass1=='' || $pass2=='' || $pass3=='')
            print_msg('Field bertanda * harus diisi.');
        elseif(!$row)
            print_msg('Password lama salah.');
        elseif( $pass2 != $pass3 )
            print_msg('Password baru dan konfirmasi password baru tidak sama.');
        else{        
            $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
            print_msg('Password berhasil diubah.', 'success');
        }
    } elseif($act=='logout'){
        session_unset();
        // unset($_SESSION["login"]);
        // unset($_SESSION["kode_prodi"]);
        header("location:login.php");
    }
    
    /** JAM */    
    if($mod=='jam_tambah'){
        $nama = $_POST['nama'];
        $kode_prodi = $_POST['kode_prodi'];
        
        if($nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("ALTER TABLE tb_jam DROP kode_jam");
            $db->query("ALTER TABLE tb_jam ADD kode_jam INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
            $db->query("INSERT INTO tb_jam (nama_jam, kode_prodi) VALUES ('$nama', '$kode_prodi')");  
                                              
            redirect_js("index.php?m=jam");
        }                    
    } else if($mod=='jam_ubah'){
        $nama = $_POST['nama'];
        
        if($nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_jam SET nama_jam='$nama' WHERE kode_jam='$_GET[ID]'");
            redirect_js("index.php?m=jam");
        }    
    } else if ($act=='jam_hapus'){
        $db->query("DELETE FROM tb_jam WHERE kode_jam='$_GET[ID]'");
        $db->query("DELETE FROM tb_waktu WHERE kode_jam='$_GET[ID]'"); 
        header("location:index.php?m=jam");
    } 
    
    /** HARI */    
    if($mod=='hari_tambah'){
        $kode       = $_POST['kode'];
        $nama       = $_POST['nama'];
        $kode_prodi = $_POST['kode_prodi'];

        if($nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_hari WHERE nama_hari='$nama' AND kode_prodi ='$kode_prodi'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("ALTER TABLE tb_hari DROP kode_hari");
            $db->query("ALTER TABLE tb_hari ADD kode_hari INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
             $db->query("INSERT INTO tb_hari (kode_hari, nama_hari, kode_prodi) VALUES ('$kode', '$nama', '$kode_prodi')");                                    
            redirect_js("index.php?m=hari");
        
            }
                            
    } else if($mod=='hari_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
           $save = $db->query("UPDATE tb_hari SET nama_hari='$nama'WHERE kode_hari='$_GET[ID]'");
            redirect_js("index.php?m=hari");
        
        }    
    } else if ($act=='hari_hapus'){
        $db->query("DELETE FROM tb_hari WHERE kode_hari='$_GET[ID]'");
        $db->query("DELETE FROM tb_waktu WHERE kode_hari='$_GET[ID]'"); 
        header("location:index.php?m=hari");
    } 
    
    /** WAKTU */
    elseif($mod=='waktu_tambah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_jam   = $_POST['kode_jam']; 
        $kode_prodi = $_POST['kode_prodi'];       
        if($kode_hari=='' || $kode_jam=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_hari='$kode_hari' AND kode_jam='$kode_jam' AND kode_prodi='$kode_prodi'"))
            print_msg("Kombinasi hari dan jam sudah ada!");
        else{
           $db->query("ALTER TABLE tb_waktu DROP kode_waktu");
            $db->query("ALTER TABLE tb_waktu ADD kode_waktu INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
            $db->query("INSERT INTO tb_waktu (kode_hari, kode_jam, kode_prodi) VALUES ('$kode_hari', '$kode_jam', '$kode_prodi')");  
            $db->query("ALTER TABLE tb_jadwal AUTO_INCREMENT=0");                   
            redirect_js("index.php?m=waktu");
           
        }
    } else if($mod=='waktu_ubah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_jam   = $_POST['kode_jam'];  
        if($kode_hari=='' || $kode_jam=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_hari='$kode_hari' AND kode_jam='$kode_jam' AND kode_waktu<>'$_GET[ID]'"))
            print_msg("Kombinasi hari dan jam sudah ada!");
        else{
            $db->query("UPDATE tb_waktu SET kode_hari='$kode_hari', kode_jam='$kode_jam' WHERE kode_waktu='$_GET[ID]'");
            redirect_js("index.php?m=waktu");
        }
    } else if ($act=='waktu_hapus'){
        $db->query("DELETE FROM tb_waktu WHERE kode_waktu='$_GET[ID]'");
        header("location:index.php?m=waktu");
    } 
    
    /** RUANG */    
    if($mod=='ruang_tambah'){
        $kode       = $_POST['kode'];
        $nama       = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        $kode_prodi = $_POST['kode_prodi'];
        
        if($nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_ruang WHERE kode_ruang='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("ALTER TABLE tb_ruang DROP kode_ruang");
            $db->query("ALTER TABLE tb_ruang ADD kode_ruang INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
            $db->query("INSERT INTO tb_ruang (kode_ruang, nama_ruang, keterangan, kode_prodi) VALUES ('$kode', '$nama', '$keterangan', '$kode_prodi')");    
            $db->query("ALTER TABLE tb_ruang AUTO_INCREMENT=0");                       
            redirect_js("index.php?m=ruang");
        }                    
    } else if($mod=='ruang_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_ruang SET nama_ruang='$nama', keterangan='$keterangan' WHERE kode_ruang='$_GET[ID]'");
            redirect_js("index.php?m=ruang");
        }    
    } else if ($act=='ruang_hapus'){
        $db->query("DELETE FROM tb_ruang WHERE kode_ruang='$_GET[ID]'");
        header("location:index.php?m=ruang");
    } 
    
    /** DOSEN */    
    if($mod=='dosen_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        $kode_prodi = $_POST['kode_prodi'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_dosen WHERE kode_dosen='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_dosen (kode_dosen, nama_dosen, keterangan, kode_prodi) VALUES ('$kode', '$nama', '$keterangan', '$kode_prodi')");                       
            redirect_js("index.php?m=dosen");
        }                    
    } else if($mod=='dosen_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_dosen SET nama_dosen='$nama', keterangan='$keterangan' WHERE kode_dosen='$_GET[ID]'");
            redirect_js("index.php?m=dosen");
        }    
    } else if ($act=='dosen_hapus'){
        $db->query("DELETE FROM tb_dosen WHERE kode_dosen='$_GET[ID]'");
        $db->query("DELETE FROM tb_kuliah WHERE kode_dosen='$_GET[ID]'");
        header("location:index.php?m=dosen");
    } 
    
    /** KELAS */    
    elseif($mod=='kelas_tambah'){
        $kode  = $_POST['kode'];
        $nama   = $_POST['nama'];   
        $keterangan = $_POST['keterangan'];
        $kode_prodi = $_POST['kode_prodi'];     
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_kelas WHERE kode_kelas='$kode'"))
            print_msg("Kode kelas sudah ada!");
        else{
            $db->query("INSERT INTO tb_kelas (kode_kelas, nama_kelas, keterangan, kode_prodi) VALUES ('$kode', '$nama', '$keterangan', '$kode_prodi')");                       
            redirect_js("index.php?m=kelas");
        }
    } else if($mod=='kelas_ubah'){
        $kode  = $_POST['kode'];
        $nama   = $_POST['nama'];  
        $keterangan = $_POST['keterangan'];
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_kelas WHERE kode_kelas='$kode' AND kode_kelas<>'$_GET[ID]'"))
            print_msg("Kode kelas sudah ada!");
        else{
            $db->query("UPDATE tb_kelas SET kode_kelas='$kode', nama_kelas='$nama', keterangan='$keterangan' WHERE kode_kelas='$_GET[ID]'");
            redirect_js("index.php?m=kelas");
        }
    } else if ($act=='kelas_hapus'){
        $db->query("DELETE FROM tb_kelas WHERE kode_kelas='$_GET[ID]'");
        $db->query("DELETE FROM tb_kuliah WHERE kode_kelas='$_GET[ID]'");
        header("location:index.php?m=kelas");
    } 
        
    /** MATKUL */    
      if($mod=='matkul_tambah'){
        $kode          = $_POST['kode'];
        $nama          = $_POST['nama'];
        $sks           = $_POST['sks'];
        $kode_prodi    =$_POST['kode_prodi'];
        $kode_semester = $_POST['kode_semester'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_matkul WHERE kode_matkul='$kode'"))
            print_msg("Kode sudah ada!");
        else{
          $db->query("INSERT INTO tb_matkul (kode_matkul, nama_matkul, sks, kode_prodi, kode_semester) VALUES ('$kode', '$nama', '$sks', '$kode_prodi', '$kode_semester')");                       
            redirect_js("index.php?m=matkul");
            }
                            
    } else if($mod=='matkul_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $sks = $_POST['sks'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_matkul SET nama_matkul='$nama', sks='$sks' WHERE kode_matkul='$_GET[ID]'");
            redirect_js("index.php?m=matkul");
        }    
    } else if ($act=='matkul_hapus'){
        $db->query("DELETE FROM tb_matkul WHERE kode_matkul='$_GET[ID]'");
        $db->query("DELETE FROM tb_kuliah WHERE kode_matkul='$_GET[ID]'");
        header("location:index.php?m=matkul");
    }    
    
    /** KULIAH */
    elseif($mod=='kuliah_tambah'){
        $kode_matkul  = $_POST['kode_matkul'];
        $kode_kelas   = $_POST['kode_kelas'];   
        $kode_dosen   = $_POST['kode_dosen']; 
        $kode_prodi   = $_POST['kode_prodi'];
        $kode_semester = $_POST['kode_semester'];       
        if($kode_matkul=='' || $kode_kelas=='' || $kode_dosen=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_kuliah WHERE kode_matkul='$kode_matkul' AND kode_kelas='$kode_kelas' AND kode_dosen='$kode_dosen'"))
            print_msg("Kombinasi sudah ada!");
        else{
            $db->query("ALTER TABLE tb_kuliah DROP kode_kuliah");
            $db->query("ALTER TABLE tb_kuliah ADD kode_kuliah INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
            $db->query("INSERT INTO tb_kuliah (kode_matkul, kode_kelas, kode_dosen, kode_prodi, kode_semester) VALUES ('$kode_matkul', '$kode_kelas', '$kode_dosen', '$kode_prodi','$kode_semester')");
             $db->query("ALTER TABLE tb_jadwal AUTO_INCREMENT=0");                       
            redirect_js("index.php?m=kuliah");
        }
    } else if($mod=='kuliah_ubah'){
        $kode_matkul  = $_POST['kode_matkul'];
        $kode_kelas   = $_POST['kode_kelas'];     
        $kode_dosen   = $_POST['kode_dosen']; 
        if($kode_matkul=='' || $kode_kelas=='' || $kode_dosen=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_kuliah WHERE kode_matkul='$kode_matkul' AND kode_kelas='$kode_kelas' AND kode_dosen='$kode_dosen' AND kode_kuliah<>'$_GET[ID]'"))
            print_msg("Kombinasi sudah ada!");
        else{
            $db->query("UPDATE tb_kuliah SET kode_matkul='$kode_matkul', kode_kelas='$kode_kelas', kode_dosen='$kode_dosen' WHERE kode_kuliah='$_GET[ID]'");
            redirect_js("index.php?m=kuliah");
        }
    } else if ($act=='kuliah_hapus'){
        $db->query("DELETE FROM tb_kuliah WHERE kode_kuliah='$_GET[ID]'");
        header("location:index.php?m=kuliah");
    }

    /*-------------user--------------*/  
    if($mod=='user_tambah'){
         $id_user    = $_POST['id_user'];
         $nama       = $_POST['nama'];
         $user       = $_POST['user'];
         $pass       = $_POST['pass'];
         $kode_level = $_POST['kode_level'];
         $kode_prodi = $_POST['kode_prodi'];
        
        // if($nama=='' || $user=='' || $pass=='' || $level=='' || $kode_prodi=='')
        //     print_msg("Field bertanda * tidak boleh kosong!");
        if($db->get_results("SELECT * FROM tb_users WHERE id_user='$id_users'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("ALTER TABLE tb_users DROP id_user");
            $db->query("ALTER TABLE tb_users ADD id_user INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST");
            $db->query("INSERT INTO tb_users (id_user, nama, user, pass, kode_level, kode_prodi) VALUES ('$id_user','$nama', '$user', '$pass', '$kode_level', '$kode_prodi')");   
            $db->query("ALTER TABLE tb_users AUTO_INCREMENT=0");                       
            redirect_js("index.php?m=user");
        }                    
    } else if($mod=='user_ubah'){
        // $kode = $_POST['kode'];
        // $nama = $_POST['nama'];
        // $keterangan = $_POST['keterangan'];
        
        // if($kode=='' || $nama=='')
        //     print_msg("Field bertanda * tidak boleh kosong!");
     
            $db->query("UPDATE tb_users SET nama='$nama', user='$user', pass='$pass', kode_level='$kode_level', kode_prodi='$kode_prodi'  WHERE id_user='$_GET[ID]'");
            redirect_js("index.php?m=user");
            
    } else if ($act=='user_hapus'){
        $db->query("DELETE FROM tb_users WHERE id_user='$_GET[ID]'");
        header("location:index.php?m=user");
    } 

    /*-------------/user/------------*/ 
    
    /** ABSEN */
    elseif($mod=='absen_tambah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_dosen   = $_POST['kode_dosen'];    
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        $kode_prodi =$_POST['kode_prodi'];
        
        if(!$kode_dosen || !$kode_hari || !$dari || !$sampai)
            print_msg("Field yang bertanda * tidak boleh kosong!");        
        else{            
            $db->query("INSERT INTO tb_absen (kode_dosen, kode_hari, dari, sampai, kode_prodi) VALUES ('$kode_dosen', '$kode_hari', '$dari', '$sampai', '$kode_prodi')");                       
            redirect_js("index.php?m=absen");
        }
    } else if($mod=='absen_ubah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_dosen   = $_POST['kode_dosen'];    
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
            
        if(!$kode_dosen || !$kode_hari || !$dari || !$sampai)
            print_msg("Field yang bertanda * tidak boleh kosong!"); 
        else{
            $db->query("UPDATE tb_absen SET kode_dosen='$kode_dosen', kode_hari='$kode_hari', dari='$dari', sampai='$sampai' WHERE kode_absen='$_GET[ID]'");
            redirect_js("index.php?m=absen");
        }
    } else if ($act=='absen_hapus'){
        $db->query("DELETE FROM tb_absen WHERE kode_absen='$_GET[ID]'");
        header("location:index.php?m=absen");
    } 
}
?>

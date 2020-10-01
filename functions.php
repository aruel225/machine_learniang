<?php
// error_reporting(~E_NOTICE);
// session_start();
// ini_set("max_execution_time", "-1");
// ini_set("memory_limit", "-1");
// ignore_user_abort(true);
// set_time_limit(0);

// ini_set('max_execution_time',-1);

// ini_set('memory_limit', '4095M'); 
//ini_set('memory_limit', '1280M');

//include 'config.php';
// include'includes/db.php';
// $db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
//include'includes/general.php';
include 'config.php';

function AG_get_hari_option($selected = ''){
    global $db;
     $kd_prodi = $_SESSION['kode_prodi'];
    $rows = $db->get_results("SELECT kode_hari, nama_hari FROM tb_hari WHERE kode_prodi ='$kd_prodi' ORDER BY kode_hari");
    foreach($rows as $row){
        if($row->kode_hari==$selected)
            $a.="<option value='$row->kode_hari' selected>[$row->kode_hari] $row->nama_hari</option>";
        else
            $a.="<option value='$row->kode_hari'>[$row->kode_hari] $row->nama_hari</option>";
    }
    return $a;
}

function AG_get_jam_option($selected = ''){
    global $db;
     $kd_prodi = $_SESSION['kode_prodi'];
    $rows = $db->get_results("SELECT kode_jam, nama_jam FROM tb_jam WHERE kode_prodi = '$kd_prodi' ORDER BY nama_jam");
    foreach($rows as $row){
        if($row->kode_jam==$selected)
            $a.="<option value='$row->kode_jam' selected>[$row->kode_jam] $row->nama_jam</option>";
        else
            $a.="<option value='$row->kode_jam'>[$row->kode_jam] $row->nama_jam</option>";
    }
    return $a;
}
// sold
function AG_get_matkul_option($selected = ''){
    global $db;
     $kd_prodi = $_SESSION['kode_prodi'];
    $rows = $db->get_results("SELECT kode_matkul, nama_matkul FROM tb_matkul WHERE kode_prodi = '$kd_prodi' ORDER BY nama_matkul");
    foreach($rows as $row){
        if($row->kode_matkul==$selected)
            $a.="<option value='$row->kode_matkul' selected>[$row->kode_matkul] $row->nama_matkul</option>";
        else
            $a.="<option value='$row->kode_matkul'>[$row->kode_matkul] $row->nama_matkul</option>";
    }
    return $a;
}

function AG_get_dosen_option($selected = ''){
    global $db;
    $prodi_dosen = $_SESSION['kode_prodi'];
    $rows = $db->get_results("SELECT kode_dosen, nama_dosen FROM tb_dosen WHERE kode_prodi = '$prodi_dosen' ORDER BY nama_dosen");
    foreach($rows as $row){
        if($row->kode_dosen==$selected)
            $a.="<option value='$row->kode_dosen' selected>[$row->kode_dosen] $row->nama_dosen</option>";
        else
            $a.="<option value='$row->kode_dosen'>[$row->kode_dosen] $row->nama_dosen</option>";
    }
    return $a;
}
function AG_get_kelas_option($selected = ''){
    global $db;
    $prodi_kelas = $_SESSION['kode_prodi'];
    $rows = $db->get_results("SELECT kode_kelas, nama_kelas FROM tb_kelas WHERE kode_prodi = '$prodi_kelas'  ORDER BY nama_kelas");
    foreach($rows as $row){
        if($row->kode_kelas==$selected)
            $a.="<option value='$row->kode_kelas' selected>[$row->kode_kelas] $row->nama_kelas</option>";
        else
            $a.="<option value='$row->kode_kelas'>[$row->kode_kelas] $row->nama_kelas</option>";
    }
    return $a;
}


function AG_get_prodi_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_prodi, nama_prodi FROM tb_prodi ORDER BY kode_prodi");
    foreach($rows as $row){
        if($row->kode_prodi==$selected)
            $a.="<option value='$row->kode_prodi' selected>[$row->kode_prodi] $row->nama_prodi</option>";
        else
            $a.="<option value='$row->kode_prodi'>[$row->kode_prodi] $row->nama_prodi</option>";
    }
    return $a;
}
function AG_get_level_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_level, nama_level FROM tb_level ORDER BY kode_level");
    foreach($rows as $row){
        if($row->kode_level==$selected)
            $a.="<option value='$row->kode_level' selected>[$row->kode_level] $row->nama_level</option>";
        else
            $a.="<option value='$row->kode_level'>[$row->kode_level] $row->nama_level</option>";
    }
    return $a;
}

function AG_get_semester_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_semester, nama_semester FROM tb_semester ORDER BY kode_semester");
    foreach($rows as $row){
        if($row->kode_semester==$selected)
            $a.="<option value='$row->kode_semester' selected>[$row->kode_semester] $row->nama_semester</option>";
        else
            $a.="<option value='$row->kode_semester'>[$row->kode_semester] $row->nama_semester</option>";
    }
    return $a;

}



function set_value($value =NULL, $default = NULL)
{
    if(isset($value))
        return $value;
        
    return $default;
        
}
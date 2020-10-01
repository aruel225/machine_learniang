<?php

    error_reporting(~E_NOTICE & ~E_DEPRECATED);
    session_start();
    
    ini_set('max_execution_time', 4 * 60);
    ini_set('memory_limit', '128M');
    
    $config["server"]='localhost';
    $config["username"]='root';
    $config["password"]='';
    $config["database_name"]='ai_ag_dosen';
    
    include'includes/ez_sql_core.php';
    include'includes/ez_sql_mysqli.php';
    $db = new ezSQL_mysqli($config["username"], $config["password"], $config["database_name"], $config["server"]);
    include'includes/general.php';
    include'includes/paging.php';
        
    $mod = $_GET["m"];
    $act = $_GET["act"];                                             
?>
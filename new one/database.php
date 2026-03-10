<?php 
    $db_server = "127.0.0.1"; // note: during testing keep as "127.0.0.1", when live switch ip to "192.168.12.160"
    $db_user = "root";
    $db_pass = "";
    $db_name = "gabrimathdb";
    try{
    $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);

    if ($conn) {
        //echo "0";
    }
    else {
        echo "-1";
    }
    }
    catch(mysqli_sql_exception) {
        echo "Warn:    connection to GabriMathDB failed.<br>Error code: 1";
    }
    //echo "<br>Note: If you see '0', you may proceed with using GabriMath."
?>
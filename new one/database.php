<?php 
    $db_server = "localhost"; // note: during testing keep as "127.0.0.1", when live switch ip to "192.168.12.160"
    $db_user = "gabrimath";
    $db_pass = "geBjos-huxbug";
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
    catch(mysqli_sql_exception $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
    //echo "<br>Note: If you see '0', you may proceed with using GabriMath."
?>

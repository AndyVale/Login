<?php
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try{
        $con = new mysqli("localhost", "ute1nte1","123456789","provautenti");
        if($con->connect_errno)
        {
            die("ERROR 500");
        }
        $con->set_charset("utf8");
    }
    catch(mysqli_sql_exception $e)
    {
        error_log($e->getMessage(), 3, "../my-errors.log");
        die("ERROR 500");
    }
    $con->set_charset("utf8");
?>
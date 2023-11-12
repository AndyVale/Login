<?php
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = new mysqli("localhost", "utente1","123456789","provautenti");
    if($con->connect_errno)
    {
        die("ERROR 500");
    }
    //$charset = $con->character_set_name();
    $con->set_charset("utf8");
    //$newCharset = $con -> character_set_name();
    //echo "changed from $charset to $newCharset <br>";
?>
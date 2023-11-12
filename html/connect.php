<?php
    $con = new mysqli("localhost", "utente1","123456789","provautenti");
    if($con->connect_errno)
    {
        die("ERROR 500");
    }
?>
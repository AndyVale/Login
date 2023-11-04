<?php
    session_start();
    if(empty($_SESSION["email"]))
    {
        header("location: ./access.php");
    }
    else
    {
        echo "Welcome in the private page mr.".$_SESSION["email"];
    }
?>
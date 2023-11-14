<?php
    const COOKIE_NAME = "rememberMe";
    session_start();
    session_destroy();
    //rimuovo l'eventuale cookie rememberme
    if(!empty($_COOKIE[COOKIE_NAME])){
        setcookie(COOKIE_NAME, $cookie_value, time() - (3600));//lo faccio scadere
    }

    header("location: ./loginForm.php");

?>
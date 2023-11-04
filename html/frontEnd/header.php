<?php
    echo "<header><h1>Nome del sito</h1>";
    if(!empty($_SESSION['firstname']))
    {
        $name = $_SESSION['firstname'];
        echo "<span>Home</span><span>Welcome $name</span><span>Logout</span></header>";
    }
    else
    {
        echo "<span>Register</span><span>Login</span><span>Home</span></header>";
    }
?>
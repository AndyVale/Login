<?php
    echo "<header><h1>Nome del sito</h1>";
    if(!empty($_SESSION['firstname']))
    {
        $name = $_SESSION['firstname'];
        if($_SESSION['role'] == 1){
            echo "<a href='privatePage.php'><span>PrivatePage</span></a><span>Welcome $name</span><a href='logout.php'><span>Logout</span></a><a href='allUsers.php'><span>All Users</span></a></header>";            
        }else{
            echo "<a href='privatePage.php'><span>PrivatePage</span></a><span>Welcome $name</span><a href='logout.php'><span>Logout</span></a></header>";
        }
    }
    else
    {
        echo "<span>Register</span><span>Login</span></header>";
    }
?>
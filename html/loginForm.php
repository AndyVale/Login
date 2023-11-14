<!DOCTYPE HTML>
<?php
    const COOKIE_NAME = "rememberMe";

    if(!empty($_COOKIE[COOKIE_NAME])){//controllo se c'è un cookie rememberMe
        include ("connect.php");
        $query = "SELECT email, firstname, lastname, role FROM utenti WHERE rememberMe = ? AND expireDate > ?";
        $stmt = $con -> prepare($query);
        $cookie = $_COOKIE[COOKIE_NAME];
        $now = time();
        $stmt -> bind_param('si', $_COOKIE[COOKIE_NAME], $now);
        $stmt -> execute();
        $res = $stmt -> get_result();
        if($res -> num_rows == 1){
            $data = $res -> fetch_assoc();
            session_start();
            $_SESSION["email"] = $data["email"];
            $_SESSION["firstname"] = $data["firstname"];
            $_SESSION["lastname"] = $data["lastname"];
            $_SESSION["role"] = $data["role"];
            header("location: ./privatePage.php");
            $con -> close();
           
        }
        $con -> close();
    }
?>
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../style/login.css">
    </head>
    <body>
        <?php include 'header.php';?>
        <form id="registrazione" class="centered" method="POST" action="login.php">
            <fieldset name="register" class="centered accessFieldSet">
                <legend>Login</legend>
                <p><label>Email:          </label><input type="email" id="email" name="email" required></p>
                <p><label>Password:       </label><input type="password" id="pass" name="pass" required></p>
                <p><label>Remember me:       </label><input type="checkbox" id="rememberMe" name="rememberMe"></p>
                <input type="submit" value="Login">
            </fieldset>
        </form>
        <p class="centered">Prima volta qui?<a href="registrationForm.php">Registrati</a></p>
    </body>
</html>
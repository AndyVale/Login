<?php
//required fields check:
    if(empty($_POST["pass"]) || empty($_POST["email"]))
    {
        die("Check input data, some are missing");
    }

    $_POST["email"] = strtolower(trim($_POST["email"]));
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))//if the email is not valid do not perform login test
    {
        die('Wrong credentials');
    }
//login test:
    include ("connect.php");
    $query = "SELECT * FROM utenti WHERE email = '$_POST[email]'";
    try{
        $con -> query($query);
        if($con->affected_rows == 1)
        {
            $data = $con->query($query)->fetch_assoc();
            echo "welcome $data[nome] $data[cognome] $data[email]";
        }
    }catch(mysqli_sql_exception $e)
    {
        die("ERROR 500");
    }
?>

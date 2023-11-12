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
    $email = $con->real_escape_string($_POST["email"]);
    $query = "SELECT pass, firstname, lastname, role FROM utenti WHERE email = '$email'";
    try{
        
        $data = $con -> query($query)-> fetch_assoc();
        //echo $con ->affected_rows;
        if($con->affected_rows == 1)
        {
            if(password_verify($_POST["pass"], $data["pass"]))
            {
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["firstname"] = $data["firstname"];
                $_SESSION["lastname"] = $data["lastname"];
                $_SESSION["role"] = $data["role"];
                echo "welcome $data[firstname] $data[lastname]";
            }
            else
            {
                die("Controllo credenziali fallito");
            }
        }
        else
        {
            die("Impossibile accedere, si prega di riprovare più tardi");
        }
    }catch(mysqli_sql_exception $e)
    {
        die("ERROR 500");
    }
?>

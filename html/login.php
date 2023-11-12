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

    include ("connect.php");
    $query = "SELECT pass, firstname, lastname, role FROM utenti WHERE email = ?";
    $stmt = $con -> prepare($query);
    $stmt -> bind_param('s', $_POST["email"]);
    $stmt -> execute();
    $res = $stmt -> get_result();
    $data = $res -> fetch_assoc();

    try{    
        echo $con ->affected_rows;
        if($con->affected_rows == 1)
        {
            if(password_verify($_POST["pass"], $data["pass"]))
            {
                session_start();
                $_SESSION["firstname"] = $data["firstname"];
                $_SESSION["lastname"] = $data["lastname"];
                $_SESSION["role"] = $data["role"];
                echo "welcome $data[firstname] $data[lastname]";
                $stmt -> close();
                $con -> close();
            }
            else
            {
                $stmt -> close();
                $con -> close();
                die("Controllo credenziali fallito");
            }
        }
        else
        {
            $stmt -> close();
            $con -> close();
            die("Impossibile accedere, si prega di riprovare più tardi");
        }
    }catch(mysqli_sql_exception $e)
    {   
        error_log($e->getMessage(), 3, "../my-errors.log");
        die("ERROR 500");
    }
?>

<!--
    $query = "SELECT pass, firstname, lastname, role FROM utenti WHERE email = ?";
    $stmt = $con -> prepare($query);
    $stmt -> bind_param('s', $email);
    $stmt -> execute();
    try{
        $res = $stmt -> get_result();
        var_dump($res);
        $row = $res -> fetch_assoc();
        var_dump($row);
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
                $stmt -> close();
                $con -> close();
            }
            else
            {
                $stmt -> close();
                $con -> close();
                die("Controllo credenziali fallito");
            }
        }
        else
        {
            $stmt -> close();
            $con -> close();
            die("Impossibile accedere, si prega di riprovare più tardi");
        }
    }catch(mysqli_sql_exception $e)
    {
        die("ERROR 500");
    }
-->
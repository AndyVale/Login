<?php
    const COOKIE_NAME = "rememberMe";
    
//required fields check:
    if(empty($_POST["pass"]) || empty($_POST["email"]))
    {
       header("location: ./loginForm.php");
    }

    $_POST["email"] = strtolower(trim($_POST["email"]));
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))//if the email is not valid do not perform login test
    {
        die('Wrong credentials');
    }

    include ("rememberMe.php");
    include ("connect.php");
    $query = "SELECT pass, firstname, lastname, role, email FROM utenti WHERE email = ?";
    $stmt = $con -> prepare($query);
    $stmt -> bind_param('s', $_POST["email"]);
    $stmt -> execute();
    $res = $stmt -> get_result();
    $data = $res -> fetch_assoc();

    try{    
        if($con->affected_rows == 1)
        {
            if(password_verify($_POST["pass"], $data["pass"]))
            {
                session_start();
                $_SESSION["firstname"] = $data["firstname"];
                $_SESSION["lastname"] = $data["lastname"];
                $_SESSION["role"] = $data["role"];
                $stmt -> close();
                //if $_POST["rememberMe"] is set, remember the user:
                if(!empty($_POST[COOKIE_NAME])){//se arriva l'informazione in POST per ricordare il cookie
                    $cookie_value = password_hash(random_bytes(12), PASSWORD_DEFAULT);//hash del cookie "casuale"
                    $expireTime = time() + (86400 * 30);//30 giorni
                    setcookie(COOKIE_NAME, $cookie_value, $expireTime); // 86400 = 1 day
                    $query = "UPDATE utenti SET rememberMe = ?, expireDate = ? WHERE email = ?";
                    $stmt = $con -> prepare($query);
                    $stmt -> bind_param('sis', $cookie_value, $expireTime, $_POST["email"]);
                    $stmt -> execute();
                    if($con->affected_rows != 1) {
                        die("Impossibile impostare il cookie");
                    }
                    $stmt -> close();
                }
                
                header("location: ./privatePage.php");
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

<?php
    const FILE_PATH="users.txt";
//required fields check:
    if(empty($_POST["pass"]) || empty($_POST["email"]))
    {
        die("Check input data, some are missing");
    }

    if(file_exists(FILE_PATH))//to avoid warning
    {
        $file = fopen(FILE_PATH, 'r');
    }
    else
    {
        die("ERROR 500");
    }

    $_POST["email"] = strtolower(trim($_POST["email"]));
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))//if the email is not valid do not perform login test
    {
        die('Wrong credentials');
    }
//login test:
    flock($file,LOCK_SH);
        $currLine = fgets($file);
        while($currLine)
        {
            $data = json_decode($currLine,true);
            if(isset($data['email']) && $data['email'] == $_POST['email'])
            {
                if(isset($data['pass']) && password_verify(trim($_POST["pass"]), $data['pass']))
                {
                    echo 'Successful login, welcome '.$data['firstname']." ".$data["lastname"];
                    session_start();
                    $_SESSION["email"] = $data["email"];
                    $_SESSION["firstname"] = $data["firstname"];
                }
                else
                {
                    header("Location: ../frontEnd/access.php?error=1");
                }
                break;
            }
            $currLine = fgets($file);
        }    
    flock($file,LOCK_UN);
    
    fclose($file);
?>

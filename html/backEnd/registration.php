<?php
    const FILE_PATH = "users.txt";
//required fields check:
    if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["pass"]) || empty($_POST["confirm"]))
    {
        die("Check input data, some are missing");
    }

    //integrity check:
    if($_POST['pass'] != $_POST['confirm'])
    {
        die("Passwords do not match");
    }

    $_POST['email'] = strtolower(trim($_POST['email']));//to avoid "fake uniqueness"
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        //email uniqueness check:
        if(file_exists(FILE_PATH))//to avoid warning
        {
            $file = fopen(FILE_PATH, 'r');
        }
        else
        {
            die("ERROR 500");
        }
    
        flock($file,LOCK_SH);
            $currLine = fgets($file);
            while($currLine)
            {
                $data = json_decode($currLine,true);
                if(isset($data['email']) && $data['email'] == $_POST['email'])
                {
                    flock($file,LOCK_UN);
                    fclose($file);
                    die("Email is already used");
                }
                $currLine = fgets($file);
            }    
        flock($file,LOCK_UN);
        fclose($file);
    }
    else
    {
        die("Wrong email format");
    }

    $file = fopen(FILE_PATH, 'a') or exit('ERROR 500');

//sanitize data:
    $data = array('firstname' => htmlentities(trim($_POST['firstname'])), 'lastname' => htmlentities(trim($_POST['lastname'])), 'email' => htmlentities($_POST['email']), 'pass' => password_hash(trim($_POST['pass']), PASSWORD_DEFAULT));

//not required fields (to use some regex):
    if(!empty($_POST['badge']))//Badge Number
    {
        if(preg_match("/^[S][0-9]{7}$/",($_POST['badge'])) == 1)
        {
            $data['badge'] = $_POST['badge'];
        }
        else
        {
            die('Wrong badge number format');
        }
    }
    if(!empty($_POST['idNumber']))//ID number
    {
        if(preg_match("/^[A-Z]{2}[0-9]{5}[A-Z]{2}$/",($_POST['idNumber'])) == 1)
        {
            $data['idNumber'] = $_POST['idNumber'];
        }
        else
        {
            die('Wrong ID number format');
        }
    }

 //write on file:
    flock($file,LOCK_EX);
        fwrite($file, json_encode($data)."\n");
    flock($file,LOCK_UN);
    echo 'Successful registration';

    fclose($file);
?>
<?php
//required fields check:
    if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["pass"]) || empty($_POST["confirm"]))
    {
        header("location: ./registrationForm.php");
    }

    //integrity check:
    if($_POST['pass'] != $_POST['confirm'])
    {
        die("Passwords do not match");
    }

//sanitize data:
    $data = array('firstname' => trim($_POST['firstname']), 'lastname' => trim($_POST['lastname']), 'email' => $_POST['email'], 'pass' => password_hash(trim($_POST['pass']), PASSWORD_DEFAULT));

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

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))//TODO: questo potrebbe farlo il database?
    {
        include("connect.php");
        
        $data['email'] = $con->real_escape_string(htmlentities(strtolower($data['email'])));
        $data['firstname'] = $con->real_escape_string(htmlentities($data['firstname']));
        $data['lastname'] = $con->real_escape_string(htmlentities($data['lastname']));

        $query = "INSERT INTO utenti (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)";//TODO: aggiungere campi facoltativi
        $stmt = $con -> prepare($query);
        $stmt -> bind_param('ssss', $data['firstname'], $data['lastname'], $data['email'], $data['pass']);
        try{
            $stmt -> execute();//lancia eccezioni pure questa
            $result = $stmt -> get_result();
            echo "Successful registration, welcome $data[firstname] $data[lastname]";
            session_start();
            $_SESSION["email"] = $data["email"];
            $_SESSION["firstname"] = $data["firstname"];
        }
        catch(mysqli_sql_exception $e)
        {
            error_log($e->getMessage(), 3, "../my-errors.log");
            die("ERROR 500");
        }
       $con -> close();
    }
    else
    {
        die("Wrong email format");
    }
?>
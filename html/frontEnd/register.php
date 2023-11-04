<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../../style/login.css">
    </head>
    <body>
        <?php include 'header.php';?>
            <form id="registrazione" class="centered" method="POST" action="../backEnd/registration.php">
                <fieldset name="register" class="centered accessFieldSet">
                    <legend>Register</legend>
                    <p><label>Your Firstname*: </label><input type="text" id="firstname" name="firstname"></p>
                    <p><label>Your LastName*:  </label><input type="text" id="lastname" name="lastname"></p>
                    <p><label>Email*:          </label><input type="text" id="email" name="email"></p>
                    <p><label>Password*:       </label><input type="password" id="pass" name="pass"></p>
                    <p><label>Verify password*:</label><input type="password" id="confirm" name="confirm"></p>
                    <p><label>Your badge number:    </label><input type="text" id="badge" name="badge" placeholder="S0000000"></p>
                    <p><label>Your ID number:    </label><input type="text" id="idNumber" name="idNumber" placeholder="AA00000AA"></p>
                    <input type="submit" value="Register">
                </fieldset>
            </form>
            <p class="centered">Sei già registrato?<a href="./access.php">Accedi</a></p>    
    </body>
</html>
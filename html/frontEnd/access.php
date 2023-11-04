<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../../style/login.css">
    </head>
    <body>
        <form id="registrazione" class="centered" method="POST" action="../backEnd/login.php">
            <fieldset name="register" class="centered accessFieldSet">
                <legend>Login</legend>
                <p><label>Email:          </label><input type="email" id="email" name="email" required>       </p>
                <p><label>Password:       </label><input type="password" id="pass" name="pass" required>      </p>
                <input type="submit" value="Login"></input>
            </fieldset>
        </form>
        <p class="centered">Prima volta qui?<a href="register.php">Registrati</a></p>
    </body>
</html>

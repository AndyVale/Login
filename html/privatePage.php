<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>shhh...Private page</title>
        <link rel="stylesheet" type="text/css" href="../style/login.css">
    </head>
    <body>
        <?php
        session_start();
            if(empty($_SESSION["email"]))
            {
                header("location: ./loginForm.php");
            }
            else
            {
                include("header.php");
            }
            echo "$_SESSION[role]";

        ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/HCagnxGHC_M?si=1k6H-hUCaQAEodkz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </body>
</html>
<?php
    session_start();
    echo $_SESSION["role"];
    if(empty($_SESSION["role"]) || $_SESSION["role"] != 1)
    {
        header("location: ./loginForm.php");
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>All Users</title>
</head>
<body>
    <h1>Tabel with all users:</h1>
    <table>
        <thead>
            <tr>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Email</th>
                <th>Badge</th>
                <th>ID Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include("connect.php");
                $query = "SELECT * FROM utenti ORDER BY lastname";
                $res = $con->query($query);
                while($row = $res->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['badge']."</td>";
                    echo "<td>".$row['idNumber']."</td>";
                    echo "</tr>";
                }
                $res -> free();
                $con -> close();
            ?>
        </tbody>
    </table>
</body>

</html>

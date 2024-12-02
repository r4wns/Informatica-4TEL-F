<?php
    include "connessione/connect.php"
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $email = $_POST["email"];
        $psw = $_POST["password"];

        $query = "SELECT `email`, `password`, `firstname` FROM `users` WHERE `email` = '".$email."' AND `password` = '".$psw."'";
        $result = mysqli_query($conn, $query);

        if($result AND $result -> num_rows > 0)
        {
            $row = $result -> fetch_assoc();
            //echo var_dump($row);

            echo "Benvenuto, ".$row["firstname"]."! Accesso eseguito con successo!";
        }
        else
        {
            echo "Errore nelle credenziali <br>";
            echo "<a href = 'index.php' Torna al login </a>";
        }
    ?>
</body>
</html>
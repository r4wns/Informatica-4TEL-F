<?php
    include "connessione/connect.php";
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inserimento</title>
    </head>
    <body>
        <?php
            if($conn->connect_errno != 0) {
                echo "<h1>Errore di connessione</h1>";
                exit();
            }

            /* INSERIMENTO DATI */
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $user_email = $_POST["user_email"];
            $user_password = $_POST["user_password"];
            $user_birth = $_POST["user_birth"];
            $user_graduation = $_POST["user_graduation"];
            $user_region = $_POST["user_region"];
            $user_province = $_POST["user_province"];

            $control = "SELECT 'email' FROM 'users' WHERE 'email' = " .$user_email"'";
            //echo $controllo
            $result_control = mysqli_query($conn, $control);

            if($result_control->num_rows > 0)
            {
                echo "<h1>Utente gia' registrato</h1>";
                echo "<a href='index.php'>Torna al login</a>";
            }
            else 
            {
                $query_insert = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `birth_date`, `graduation`, `region`, `province`) VALUES ('$firstname','$lastname','$user_email','$user_password','$user_birth', $user_graduation,$user_region,$user_province)";
                //echo $query_insert;
                $result = mysqli_query($conn, $query_insert);
                if($result) {
                    echo "<h1>Registrazione avvenuta con successo</h1>";
                    echo "<a href='index.php'>Torna al login</a>";
                } else {
                    echo "<h1>OPSS. Errore nella registrazione. Riprova</h1>";
                    echo "<a href='index.php'>Torna al login</a>";
                }
            }

            
        ?>
    </body>
</html>
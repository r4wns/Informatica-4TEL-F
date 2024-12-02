<?php
    include "connessione/connect.php";
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista utenti</title>

        <style>
            table {
                width: 100%;
            }

            table, td, th {
                border: solid 1px;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>

        <h1>Lista utenti registrati</h1>
        <?php
            // Interrogo il database ricavando i dati che mi servono dalla tabella users
            $query_ricevi= "SELECT `firstname`,`lastname`, `email`, `birth_date` FROM `users`"; 
            
            //Eseguo la query di SELECT
            $result = mysqli_query($conn, $query_ricevi);
        
            //Controllo se la query di SELECT è avvenuta con successo
            if($result) {
                // Query avvenuta con successo
                
                /*
                    Controllo se la query ha restituito un numero di righe
                    accedo al valore della chiave "num_rows"
                    per vedere l'array eseguire:
                    ** echo var_dump($result);
                */
                if($result->num_rows > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>NOME</th>";
                    echo "<th>COGNOME</th>";
                    echo "<th>EMAIL</th>";
                    echo "</tr>";

                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        
                        echo "<td>".$row["firstname"]."</td>";
                        echo "<td>".$row["lastname"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        //cout << "<td>" << $row["firstname"] << "</td>";

                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Non ho nulla da mostrare. Nessun utente si è registrato";
                }

            } else {
                // Query error
                echo "<h1>OPSS. Errore nella query. Riprova</h1>";
            }

            

        ?>
        
        <a href="index.php">Torna a Login</a>

    </body>
</html>
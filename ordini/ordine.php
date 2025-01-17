<?php

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine</title>
</head>
<body>
    <div class="container">
        <h1>ORDINE</h1>
        <form method="POST">
            <label>Data:</label>
            <input type="date" name="data" required><br>
            <label>Ora:</label>
            <input type="time" name="ora" required><br>
            <label>Numero Tavolo:</label>
            <input type="number" name="numero_tavolo" required><br>
            <?php
            /*

            [With php we'll have to create 5 elements (div) 
            to make the dishes readable from the database.]

            $menu = ['Pasta', 'Pizza', 'Insalata', 'Bistecca', 'Zuppa'];
            for ($i = 0; $i < 5; $i++) {
                echo "<label>Pietanza " . ($i + 1) . ":</label><br>";
                echo "<select name='pietanze[$i][nome]'>";
                foreach ($menu as $pietanza) {
                    echo "<option value='$pietanza'>$pietanza</option>";
                }
                echo "</select>";
                echo "<label>Quantità:</label>";
                echo "<input type='number' name='pietanze[$i][quantita]' min='1' required><br><br>";
            }
            */
            ?>
            <?php
                //Connection to the database
                include "./connect.php"

                $query = "SELECT dish_name, id from dishes";
                $result = $conn -> query($query);

                $optionList = "";

                //Cycle for all dishes
                while($row = $result->fetch_asssoc())
                //Construct one of the <option>
                {
                    //$row['name'] is the name of one of the dishes
                    $dish_name = $row['name'];
                    $optionList .= "<option value = '{$dish_name}'> {$dish_name} </option>";
                }

                //Create for 5 times the rows in which we will add the plates

                for($i=0; $i<=5; $i++)
                {
                    echo "<div class = 'row'>
                            <select name = 'dish{$i+1}'>
                                {$optionList}
                            </select>

                            <input type = 'number' name = 'qty{$i+1}'>
                        </div>";
                }


                //ALWAYS close the connection to the database
                $conn -> close();
            ?>

            <button type="submit">Invia Ordine</button>
        </form>
    </div>
</body>
</html>

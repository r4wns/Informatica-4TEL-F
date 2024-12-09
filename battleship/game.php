<?php
// game.php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ships = isset($_GET['ships']) ? explode(",", $_GET['ships']) : [2, 3, 4, 5];
    $level = $_GET['level'] ?? 'easy';

    // Determine number of ships based on difficulty
    switch ($level) {
        case 'medium':
            $numShips = 10;
            break;
        case 'hard':
            $numShips = 5;
            break;
        default:
            $numShips = 20;
            break;
    }

    // Generate a 10x10 game board (initialize with all empty cells)
    $board = array_fill(0, 10, array_fill(0, 10, null));

    // Function to place ships randomly on the board
    function placeShips(&$board, $ships, $numShips) {
        $placedShips = 0;
        $attempts = 0;
        
        while ($placedShips < $numShips && $attempts < 1000) {
            $shipSize = $ships[array_rand($ships)]; // Random ship size from the array
            $direction = rand(0, 1) ? 'H' : 'V'; // Random direction (H = Horizontal, V = Vertical)
            $row = rand(0, 9);
            $col = rand(0, 9);

            if (canPlaceShip($board, $row, $col, $shipSize, $direction)) {
                placeShip($board, $row, $col, $shipSize, $direction);
                $placedShips++;
            }

            $attempts++;
        }
    }

    // Check if a ship can be placed at a given position
    function canPlaceShip($board, $row, $col, $shipSize, $direction) {
        if ($direction == 'H') {
            if ($col + $shipSize > 10) return false; // Out of bounds
            for ($i = 0; $i < $shipSize; $i++) {
                if ($board[$row][$col + $i] !== null) return false; // Collision with another ship
            }
        } else { // Vertical placement
            if ($row + $shipSize > 10) return false; // Out of bounds
            for ($i = 0; $i < $shipSize; $i++) {
                if ($board[$row + $i][$col] !== null) return false; // Collision with another ship
            }
        }
        return true;
    }

    // Place the ship on the board
    function placeShip(&$board, $row, $col, $shipSize, $direction) {
        if ($direction == 'H') {
            for ($i = 0; $i < $shipSize; $i++) {
                $board[$row][$col + $i] = 'S';
            }
        } else {
            for ($i = 0; $i < $shipSize; $i++) {
                $board[$row + $i][$col] = 'S';
            }
        }
    }

    // Place ships on the board based on selected ships and difficulty level
    placeShips($board, $ships, $numShips);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battleship Game</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 30px;
            height: 30px;
            text-align: center;
            border: 1px solid black;
        }
        .ship {
            background-color: gray;
        }
        .hit {
            background-color: red;
        }
        .miss {
            background-color: blue;
        }
    </style>
</head>
<body>
    <h1>Battleship Game - <?php echo ucfirst($level); ?> Level</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <?php for ($i = 0; $i < 10; $i++) { echo "<th>" . chr(65 + $i) . "</th>"; } ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($row = 0; $row < 10; $row++) { ?>
                <tr>
                    <th><?php echo $row + 1; ?></th>
                    <?php for ($col = 0; $col < 10; $col++) { ?>
                        <td class="<?php echo $board[$row][$col] == 'S' ? 'ship' : ''; ?>"></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

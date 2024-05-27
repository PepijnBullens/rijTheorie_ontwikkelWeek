<?php
    include_once './db_connect.php';
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
        if(isset($_SESSION["answers"])) {
            foreach($_SESSION["answers"] as $answer) {
    ?>

    <p><?= $answer["question"] ?></p>
    <h5><?= $answer["correct"] ? '\'' . $answer["userAnswer"] . '\' is correct!' : 'Sorry... \'' . $answer["correctAnswer"] . '\' is het correcte antwoord.' ?>
    </h5>
    <small>id: <?= $answer["id"] ?></small>

    <?php
            }
        }
    ?>
</body>

</html>
<?php
    include_once './db_connect.php';

    if(!isset($_SESSION["answers"]) || !isset($_SESSION["types"])) {
        header('location: ./index.php');
        die();
    } else {
        $passed;

        $correctAnswerCount;

        foreach($_SESSION["types"] as $type) {
            $correctAnswerCount[$type["name"]]["count"] = 0;
            foreach($_SESSION["answers"] as $answer) {
                if($answer["category"] == $type["name"] && $answer["correct"] === true) {
                    $correctAnswerCount[$type["name"]]["count"]++;
                }
            }
            if($correctAnswerCount[$type["name"]]["count"] >= $type["neededForPassing"]) {
                $correctAnswerCount[$type["name"]]["passed"] = true;
            } else {
                $correctAnswerCount[$type["name"]]["passed"] = false;
                $passed = false;
            }
        }

        prettyDump($correctAnswerCount);
    }
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
            foreach($_SESSION["answers"] as $answer) {
    ?>

    <p><?= $answer["question"] ?></p>
    <h5><?= $answer["correct"] ? '\'' . $answer["userAnswer"] . '\' is correct!' : 'Sorry... \'' . $answer["correctAnswer"] . '\' is het correcte antwoord.' ?>
    </h5>
    <small>id: <?= $answer["id"] ?></small>

    <?php
            }
    ?>
</body>

</html>
<?php
    include_once './core/db_connect.php';

    if(!isset($_SESSION["answers"]) || !isset($_SESSION["types"])) {
        header('location: ./index.php');
        die();
    } else {
        $passed;

        $correctAnswerCount;

        foreach($_SESSION["types"] as $type) {
            $correctAnswerCount[$type["name"]]["name"] = $type["name"];
            $correctAnswerCount[$type["name"]]["totalCount"] = $type["count"];
            $correctAnswerCount[$type["name"]]["wrongCount"] = 0;
            $correctAnswerCount[$type["name"]]["neededCount"] = $type["neededForPassing"];
            
            foreach($_SESSION["answers"] as $answer) {
                if($answer["category"] == $type["name"] && $answer["correct"] === false) {
                    $correctAnswerCount[$type["name"]]["wrongCount"]++;
                }
            }
            if($correctAnswerCount[$type["name"]]["wrongCount"] <= $correctAnswerCount[$type["name"]]["totalCount"] - $correctAnswerCount[$type["name"]]["neededCount"]) {
                $correctAnswerCount[$type["name"]]["passed"] = true;
                $passed = true;
            } else {
                $correctAnswerCount[$type["name"]]["passed"] = false;
                $passed = false;
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="./assets/css/results.css" rel="stylesheet">

</head>

<body>
    <div id="content">
        <a onclick="reset();">maak opnieuw</a>
        <div id="top">
            <img style="<?= $passed ? "border-color: green;" : "border-color: red;" ?>"
                src="./assets/<?= $passed ? "passed.png" : "notPassed.png" ?>">

            <div id="section_results">
                <?php
                    foreach($correctAnswerCount as $item) {
                        $needed = $item["totalCount"] - $item["neededCount"];
                ?>
                <div style="<?= $item["passed"] ? "color: green; border-color: green;" : "color: red; border-color: red;" ?>"
                    class="result_text">
                    <h4><?= $item["name"] ?></h4>
                    <p><?= $item["passed"] ? "voldoende" : "onvoldoende" ?> - <?= $item["wrongCount"] ?> van de
                        <?= $item["totalCount"] ?> fout</p>
                    <p>je mocht <?= $needed ?> fout hebben</p>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="bottom">
            <img onclick="flip();" src="./assets/arrow.svg" id="view_results" alt="">
            <div id="answerTable" class="answers">
                <?php
                    foreach($_SESSION["answers"] as $answer) {
                ?>
                <div class="answer"
                    style="<?= $answer["correct"] ? "color: green; border-color: green;" : "color: red; border-color: red;" ?>">

                    <p><?= $answer["question"] ?></p>
                    <?php
                        if($answer["userAnswer"] === "Niet op tijd beantwoord...") {
                ?>

                    <h5>Niet op tijd beantwoord...</h5>

                    <?php
                        }
                ?>
                    <h5><?= $answer["correct"] ? '\'' . $answer["userAnswer"] . '\' is correct!' : '\'' . $answer["correctAnswer"] . '\' is het correcte antwoord.' ?>
                    </h5>
                    <small>id: <?= $answer["id"] ?></small>

                </div>

                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="./assets/js/back_end.js"></script>
    <script src="./assets/js/front_end.js"></script>
</body>

</html>
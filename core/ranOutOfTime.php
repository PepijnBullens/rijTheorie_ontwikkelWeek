<?php
    include_once './db_connect.php';

    $id = $_SESSION["activeQuestion"];

    $stmt = $con->prepare("SELECT id, question, options FROM questions WHERE id = ? LIMIT 1;");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $id = $row["id"];
        $question = $row["question"];
        $decodedOptions = json_decode($row["options"]);
    }

    $userAnswer;
    $correctAnswer;
    $correct = false;

    $hazardRecognitionOptions = [
        "Remmen",
        "Gas loslaten",
        "Niets"
    ];

    if($_SESSION["types"][$_SESSION["typeIndex"]]["name"] == "Gevaar Herkenning") {
        $correctAnswer = $hazardRecognitionOptions[$decodedOptions[0]];
    } else {
        $correctAnswer = $decodedOptions[0];
    }


    $_SESSION["answers"][] = [
        "id" => $id,
        "category" => $_SESSION["types"][$_SESSION["typeIndex"]]["name"],
        "question" => $question,
        "userAnswer" => "Niet op tijd beantwoord...",
        "correctAnswer" => $correctAnswer,
        "correct" => $correct
    ];

    $_SESSION["questionIndex"]++;

    unset($_SESSION["currentAnswer"]);

    echo 'RELOAD';
?>
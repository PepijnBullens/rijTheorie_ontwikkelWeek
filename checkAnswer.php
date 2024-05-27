<?php
    include_once './db_connect.php';

    if(isset($_SESSION["currentAnswer"])) {
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
    
        if($_SESSION["currentType"][$_SESSION["typeIndex"]]["name"] == "hazardRecognition") {
            if($decodedOptions[0] === $_SESSION["currentAnswer"]) {
                $correct = true;
            }
            $userAnswer = $_SESSION["currentAnswer"];
            $correctAnswer = $decodedOptions[0];
        } else {
            if($decodedOptions[0] === $decodedOptions[$_SESSION["currentAnswer"]]) {
                $correct = true;
            }
            $userAnswer = $decodedOptions[$_SESSION["currentAnswer"]];
            $correctAnswer = $decodedOptions[0];
        }
    
    
        $_SESSION["answers"][] = [
            "id" => $id,
            "question" => $question,
            "userAnswer" => $userAnswer,
            "correctAnswer" => $correctAnswer,
            "correct" => $correct
        ];
    
        $_SESSION["questionIndex"]++;
    
        unset($_SESSION["currentAnswer"]);
    
        echo 'RELOAD';
    }
?>
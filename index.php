<?php
    include_once './core/db_connect.php';

    $hazardRecognition = [
        "name" => "Gevaar Herkenning",
        "count" => 25,
        // 25
        "neededForPassing" => 13,
        "type" => 4,
        "options" => [
            [
                "front" => "Remmen",
                "back" => 0
            ],
            [
                "front" => "Gas loslaten",
                "back" => 1
            ],
            [
                "front" => "Niets",
                "back" => 2
            ]
        ]
    ];

    $knowledge = [
        "name" => "Kennis",
        "count" => 12,
        // 12
        "neededForPassing" => 10,
        "type" => 1,
        "options" => [
            [
                "front" => null,
                "back" => 0
            ],
            [
                "front" => null,
                "back" => 1
            ],
            [
                "front" => null,
                "back" => 2
            ]
        ]
    ];

    $insight = [
        "name" => "inzicht",
        "count" => 28,
        // 28
        "neededForPassing" => 25,
        "type" => 2,
        "options" => [
            [
                "front" => null,
                "back" => 0
            ],
            [
                "front" => null,
                "back" => 1
            ],
            [
                "front" => null,
                "back" => 2
            ]
        ]
    ];
    
    if(!isset($_SESSION["answers"])) $_SESSION["answers"] = [];

    if(!isset($_SESSION["types"])) $_SESSION["types"] = [
        $hazardRecognition,
        $knowledge,
        $insight
    ];
    if(!isset($_SESSION["typeIndex"])) $_SESSION["typeIndex"] = 0;

    if(!isset($_SESSION["questions"])) $_SESSION["questions"] = null;
    if(!isset($_SESSION["questionIndex"])) $_SESSION["questionIndex"] = 0;

    if($_SESSION["questions"] === null) {
        $stmt = $con->prepare("SELECT id, image, question, feedback, options FROM questions WHERE type = ? ORDER BY RAND() LIMIT ?;");
        $stmt->bind_param("ii", $_SESSION["types"][$_SESSION["typeIndex"]]["type"], $_SESSION["types"][$_SESSION["typeIndex"]]["count"]);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["questions"][] = $row;
            }
        }
    }

    if(isset($_SESSION["questions"][$_SESSION["questionIndex"]])) {
        $row = $_SESSION["questions"][$_SESSION["questionIndex"]];
        $_SESSION["activeQuestion"] = $row["id"];

        $options = [];

        if($_SESSION["types"][$_SESSION["typeIndex"]]["name"] === "Gevaar Herkenning") {
            foreach($_SESSION["types"][$_SESSION["typeIndex"]]["options"] as $option) {
                $options[] = [
                    "front" => $option["front"],
                    "back" => $option["back"],
                ];
            }
        } else {
            $decodedFrontOptions = json_decode($_SESSION["questions"][$_SESSION["questionIndex"]]["options"]);
            foreach($_SESSION["types"][$_SESSION["typeIndex"]]["options"] as $key => $option) {
                $options[] = [
                    "front" => $decodedFrontOptions[$key],
                    "back" => $option["back"],
                ];
            }

            shuffle($options);
        }

        if($_SESSION["questions"] === null) {
            $stmt = $con->prepare("SELECT id, image, question, feedback, options FROM questions WHERE type = ? ORDER BY RAND() LIMIT ?;");
            $stmt->bind_param("ii", $_SESSION["types"][$_SESSION["typeIndex"]]["type"], $_SESSION["types"][$_SESSION["typeIndex"]]["count"]);
            $stmt->execute();
    
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION["questions"][] = $row;
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gevaren herkenning</title>
    <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="timer">
            <p id="timer_text">1</p>
        </div>
    </header>

    <div id="content">
        <?php
            if(isset($_SESSION["questions"][$_SESSION["questionIndex"]])) {
                $row = $_SESSION["questions"][$_SESSION["questionIndex"]];
                $_SESSION["activeQuestion"] = $row["id"];

                $options = [];

                if($_SESSION["types"][$_SESSION["typeIndex"]]["name"] === "Gevaar Herkenning") {
                    foreach($_SESSION["types"][$_SESSION["typeIndex"]]["options"] as $option) {
                        $options[] = [
                            "front" => $option["front"],
                            "back" => $option["back"],
                        ];
                    }
                } else {
                    $decodedFrontOptions = json_decode($_SESSION["questions"][$_SESSION["questionIndex"]]["options"]);
                    foreach($_SESSION["types"][$_SESSION["typeIndex"]]["options"] as $key => $option) {
                        $options[] = [
                            "front" => $decodedFrontOptions[$key],
                            "back" => $option["back"],
                        ];
                    }

                    shuffle($options);
                }
        ?>


        <div id="section_pic">
            <img src="./assets/imgs/<?= $row["image"] ?>">
        </div>
        <div id="section_answers">
            <p><?= $row["question"] ?></p>

            <?php
                foreach($options as $option) {
                    if($option["front"] != '' && $option["back"] != '') {
            ?>

            <div onclick="select(this); setSelectedOption(<?= $option['back'] ?>);" class="answer_options">
                <p class="answer_text"><?= $option["front"] ?></p>
            </div>

            <?php
                    }
                }
            ?>

        </div>

        <?php
            }
        ?>
    </div>

    <footer>
        <p id="footer_text">Vraag <?= $_SESSION["questionIndex"] + 1 ?> van
            <?= $_SESSION["types"][$_SESSION["typeIndex"]]["count"] ?></p>
        <button onclick='checkAnswer();'>Volgende</button>
    </footer>
    <script src="./assets/js/back_end.js"></script>
    <script src="./assets/js/front_end.js"></script>
</body>

</html>

<?php
    } else if($_SESSION["typeIndex"] + 1 < count($_SESSION["types"])) {
        $_SESSION["typeIndex"]++;
        $_SESSION["questionIndex"] = 0;
        $_SESSION["questions"] = null;
        header('Refresh:0');
    } else {
        header('location: ./results.php');
    }
?>
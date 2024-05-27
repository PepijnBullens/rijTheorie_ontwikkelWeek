<?php
    include_once './db_connect.php';

    $hazardRecognition = [
        "count" => 26,
        "type" => 4,
        "options" => [
            "Brake",
            "Release gas",
            "Nothing"
        ]
    ];

    $currentType = $hazardRecognition;

    $stmt = $con->prepare("SELECT id, image, question FROM questions WHERE type = ? ORDER BY RAND() LIMIT ?;");
    $stmt->bind_param("ii", $currentType["type"], $currentType["count"]);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
?>

<div class="question">
    <img src="./img/<?= $row["image"] ?>" alt="image">
    <p><?= $row["question"] ?></p>
    <?php
        foreach($currentType["options"] as $option) {
    ?>

    <button><?= $option ?></button>

    <?php
        }
    ?>
</div>

<?php
        }
    }
?>
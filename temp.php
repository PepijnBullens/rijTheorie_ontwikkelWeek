<?php
    include_once './db_connect.php';

    // $data = json_decode(file_get_contents('./data.json'), true);

    // foreach($data as $item) {
    //     $stmt = $con->prepare("INSERT INTO questions (id, category, type, image, question, feedback, options) VALUES (?, ?, ?, ?, ?, ?, ?);");
    //     $temp = json_encode($item["options"]);
    //     $stmt->bind_param("isissss", $item["id"], $item["category"], $item["type"], $item["image"], $item["question"], $item["feedback"], $temp);
    //     $stmt->execute();
    // }

    // $stmt = $con->prepare("SELECT id, image FROM questions;");
    // $stmt->execute();
    // $result = $stmt->get_result();
    // while($row = $result->fetch_assoc()) {
    //     if(!file_exists('./img/' . $row["image"])) {
    //         $stmt = $con->prepare("DELETE FROM questions WHERE id = ?;");
    //         $stmt->bind_param("i", $row["id"]);
    //         $stmt->execute();
    //     }
    // }
?>
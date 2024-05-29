<?php
    include_once './db_connect.php';

    $post_data = json_decode(file_get_contents("php://input"), true);
    $id = htmlentities($post_data["id"]);

    $_SESSION["currentAnswer"] = $id;
?>
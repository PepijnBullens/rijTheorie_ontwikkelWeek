<?php
    include_once './db_connect.php';

    if(isset($_GET["categorie"]) && isset($_GET["type"])) {
        $type = $_GET["type"];
        $category = $_GET["category"];

        $stmt = $con->prepare("SELECT");
    }
?>
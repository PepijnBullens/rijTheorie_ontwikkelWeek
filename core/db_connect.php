<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "rijtheorie_database";

    $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    define("BASEURL","http://localhost/school/periode04/rijbewijsOntwikkelWeek/git/");

    function prettyDump ( $var ) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    function resetAll() {
        unset($_SESSION["answers"]);
        unset($_SESSION["types"]);
        unset($_SESSION["typeIndex"]);
        unset($_SESSION["questions"]);
        unset($_SESSION["questionIndex"]);
    }
?>
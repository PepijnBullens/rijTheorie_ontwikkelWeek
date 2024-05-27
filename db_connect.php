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

    define("BASEURL","http://localhost/school/periode04/rijbewijsOntwikkelWeek/code/");

    function prettyDump ( $var ) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
?>
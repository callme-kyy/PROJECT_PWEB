<?php

include(__DIR__ . "/config.php");

$db = mysqli_connect($host, $user, $password, $database);

if ($db->connect_errno) {
    die("DATABASE ERROR: ". $db->connect_error);
}

?>
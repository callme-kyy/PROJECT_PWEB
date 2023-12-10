<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "mahasiswa";

$base_url = "http://localhost/Mahasiswa";

function baseUrl($path) {
    global $base_url;

    return $base_url . $path;
}

?>
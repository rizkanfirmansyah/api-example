<?php

$server = "localhost";
$database = "bookstore";
$username = "root";
$password = "";

// KONEKSI KE DATABASE
$conn = mysqli_connect($server, $username, $password, $database);
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$json = file_get_contents('php://input');
$input = json_decode($json, true);

// CEK KONEKSI
if (!$conn) {
    echo "Koneksi ke Database gagal";
    die(mysqli_connect_error());
}

function response($data, $code = 200)
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    die;
}

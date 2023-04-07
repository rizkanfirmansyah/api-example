<?php

include 'core.php';

if (!isset($uri_segments[3]) || $uri_segments[3] == null) {
    $query = mysqli_query($conn, "SELECT * FROM manga");
    $result = [];
    foreach ($query as $key => $value) {
        $result[$key] = $value;
    }
} else {
    $id = $uri_segments[3];
    $query = mysqli_query($conn, "SELECT * FROM manga WHERE id = $id");
    $result = $query->fetch_assoc();
}


$data['success'] = true;
$data['message'] = 'Data query successfully';
$data['data'] = $result;
response($data, 200);

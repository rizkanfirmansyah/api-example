<?php

include 'core.php';

if ((!isset($uri_segments[3]) || $uri_segments[3] == null)) {
    $data['success'] = false;
    $data['message'] = 'Param cannot be null';
    response($data, 403);
}

$id = $uri_segments[3];

$sql = "SELECT * from manga where id = $id";
$result_get = $conn->query($sql);
$data = $result_get->fetch_assoc();

$query = "DELETE FROM manga where id = $id";
$result = $conn->query($query);

if ($result) {

    $response['success'] = true;
    $response['message'] = 'Delete Data Success';
    $response['data'] = $data;
    response($response);
} else {
    $response['success'] = false;
    $response['message'] = 'Internal server error. ' . mysqli_error($conn);
    $response['data'] = [];
    response($response, 500);
}

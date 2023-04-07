<?php

include 'core.php';

if ((!isset($uri_segments[3]) || $uri_segments[3] == null)) {
    $data['success'] = false;
    $data['message'] = 'Param cannot be null';
    response($data, 403);
}

// var_dump($input);
// die;

if (!isset($input['title']) and !isset($input['price']) and !isset($input['pages'])) {
    $data['success'] = false;
    $data['message'] = 'Insert data failed!';
    response($data);
}
$title = $input['title'];
$pages = $input['pages'];
$price = $input['price'];
$creator = $input['creator'] ?? null;
$published = $input['published'] ?? null;
$description = $input['description'] ?? null;

$query = "UPDATE manga SET 
    title = '$title',
    price = '$price',
    pages = '$pages'

";

if ($creator !== null) {
    $query .= ", creator = '$creator'";
}
if ($published !== null) {
    $query .= ", published = '$published'";
}
if ($description !== null) {
    $query .= ", $description = '$description'";
}

$id = $uri_segments[3];
$query .= " WHERE id = $id";


$result = $conn->query($query);

if ($result) {
    $sql = "SELECT * from manga where id = $id";
    $result_get = $conn->query($sql);
    $data = $result_get->fetch_assoc();

    $response['success'] = true;
    $response['message'] = 'Update Data Success';
    $response['data'] = $data;
    response($response);
} else {
    $response['success'] = false;
    $response['message'] = 'Internal server error. ' . mysqli_error($conn);
    $response['data'] = [];
    response($response, 500);
}

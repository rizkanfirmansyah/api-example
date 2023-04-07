<?php
include 'core.php';

if (!isset($input['title']) || !isset($input['price']) || !isset($input['pages'])) {
    $data['success'] = false;
    $data['message'] = 'Insert data failed!';
    response($data, 422);
}

$title = $input['title'];
$pages = $input['pages'];
$price = $input['price'];
$creator = $input['creator'] ?? null;
$published = $input['published'] ?? date('Y-m-d');
$description = $input['description'] ?? null;

$query = "INSERT INTO manga(title, pages, price, creator, published, description) values ('$title', $pages, $price, '$creator', '$published', '$description')";

$result = $conn->query($query);


if ($result) {
    $last_id = $conn->insert_id;
    $sql_get = "SELECT * FROM manga where id = $last_id";
    $result_get = $conn->query($sql_get);

    $data = $result_get->fetch_assoc();

    $response['success'] = true;
    $response['message'] = 'Insert Data Success';
    $response['data'] = $data;
    response($response);
} else {
    $response['success'] = false;
    $response['message'] = 'internal server error. ' . mysqli_error($conn);
    $response['data'] = [];
    response($response, 500);
}

$conn->close();

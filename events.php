<?php
header('Content-Type: application/json');
include 'includes/db.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "SELECT * FROM events WHERE 1=1";

if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND title LIKE '%$search%'";
}

if (!empty($category)) {
    $category = $conn->real_escape_string($category);
    $sql .= " AND category = '$category'";
}

$result = $conn->query($sql);
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
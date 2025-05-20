<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit();
}

include '../includes/db.php';

$title = $_POST['title'] ?? '';
$date = $_POST['date'] ?? '';
$location = $_POST['location'] ?? '';
$category = $_POST['category'] ?? '';
$description = $_POST['description'] ?? '';

if ($title && $date && $location && $category && $description) {
    $stmt = $conn->prepare("INSERT INTO events (title, date, location, category, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $date, $location, $category, $description);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'DB error']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'All fields required']);
}
?>
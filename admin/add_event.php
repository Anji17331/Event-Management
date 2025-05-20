<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO events (title, date, location, category, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $date, $location, $category, $description);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Event</title>
</head>

<body>
    <h2>Add New Event</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Event Title" required><br><br>
        <input type="date" name="date" required><br><br>
        <input type="text" name="location" placeholder="Location" required><br><br>
        <input type="text" name="category" placeholder="Category" required><br><br>
        <textarea name="description" placeholder="Description" required></textarea><br><br>
        <button type="submit">Add Event</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>
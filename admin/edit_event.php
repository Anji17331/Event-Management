<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE events SET title=?, date=?, location=?, category=?, description=? WHERE id=?");
    $stmt->bind_param("sssssi", $title, $date, $location, $category, $description, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Event</title>
</head>

<body>
    <h2>Edit Event</h2>
    <form method="post">
        <input type="text" name="title" value="<?= $event['title'] ?>" required><br><br>
        <input type="date" name="date" value="<?= $event['date'] ?>" required><br><br>
        <input type="text" name="location" value="<?= $event['location'] ?>" required><br><br>
        <input type="text" name="category" value="<?= $event['category'] ?>" required><br><br>
        <textarea name="description" required><?= $event['description'] ?></textarea><br><br>
        <button type="submit">Update Event</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>

</html>
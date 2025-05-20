<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Get all events
$result = $conn->query("SELECT * FROM events ORDER BY date");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h2>Welcome, Admin</h2>
    <a href="add_event.php">Add New Event</a> |
    <a href="logout.php">Logout</a>
    <h3>All Events</h3>

    <table border="1" cellpadding="10">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['category'] ?></td>
                <td>
                    <a href="edit_event.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_event.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>
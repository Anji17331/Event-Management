<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM events WHERE id=$id");

header("Location: dashboard.php");
exit();
?>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Event (AJAX)</title>
</head>
<body>
  <h2>Add New Event</h2>
  <form id="eventForm">
    <input type="text" name="title" placeholder="Title" required><br><br>
    <input type="date" name="date" required><br><br>
    <input type="text" name="location" placeholder="Location" required><br><br>
    <input type="text" name="category" placeholder="Category" required><br><br>
    <textarea name="description" placeholder="Description" required></textarea><br><br>
    <button type="submit">Add Event</button>
  </form>

  <p id="resultMsg"></p>
  <a href="dashboard.php">← Back to Dashboard</a>

  <script>
    const form = document.getElementById('eventForm');
    const result = document.getElementById('resultMsg');

    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Stop page reload

      const formData = new FormData(form);

      fetch('add_event_ajax.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          result.innerHTML = "✅ Event added successfully!";
          form.reset();
        } else {
          result.innerHTML = "❌ Error: " + data.error;
        }
      })
      .catch(error => {
        result.innerHTML = "❌ AJAX error occurred.";
        console.error("AJAX Error:", error);
      });
    });
  </script>
</body>
</html>

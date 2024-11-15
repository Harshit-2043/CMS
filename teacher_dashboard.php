<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard</title>
  <style>
    /* Basic styling for the dashboard */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .dashboard-container {
      width: 80%;
      max-width: 600px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    button {
      background-color: #28a745;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #218838;
    }

  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>Teacher Dashboard</h2>

    <!-- Form to submit data -->
    <form action="marks.php" method="POST">
      <div class="form-group">
        <label for="studentname">Student Name:</label>
        <input type="text" id="studentname" name="studentname" placeholder="Enter student name" required>
      </div>

      <div class="form-group">
        <label for="subjectname">Subject Name:</label>
        <input type="text" id="subjectname" name="subjectname" placeholder="Enter subject name" required>
      </div>

      <div class="form-group">
        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" placeholder="Enter student grade" required>
      </div>

      <div class="form-group">
        <label for="marks">Marks:</label>
        <input type="number" id="marks" name="marks" placeholder="Enter marks" required>
      </div>

      <button type="submit">Add Entry</button>
    </form>
  </div>

</body>
</html>

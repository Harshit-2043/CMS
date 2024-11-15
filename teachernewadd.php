<?php
// Start the session to check if the admin is logged in
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection file
include_once 'config.php'; // Assuming the database connection file is named config.php

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to insert the new teacher into the teacher table (no hashing)
    $sql = "INSERT INTO teacher (name, email, password) VALUES ('$name', '$email', '$password')";

    // Execute the query and check if insertion was successful
    if (mysqli_query($conn, $sql)) {
        // Redirect to a confirmation page or show success message
        echo "Teacher added successfully!";
        // Redirect to another page (e.g., a page with the teacher list)
        header("Location: teacher_dashboard.php");  // Adjust as needed
        exit();
    } else {
        // Error inserting data
        echo "Error: " . mysqli_error($conn);
    }
}
?>

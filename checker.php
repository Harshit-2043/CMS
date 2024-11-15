<?php
// Start the session
session_start();

// Include your database connection file
include_once 'config.php';  // Assuming your database connection file is named config.php

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the student exists
    $sql = "SELECT * FROM student WHERE email = '$email' AND name = '$name'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any record is returned
    if (mysqli_num_rows($result) == 1) {
        // Fetch the record from the database
        $row = mysqli_fetch_assoc($result);

        // Compare the plain text password directly
        if ($password === $row['password']) {
            // Credentials are correct, store user data in session
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['student_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            // Redirect to the student's dashboard or home page
            echo "Congrats, you are logged in successfully!";
            // You can redirect the user to the student dashboard
            header("Location: student_dashboard.php");  // Adjust the URL as needed
            exit;
        } else {
            // Invalid password
            echo "Invalid credentials. Please try again.";
        }
    } else {
        // User not found
        echo "Invalid credentials. Please try again.";
    }
}
?>
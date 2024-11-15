<?php
// Start the session to store admin login information
session_start();

// Include your database connection file
include_once 'config.php';  // Assuming your database connection file is named config.php

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the admin exists
    $sql = "SELECT * FROM admin WHERE username = '$username'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any record is returned
    if (mysqli_num_rows($result) == 1) {
        // Fetch the record from the database
        $row = mysqli_fetch_assoc($result);

        // Compare the entered password with the stored password (assuming plain text password)
        if ($password === $row['password']) {
            // Credentials are correct, store user data in session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_username'] = $row['username'];

            // Redirect to teacheradd.php (admin dashboard or teacher adding page)
            header("Location: admin_dashboard.php");  // Adjust the URL as needed
            exit();
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // Admin not found
        echo "Invalid username. Please try again.";
    }
}
?>
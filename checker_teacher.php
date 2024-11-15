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
    $password = $_POST['password']; // No escaping for password since it's being compared directly

    // Prepare the SQL statement to check if the student exists
    $sql = "SELECT * FROM teacher WHERE email = ? AND name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, 'ss', $email, $name);  // 'ss' indicates two string parameters

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    // Check if any record is returned
    if (mysqli_num_rows($result) == 1) {
        // Fetch the record from the database
        $row = mysqli_fetch_assoc($result);

        // Compare the entered password with the stored password (no hashing)
        if ($password === $row['password']) {
            // Credentials are correct, store user data in session
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['student_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            // Redirect to the student's dashboard or home page
            header("Location: teacher_dashboard.php");  // Adjust the URL as needed
            exit;
        } else {
            // Invalid password
            echo "Invalid credentials. Please try again.";
        }
    } else {
        // User not found
        echo "Invalid credentials. Please try again.";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>

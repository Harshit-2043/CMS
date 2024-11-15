<?php
// Start the session
session_start();

// Include your database connection file
include_once 'config.php';  // Ensure you have a database connection file for the connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the email already exists in the database
    $sql_check = "SELECT * FROM student WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Email already exists
        echo "This email is already registered. Please use a different email.";
    } else {
        // Insert the new student's data into the database
        $sql_insert = "INSERT INTO student (name, email, password) VALUES ('$name', '$email', '$password')";
        
        if (mysqli_query($conn, $sql_insert)) {
            // Data inserted successfully, redirect to a success page or student dashboard
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = 'student';  // Set the role as student
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            // Redirect to the student dashboard or any page after successful registration
            header("Location: student_dashboard.php");
            exit();
        } else {
            // Error in inserting data
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

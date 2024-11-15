<?php
// Include database connection file
include_once 'config.php';  // Ensure this file contains your database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and get the form data
    $studentname = mysqli_real_escape_string($conn, $_POST['studentname']);
    $subjectname = mysqli_real_escape_string($conn, $_POST['subjectname']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);

    // Query to insert the data into the 'test' table
    $sql = "INSERT INTO test (name, subjectname, grade, marks) 
            VALUES ('$studentname', '$subjectname', '$grade', '$marks')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Entry added successfully!";
        // Optionally, redirect after successful insertion
        header("Location: teacher_dashboard.html"); // Redirect back to dashboard or another page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // If there's an error, output it
    }
}
?>

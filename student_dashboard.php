<?php
// Start the session to access session variables
session_start();

// Assuming a session variable 'name' holds the student's name
if (!isset($_SESSION['name'])) {
    echo "Student name is not set.";
    exit;
}

$studentName = $_SESSION['name'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the syllabus and marks for the student
$sql = "SELECT subject, marks, grade FROM test WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentName);
$stmt->execute();
$result = $stmt->get_result();

$marksData = [];
$totalMarks = 0;
$totalSubjects = 0;

// Loop through the result to fetch marks and grades
while ($row = $result->fetch_assoc()) {
    $marksData[] = $row;
    $totalMarks += $row['marks'];
    $totalSubjects++;
}

$stmt->close();

// Calculate CGPA (assuming it's out of 10)
$cgpa = $totalMarks / $totalSubjects / 10;

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS if necessary -->
</head>
<body>

    <!-- Syllabus Section -->
    <section class="info-section">
        <h2>Syllabus</h2>
        <ul id="syllabusList">
            <!-- Assuming syllabus items are predefined and dynamic ones are added here -->
            <li>Math 101</li>
            <li>Physics 101</li>
            <!-- Add more syllabus items as required -->
        </ul>
    </section>

    <!-- Marks Section -->
    <section class="info-section">
        <h2>Marks</h2>
        <table id="marksTable">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody id="marksTableBody">
                <?php
                if (count($marksData) > 0) {
                    foreach ($marksData as $mark) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($mark['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($mark['marks']) . "</td>";
                        echo "<td>" . htmlspecialchars($mark['grade']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No data found for the student.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- CGPA Section -->
    <section class="info-section">
        <h2>CGPA</h2>
        <p id="cgpaValue">CGPA: <span id="cgpaDisplay"><?php echo number_format($cgpa, 2); ?></span></p>
    </section>

</body>
</html>

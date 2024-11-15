

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../content/css/style.css">
</head>
<body>
<div class="signup-container">
        <h2>Teacher Login</h2>
        <form id="signupForm" action="checker_teacher.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <a href="admin.php" >Add new teacher</a>
           
            <button type="submit" style="margin-top:20px;">Login</button>
     
        </form>
    </div>
</body>
</html>


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
        <h2>Admin Login</h2>
        <form id="signupForm" action="admincheck.php" method="POST">
         

            <label for="email">username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">password:</label>
            <input type="password" id="password" name="password" required>

          

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
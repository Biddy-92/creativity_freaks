<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php"); // Redirect to dashboard after successful login
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "No user found with this email!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Creativity Freaks Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Forgot your password? <a href="forgot-password.php">Click here</a></p>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </main>

    <footer>
        <p>&copy; 2025 Creativity Freaks. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
<?php include('footer.php'); ?>


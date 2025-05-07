<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Send email with password reset link (simplified for now)
        echo "Password reset link has been sent to your email.";
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
        <a href="index.php"> <img src="logo.png" alt="Creativity Freaks Logo" height="30"> </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Forgot Password</h2>
        <form action="forgot-password.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Reset Password</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Creativity Freaks. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
<?php include('footer.php'); ?>

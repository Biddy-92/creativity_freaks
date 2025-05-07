<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // If user is not logged in, redirect to login page
    exit();
}

include('db.php');
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
        <a href="index.php"> <img src="logo.png" alt="Creativity Freaks Logo" height="30"> </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Welcome, <?php echo $user['username']; ?>!</h1>
        <p>Explore courses, update your profile, or logout.</p>
        <div class="dashboard-options">
            <a href="courses.php">Browse Courses</a>
            <a href="profile.php">Edit Profile</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Creativity Freaks. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
<?php include('footer.php'); ?>

<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creativity Freaks - E-learning Platform</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header class=" bg-gray text-black">
        <div class="container-fluid py-0.8">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <div class="logo" style="display: flex; align-items: center;" >
                    <a href="index.php"> <img src="logo.png" alt="Creativity Freaks Logo" height="30"> </a>
                </div>

                <!-- Navigation Menu -->
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-black" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="courses.php">Courses</a></li>

                        <li class="nav-item"><a class="nav-link text-black" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="contact.php">Contact</a></li>
                        <!-- Search Form -->
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" >
                    <button class="btn btn-primary" type="button">Search</button>
                </form>

                <?php
                if (isset($_SESSION['user_id'])) {
                    // If user is logged in, show the profile icon
                    echo '<li class="dropdown">
                            <img src="user-icon.png" alt="User Profile" class="user-icon" id="profileDropdown" onclick="toggleDropdown()">
                            <div class="dropdown-menu" id="dropdownMenu">
                                <a href="profile.php">Edit Profile</a>
                                <a href="change-password.php">Change Password</a>
                                <a href="logout.php">Sign Out</a>
                            </div>
                          </li>';
                } else {
                    // If not logged in, show "Login" and "Get Started"
                    echo '<li><a href="login.php">Login</a></li>';
                    echo '<li><a href="register.php">Get Started</a></li>';
                }
                ?>
                    </ul>
                </nav>

               
            </div>
        </div>
    </header>

    <main>
        <div class="hero text-center py-5">
            <h1>Welcome to Creativity Freaks!</h1>
            <p>Your journey into the world of creative learning starts here. Join us today to explore courses and more!</p>
            <?php
            if (!isset($_SESSION['user_id'])) {
                echo '<a href="register.php" class="get-started-btn btn btn-success">Get Started</a>';
            }
            ?>
        </div>
    </main>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('footer.php'); ?>

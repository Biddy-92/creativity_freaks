<?php
session_start();
include('db.php');

// If not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Handle profile picture upload
    if ($_FILES['profile_picture']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_picture = $target_file;
    } else {
        $profile_picture = $user['profile_picture'];
    }

    $update_query = "UPDATE users SET username='$username', email='$email', profile_picture='$profile_picture' WHERE id='$user_id'";
    if ($conn->query($update_query) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
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
                        
                        </ul>
                </nav>
            </div>
        </div>

    </header>

    <main>
        <div class="profile-container">
            <div class="profile-header">
                <!-- Profile Picture Section -->
                <div class="profile-picture">
                    <img src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : 'default-avatar.png'; ?>" alt="Profile Picture">
                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <label for="profile_picture" class="upload-button">Change Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" style="display:none;">
                    </form>
                </div>

                <!-- Profile Info Section -->
                <div class="profile-info">
                    <h2><?php echo $user['username']; ?></h2>
                    <p>Email: <?php echo $user['email']; ?></p>
                    <p>About Me: <?php echo $user['about_me'] ? $user['about_me'] : 'Please update your profile details.'; ?></p>
                    <a href="edit-details.php" class="edit-button">Edit Details</a>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="edit-form">
                <h3>Edit Profile</h3>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div>
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture">
                </div>
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </main>

</body>
</html>
<?php include('footer.php'); ?>
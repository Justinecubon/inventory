<?php
// Include your database connection file
include('config.php');

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user input
$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];

// Update user data in the database
$query = "UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id";

if (mysqli_query($conn, $query)) {
    header("location: profile.php");
?>
<button onclick="document.location='profile.php'">Procced</button>
<?php
} else {
    echo "Error updating profile: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

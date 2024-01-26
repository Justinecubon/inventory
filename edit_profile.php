<?php
 include('config.php');
 session_start();

 if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Error fetching user data: " . mysqli_error($conn));
}
?>
<style>
    body{
        padding: 10% 30% 10% 30%;
        color: white;
    }
    form{
        padding: 10%;
        border: 1px black solid;
        border-radius: 10px;
        align-items: center;
        background-color: blue;

    }
    h2{
        text-align: center;
    }
    input{
        width: 100%;
    }
    button{
        margin-top: 5%;
        padding: 5px;
        width: 50%;
        border-radius: 5px;
    }
</style>
<form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
     <button type="submit" value="Update Profile">Update Profile</button>
    </form>   
   
        <button style="float: right; margin-top: 0;" onclick="document.location='profile.php'">Cancel</button>

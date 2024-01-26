<?php
session_start();
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            header("location: login.php?error=Incorrect Password!");
        }
    } else {
        echo "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
        background-color: grey;

    }
    h2{
        text-align: center;
    }
    input{
        width: 100%;
    }
    .button{
        margin-top: 5%;
        padding: 5px;
        width: 100%;
        border-radius: 5px;
    }
</style>
<body>

<form method="post" action="">
    <h2>Login</h2>
    <?php 
           if (isset($_GET['error'])){ ?>
           <p class="error"><?php echo $_GET['error'];
           ?></p>
           <?php } ?>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input class="button" type="submit" value="Login">
    <a href="register.php">Register</a>
</form>

</body>
</html>
<?php
include 'footer.php';
?>

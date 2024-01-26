<?php
ob_start(); // Enable output buffering
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    $conn->query($sql);
    header("Location: login.php");
    exit();
}
?>

<style>
    body{
        padding: 10% 30% 10% 30%;
    }
    form{
        margin: 5% 30% 10% 30%;
        padding: 2% 5% 5% 5%;
        border: 1px black solid;
        border-radius: 10px;
        align-items: center;
        background-color: grey;
        color: white;

    }
    h2{
        padding-top: 0;
        text-align: center;
    }
    input{
        margin-top: 3%;
        width: 100%;
    }
    .button{
        margin-top: 5%;
        padding: 5px;
        width: 100%;
        border-radius: 5px;
    }

</style>


<form method="post" action="">
    <h2>Register</h2>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Email: <input type="email" name="email" required><br>
    <input class="button" type="submit" value="Register">
    <a href="login.php">Login</a>
</form>

<?php
include 'footer.php';
ob_flush(); // Flush the buffer
?>
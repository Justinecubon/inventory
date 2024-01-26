<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id='$id'";
    $conn->query($sql);
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id='$id'");
$product = $result->fetch_assoc();
?>
<style>
    form{
        margin: 5% 30% 1% 30%;
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
    button{
        margin: 0 30% 0 0;
        padding: 5px;
        width: 10%;
        border-radius: 5px;
    }
    textarea{
        width: 100%
    }
</style>

<form method="post" action="">
    <h2>Edit Product</h2>
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    Name: <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
    Description: <textarea name="description"><?= $product['description'] ?></textarea><br>
    Price: <input type="text" name="price" value="<?= $product['price'] ?>" required><br>
    <input type="submit" value="Update Product">
</form>
<button style="float: right; margin-top: 0;" onclick="document.location='dashboard.php'">Cancel</button>

<?php
include 'footer.php';

<?php
session_start();
include 'config.php';
include 'header.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
  <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
    <style>
        .title{
            display: block;
            float: left;
            width: 100%;
            background-color: grey;
            color: white;
        }
        ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: right;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
h1{
    margin-left: 3%;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: grey;
}

.product{
    padding-top: 3%;
}
table{
    width: 93%;
    margin: 3%;
    text-align: center;
}
h2{
    margin: 2% 0 3% 2%;
    color: black;
    font-size: 50px;
    text-align: center;
    
}
.add{
  background-color: grey;
  border: none;
  color: white;
  padding: 15px 32px;
  margin: 2%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.delete{
    background-color: red;
  border: none;
  color: white;
  padding: 15px 32px;
  margin: 2%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
.edit{
    background-color: blue;
  border: none;
  color: white;
  padding: 15px 32px;
  margin: 2%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
h4{
    text-align: center;
}
p{
    margin: 0;
}
.result{
    border: 2px black solid;
    width: 93%;
    text-align: center;
    padding: 2%;
    width: 80%;
}
.pagination a{
    float: right;
    margin-right: 20%;
}
    </style>
<div class="title">
    
<h1>Welcome, <?php echo $user['username']; ?>!</h1>
<ul>
    <li><?php
if (isset($_SESSION['user_id'])) {
    echo '<a onclick="if(confirmLogout()) window.location.href=\'logout.php\';">Logout</a>';
} else {
    header("Location: login.php");
    exit();
}?></li>
 <li><a href="profile.php">View Profile</a></li>
 <form style="margin: 10px;" action="search.php" method="GET">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" required>
        <button type="submit">Search</button>
    </form>
</ul>
</div>


<?php
$result = $conn->query("SELECT * FROM products");
?>
  <?php
// Assuming you have a database connection established
$pdo = new PDO("mysql:host=localhost;dbname=id21821108_inventory", "id21821108_root", "AssetMember_23");

// Pagination settings
$results_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $results_per_page;

// Perform a query to get total results
$total_query = "SELECT COUNT(*) as total FROM products";
$total_stmt = $pdo->query($total_query);
$total_results = $total_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Perform a query to get paginated results
$query = "SELECT * FROM products LIMIT :offset, :results_per_page";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':results_per_page', $results_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display results?>
<div class="product">
    <h2>Product List</h2>
<a class="add" href="add_product.php">Add Product</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td> ₱ <?= $row['price'] ?></td>
            <td>
                <a class="edit" href="edit_product.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="delete" href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>

            </td>
        </tr>
    <?php endwhile; ?>
        </table>
        <?php
            // Pagination links
           $num_pages = ceil($total_results / $results_per_page);
            echo "<div class='pagination'>";
            for ($page = 1; $page <= $num_pages; $page++) {
                echo "<a href='?page=$page'>$page</a>";
            }
            ?>

</div>


<?php
include 'footer.php';

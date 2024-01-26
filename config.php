<?php
ob_start(); // Enable output buffering


$host = "localhost";
$username = "id21821108_root";
$password = "AssetMember_23";
$database = "id21821108_inventory";

$conn = new mysqli($host, $username,$password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
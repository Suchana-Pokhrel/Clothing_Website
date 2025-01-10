<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli('localhost', 'root', '', 'ecommerce');

if ($conn == isset($connect_error)) {
  die("Connection failed: " . $conn == $connect_error);
}

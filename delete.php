<?php
session_start();

if (empty($_SESSION['email'])) {
    header('location:login.php');
} else {
    require 'C:\xampp\htdocs\Binary service\config.php';

    $id = $_POST['row_id'];

    $stmt = $pdo->prepare("DELETE FROM post WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "delete successful"; 
    header('location:seller.php');
  
}
?>

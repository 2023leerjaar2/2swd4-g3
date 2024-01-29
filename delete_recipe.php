<?php
include 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user'] !== 'admin' && $_SESSION['user'] !== 'chef') {
    header('Location: index.php'); 
    exit();
}

if (!isset($_POST['recipe_id'])) {
    header('Location: index.php'); 
    exit();
}

$recipeId = $_POST['recipe_id'];

$query = "DELETE FROM recepten WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$stmt->close();

header('Location: recepten.php');
exit();
?>

<?php
include 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user'] !== 'admin' && $_SESSION['user'] !== 'chef') {
    header('Location: index.php'); // Redirect to homepage if not admin or chef
    exit();
}

if (!isset($_GET['recipe_id'])) {
    header('Location: recepten.php'); 
    exit();
}

$recipeId = $_GET['recipe_id'];

$query = "SELECT * FROM recepten WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if (!$row) {
    header('Location: recepten.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = $_POST['titel'];
    $tekst = $_POST['tekst'];
    $recept = $_POST['recept'];
    $foto = $_POST['foto'];

    $updateQuery = "UPDATE recepten SET titel = ?, tekst = ?, recept = ?, foto = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssssi", $titel, $tekst, $recept, $foto, $recipeId);
    $updateStmt->execute();
    $updateStmt->close();

    header('Location: recepten.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recept Bewerken</title>
</head>
<body>
    <div class="content">
        <h2>Recept Bewerken</h2>
        <br>
        <form method="post">
            <label for="titel">Titel:</label>
            <input type="text" name="titel" value="<?php echo $row['titel']; ?>" required>

            <label for="tekst">Tekst:</label>
            <textarea class="tekst" name="tekst" required><?php echo $row['tekst']; ?></textarea>

            <label for="recept">Recept:</label>
            <textarea id="recept" name="recept" required><?php echo $row['recept']; ?></textarea>

            <label for="foto">Foto URL:</label>
            <input type="text" name="foto" value="<?php echo $row['foto']; ?>">

            <button class="button" type="submit">Opslaan</button>
        </form>
    </div>
    <footer>
        <p><?php 
            if (!empty($_SESSION['user'])) {
                echo "Ingelogd als: {$_SESSION['user']}";
            } else {
                echo "Niet ingelogd";
            }
            ?> </p>
        <div class="social-icons">
            <a href="#"><img src="img/facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="img/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="img/instagram-icon.png" alt="Instagram"></a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Kamadoing. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
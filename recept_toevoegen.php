<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user']) || ($_SESSION['user'] != 'chef' && $_SESSION['user'] != 'admin')) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = $_POST['titel'];
    $tekst = $_POST['tekst'];
    $recept = $_POST['recept'];
    $foto = $_POST['foto'];

    $stmt = $conn->prepare("INSERT INTO recepten (titel, tekst, recept, foto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $titel, $tekst, $recept, $foto);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recept Toevoegen</title>
</head>
<body>
    <header>
        <h1>BBQ Recepten</h1>
        <span>Welkom, <?php echo $_SESSION['user']; ?>! <a href="logout.php">Uitloggen</a></span>
    </header>

    <div class="content">
        <h2>Recept Toevoegen</h2>
        <form method="post">
            <label for="titel">Titel:</label>
            <input type="text" name="titel" required>

            <label for="tekst">Tekst:</label>
            <textarea name="tekst" required></textarea>

            <label for="recept">Recept:</label>
            <textarea name="recept" required></textarea>

            <label for="foto">Foto (URL):</label>
            <input type="text" name="foto" required>

            <button type="submit">Toevoegen</button>
        </form>
    </div>

    <?php
    // Hier kun je de footer toevoegen
    ?>
</body>
</html>
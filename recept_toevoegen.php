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
        
        <nav>
        <a class="logolink" href="index.php">
                <img class="logo" src="https://cdn.discordapp.com/attachments/581190740479311893/1198765338460962836/Asset_2.png?ex=65c01838&is=65ada338&hm=b3b142e452fc2c2b58df27d2a781bf6303e7911b8abaa6c58603a73084cbd125&" alt="">
            </a>            <div>
            <a href="index.php">Home</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="recept_toevoegen.php">Recept Toevoegen</a>';
                echo '<a href="logout.php">Uitloggen</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
            <a href="recepten.php">Recepten</a>
            <a href="boeken.php">Boeken</a>
            <a href="contact.php">Contact</a>
            </div>
        </nav>
    </header>

    <div class="content">
        <h2>Recept Toevoegen</h2>
        <br>
        <form method="post">
            <label for="titel">Titel:</label>
            <input type="text" name="titel" required>

            <label for="tekst">Tekst:</label>
            <textarea class="tekst" name="tekst" required></textarea>

            <label for="recept">Recept:</label>
            <textarea id="recept" name="recept" required></textarea>

            <label for="foto">Foto (URL):</label>
            <input type="text" name="foto" required>
            <br>

            <button class="button" type="submit">Toevoegen</button>
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
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="img/facebook-icon.png" alt="Facebook"></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="img/twitter-icon.png" alt="Twitter"></a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="img/instagram-icon.png" alt="Instagram"></a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Kamadoing. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
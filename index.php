<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>BBQ Recepten</title>
</head>
<body>
    <header>
        <h1>BBQ Recepten</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="recept_toevoegen.php">Recept Toevoegen</a>';
                echo '<a href="logout.php">Uitloggen</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <div class="content">
        <!-- Inhoud van de homepage -->
    </div>

    <footer>
        <p>Ingelogd als: <?php echo $_SESSION['user']; ?></p>
        <div class="social-icons">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Kamadoing. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>

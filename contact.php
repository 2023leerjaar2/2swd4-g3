<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact</title>
</head>
<body>
    <header>
        <h1>Kamadoing</h1>
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
        <h2>Contact</h2>
        <p>Heb je vragen, opmerkingen of feedback? Neem gerust contact met ons op.</p>
        <!-- Voeg hier het contactformulier of verdere inhoud toe -->
    </div>

    <?php
    // Hier kun je de footer toevoegen
    ?>
</body>
</html>
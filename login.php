<?php

include 'config.php';

// Controleer of de gebruiker al is ingelogd, stuur deze dan door naar de homepagina
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ? AND wachtwoord = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<header>
        
        <nav>
            <img class="logo" src="https://cdn.discordapp.com/attachments/581190740479311893/1198765338460962836/Asset_2.png?ex=65c01838&is=65ada338&hm=b3b142e452fc2c2b58df27d2a781bf6303e7911b8abaa6c58603a73084cbd125&" alt="">
            <div>
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
            </div>
        </nav>
    </header>
    <div class="login-container">
        <h2>Login</h2>
        <br>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="post">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" required>

            <button class="button" type="submit">Login</button>
            <br>
        </form>

        <!-- Terugknop naar de homepage -->
        <a href="index.php" class="back-link">Terug naar de homepage</a>

        <!-- Nieuwe knop voor het aanmaken van een account -->
        <a href="registratie.php" class="create-account-link">Account aanmaken</a>
    </div>
</body>
</html>

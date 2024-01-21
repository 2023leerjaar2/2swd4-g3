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
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="post">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <!-- Terugknop naar de homepage -->
        <a href="index.php" class="back-link">Terug naar de homepage</a>

        <!-- Nieuwe knop voor het aanmaken van een account -->
        <a href="registratie.php" class="create-account-link">Account aanmaken</a>
    </div>
</body>
</html>

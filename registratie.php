<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['new-username'];
    $newPassword = $_POST['new-password'];

    $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)");
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Wachtwoord hashen voordat het wordt opgeslagen
    $stmt->bind_param("ss", $newUsername, $hashedPassword);
    $stmt->execute();
    $stmt->close();

    // Voeg hier eventueel verdere logica toe, zoals het doorsturen naar de inlogpagina
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Account Aanmaken</title>
</head>
<body>
    <div class="login-container">
        <h2>Account Aanmaken</h2>
        <form method="post">
            <label for="new-username">Nieuwe Gebruikersnaam:</label>
            <input type="text" name="new-username" required>

            <label for="new-password">Nieuw Wachtwoord:</label>
            <input type="password" name="new-password" required>

            <button type="submit">Account Aanmaken</button>
        </form>

        <!-- Terugknop naar de homepage -->
        <a href="index.php" class="back-link">Terug naar de homepage</a>
    </div>
</body>
</html>
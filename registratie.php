<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['wachtwoord'])) {
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $result['role'];

        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<?php
if (isset($_SESSION['user'])) {
    $allowedRoles = ['admin', 'chef'];
   
    if (in_array($_SESSION['role'], $allowedRoles)) {
        echo '<a href="recept_toevoegen.php">Recept Toevoegen</a>';
    }
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
    <div class="login-container">
        <h2>Account Aanmaken</h2>
        <?php if (isset($feedback)) echo "<p>$feedback</p>"; ?>
        <form method="post">
            <label for="new-username">Nieuwe Gebruikersnaam:</label>
            <input type="text" name="new-username" required>

            <label for="new-password">Nieuw Wachtwoord:</label>
            <input type="password" name="new-password" required>

            <button class="button" type="submit">Account Aanmaken</button>
        </form>

        <a href="index.php" class="back-link">Terug naar de homepage</a>
    </div>
</body>
</html>

<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['wachtwoord'])) {
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $result['role']; // Assuming 'role' is the column storing user roles

        // Redirect to the home page
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!-- Rest of your HTML code -->

<?php
// Role-based access control example
if (isset($_SESSION['user'])) {
    $allowedRoles = ['admin', 'chef'];
    
    // Check if the logged-in user has the right role
    if (in_array($_SESSION['role'], $allowedRoles)) {
        // User has the right role, grant access to special features
        // For example: display a link to add recipes
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
    <div class="login-container">
        <h2>Account Aanmaken</h2>
        <?php if (isset($feedback)) echo "<p>$feedback</p>"; ?>
        <form method="post">
            <label for="new-username">Nieuwe Gebruikersnaam:</label>
            <input type="text" name="new-username" required>

            <label for="new-password">Nieuw Wachtwoord:</label>
            <input type="password" name="new-password" required>

            <button type="submit">Account Aanmaken</button>
        </form>

        <a href="index.php" class="back-link">Terug naar de homepage</a>
    </div>
</body>
</html>

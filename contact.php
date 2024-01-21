<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "barbeque_ala";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $bericht = $_POST['bericht'];

    $sql = "INSERT INTO berichten (naam, email, bericht) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $naam, $email, $bericht);

    if ($stmt->execute()) {
        echo '<div style="width: 50vw; margin-top: 5vh; margin-right: auto; margin-left: auto; text-align: center; padding: 20px; background-color: #4CAF50; color: #fff; border-radius: 50px; ">Bericht succesvol verzonden! Je wordt na 3 seconden teruggestuurd naar het contactformulier.</div>';
        header("refresh:3;url=contact.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {

?>
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

        <form action="contact.php" method="post">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="bericht">Bericht:</label>
            <textarea id="bericht" name="bericht" required></textarea>

            <input type="submit" value="Verstuur">
        </form>
    </div>

    <?php
    
    ?>
</body>
</html>
<?php
}
?>

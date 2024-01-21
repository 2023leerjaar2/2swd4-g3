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

    <div class="content">
        <?php
        // Query om alle recepten op te halen
        $query = "SELECT * FROM recepten";
        $result = mysqli_query($conn, $query);

        // Controleer of er resultaten zijn
        if (mysqli_num_rows($result) > 0) {
            // Loop door de resultaten en toon ze op de pagina
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="recept">';
                echo '<h2>' . $row['titel'] . '</h2>';
                echo '<p>' . $row['tekst'] . '</p>';
                echo '<p>' . $row['recept'] . '</p>';
                // Controleer of er een foto is en toon deze indien beschikbaar
                if (!empty($row['foto'])) {
                    echo '<img src="' . $row['foto'] . '" alt="Receptfoto">';
                }
                echo '</div>';
            }
        } else {
            echo '<p>Geen recepten gevonden.</p>';
        }

        // Sluit de databaseverbinding
        mysqli_close($conn);
        ?>
    </div>

    <?php
    // Hier kun je de footer toevoegen
    ?>
    <?php
    // Voeg dit toe boven de header tag in index.php
    echo "Gebruikersnaam in de sessie: " . $_SESSION['user'];

    // Rest van de code
    ?>
</body>
</html>

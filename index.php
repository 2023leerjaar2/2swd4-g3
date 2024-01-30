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
    <div class="paginatitel">
            <p>
                Onze Uitgelichte Recepten
            </p>
    </div>
    <div class="content" id="content1">
        <?php
        $query = "SELECT * FROM recepten LIMIT 2";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="recept">';
                echo '<h2>' . $row['titel'] . '</h2>';
                echo '<p>', 'Bereiding', '<br><br>' . $row['tekst'] . '</p>';
                
                if (!empty($row['foto'])) {
                    echo '<img src="' . $row['foto'] . '" alt="Receptfoto">';
                }
                echo '<p>', 'ingredïenten', '<br><br>' . $row['recept'] . '</p>';
                
                echo '</div>';
            }
        } else {
            echo '<p>Geen recepten gevonden.</p>';
        }

        mysqli_close($conn);
        ?>
    </div>
    
<div class="chef-info">
    <div class="chef-image">
        <img src="img/boukhiour.jpg" alt="Mohammed Boukiour">
    </div>
    <div class="chef-details">
        <h3>Mohammed Boukiour</h3>
        <p>Maak kennis met onze gepassioneerde barbecuespecialist, 
            Mohammed Boukiour. Met zijn jarenlange ervaring en 
            toewijding aan de kunst van het grillen, brengt Mohammed 
            niet alleen smaak naar de barbecue, maar ook een verhaal.</p>
        <p>Op 40-jarige leeftijd is Mohammed gevestigd in het bruisende 
            Amsterdam, Nederland. Zijn liefde voor barbecuen gaat verder 
            dan alleen de grill - het is een manier van leven.</p>
        <p>Naast het creëren van smaakvolle gerechten, geniet Mohammed 
            van tuinieren en reizen. Deze veelzijdige chef deelt niet 
            alleen recepten, maar ook zijn enthousiasme voor het 
            buitenleven en de wereldkeuken.</p>
        <p>Ontdek de geheimen van zijn smaakvolle gerechten en laat 
            je inspireren door de verhalen achter zijn kookavonturen. 
            Mohammed's kookboeken bieden een uitnodiging om je eigen 
            culinaire reis te beginnen.</p>
        <a href="boeken.php" class="button">Bekijk de kookboeken</a>
    </div>
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

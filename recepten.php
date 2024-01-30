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
                Al Onze Recepten
            </p>
    </div>
    <div class="content" id="content2">
        <?php
        $query = "SELECT * FROM recepten";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="recept3">';
                echo '<h2>' . $row['titel'] . '</h2>';
                echo '<p>', 'Bereiding', '<br><br>' . $row['tekst'] . '</p>';
                
                if (!empty($row['foto'])) {
                    echo '<img src="' . $row['foto'] . '" alt="Receptfoto">';
                }
                echo '<p>', 'ingredïenten', '<br><br>' . $row['recept'] . '</p>';
                
            if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'chef')) {
                    echo '<form method="post" action="delete_recipe.php">'; 
                    echo '<input type="hidden" name="recipe_id" value="' . $row['id'] . '">';
                    echo '<button class="button" id="knop33" type="submit">Verwijder</button> ';
                    echo '</form>';
                }
                if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'chef')) {
                    echo '<form method="get" action="wijzigen.php">';
                    echo '<input type="hidden" name="recipe_id" value="' . $row['id'] . '">';
                    echo '<button class="button" type="submit">Bewerken</button>';
                    echo '</form>';
                }
                
                echo '</div>';
            }
        } else {
            echo '<p>Geen recepten gevonden.</p>';
        }

        mysqli_close($conn);
        ?>
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
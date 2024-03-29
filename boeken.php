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
            </a>
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
            <a href="recepten.php">Recepten</a>
            <a href="boeken.php">Boeken</a>
            <a href="contact.php">Contact</a>
            </div>
        </nav>
    </header>
<section class="content">
<h1>Boekenwinkel</h1>
<br>
<div id="book-list">
    <div class="book" onclick="addToCart('Boek 1', 10)"><img width="100%" src="https://media.s-bol.com/mBDn0DgV6PO/550x692.jpg" alt="">Boek 1 - €10</div>
    <div class="book" onclick="addToCart('Boek 2', 15)"><img width="100%" src="https://164.wpcdnnode.com/greeneggtotaal.nl/wp-content/uploads/2021/01/vega-bbq-kopie-500x500.jpg" alt="">Boek 2 - €15</div>
    <div class="book" onclick="addToCart('Boek 3', 20)"><img width="100%" src="https://bbq-helden.nl/wp-content/uploads/black-smoke-2.jpg" alt="">Boek 3 - €20</div>
</div>

<div id="cart">
    <h2>Winkelmandje</h2>
    <ul id="cart-items"></ul>
    <p id="total">Totaal: €0</p>
    <button class="button   " onclick="checkout()">Afrekenen</button>
</div>

<script>
    let cartItems = [];
    
    function addToCart(title, price) {
        cartItems.push({ title, price });
        updateCart();
    }

    function removeFromCart(index) {
        cartItems.splice(index, 1);
        updateCart();
    }

    function updateCart() {
        const cartList = document.getElementById("cart-items");
        const totalElement = document.getElementById("total");
        let total = 0;

        cartList.innerHTML = "";
        cartItems.forEach((item, index) => {
            const li = document.createElement("li");
            li.textContent = `${item.title} - €${item.price}  `;
        
            const removeButton = document.createElement("button");
            removeButton.textContent = "Verwijderen";
            removeButton.classList.add("button");
            removeButton.onclick = () => removeFromCart(index);
            document.body.appendChild(removeButton);
            document.body.appendChild(document.createElement("br","br","br"));

            li.appendChild(removeButton);
            cartList.appendChild(li);

            total += parseFloat(item.price);
        });

        totalElement.textContent = `Totaal: €${total.toFixed(2)}`;
    }

    function checkout() {
        alert("Bedankt voor uw aankoop!");
        cartItems = [];
        updateCart();
    }
</script>
</section>
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

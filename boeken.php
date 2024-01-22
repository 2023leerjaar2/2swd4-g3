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
<section class="content">
<h1>Boekenwinkel</h1>
<br>
<div id="book-list">
    <div class="book" onclick="addToCart('Boek 1', 10)"><img width="100%" src="https://media.s-bol.com/BlX5pP66z8k/550x699.jpg" alt="">Boek 1 - €10</div>
    <div class="book" onclick="addToCart('Boek 2', 15)"><img width="100%" src="https://media.s-bol.com/xkkkrvz7oyE3/550x782.jpg" alt="">Boek 2 - €15</div>
    <div class="book" onclick="addToCart('Boek 3', 20)"><img width="100%" src="https://www.boekenvoordeel.be/media/catalog/product/cache/3/image/400x518.58974358974/9df78eab33525d08d6e5fb8d27136e95/4/6/463264_1.png" alt="">Boek 3 - €20</div>
</div>

<div id="cart">
    <h2>Winkelmandje</h2>
    <ul id="cart-items"></ul>
    <p id="total">Totaal: €0</p>
    <button onclick="checkout()">Afrekenen</button>
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
            li.textContent = `${item.title} - €${item.price}`;
            const removeButton = document.createElement("button");
            removeButton.textContent = "Verwijderen";
            removeButton.onclick = () => removeFromCart(index);
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
        <p>Ingelogd als: <?php echo $_SESSION['user']; ?></p>
        <div class="social-icons">
            <a href="#"><img class="icon" src="img/facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img class="icon" src="img/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img class="icon" src="img/instagram-icon.png" alt="Instagram"></a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Kamadoing. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>

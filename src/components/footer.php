<?php
function compHeader($title) { ?>
<header class="header-flex">
    <div class="inline">
        <img class="logo" src="./assets/logo.png">
        <h1>Buchlager</h1>
    </div>
    <ul>
        <li>
            <a href="./index.php">Home</a>
        </li>
        <li>
            <a href="./buecher.php">Buecher</a>
        </li>
        <li>
            <a href="./autoren.php">Autoren</a>
        </li>
        <li>
            <a href="./verlage.php">Verlage</a>
        </li>
        <li>
            <a href="./sparten.php">Sparten</a>
        </li>
        <li>
            <a href="./lieferanten.php">Lieferanten</a>
        </li>
        <li>
            <a href="./orte.php">Orte</a>
        </li>
    </ul>
</header>
<?php
}
?>
<?php

function selected() {
    return 'class="selected"';
}

function compHeader($selected) { ?>
<header class="header-flex">
    <div class="inline">
        <img class="logo" src="./assets/logo.png">
        <h1>Buchlager</h1>
    </div>
    <div class="inline">
        <form action="index.php" method="POST" class="inline statement-form">
            <label for="statement">SELECT Statement: </label>
            <input type="text" name="statement" value="SELECT ">
            <button type="submit">Anzeigen</button>
        </form>
        <ul>
            <li>
                <a href="./index.php?data=Buecher" <?php if ($selected == "Buecher") {echo selected(); } ?>>Buecher</a>
            </li>
            <li>
                <a href="./index.php?data=Autoren" <?php if ($selected == "Autoren") {echo selected(); } ?>>Autoren</a>
            </li>
            <li>
                <a href="./index.php?data=Verlage" <?php if ($selected == "Verlage") {echo selected(); } ?>>Verlage</a>
            </li>
            <li>
                <a href="./index.php?data=Sparten" <?php if ($selected == "Sparten") {echo selected(); } ?>>Sparten</a>
            </li>
            <li>
                <a href="./index.php?data=Lieferanten" <?php if ($selected == "Lieferanten") {echo selected(); } ?>>Lieferanten</a>
            </li>
            <li>
                <a href="./index.php?data=Orte" <?php if ($selected == "Orte") {echo selected(); } ?>>Orte</a>
            </li>
        </ul>
    </div>
</header>
<?php
}
?>
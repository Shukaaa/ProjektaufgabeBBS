<?php
require_once("./components/head.php");
require_once("./components/header.php");

require("./utils/BuchladenService.php");
$service = new BuchladenService();
$autoren = $service->get("autoren");
$keys = array_keys($autoren[0]);
?>
<!DOCTYPE html>
<html lang="en">
<?php compHead("Autoren") ?>
<body>
    <?php compHeader("Autoren") ?>
    <main>
        <table>
            <tr>
                <?php foreach ($keys as $key) {
                    echo "<th>$key</th>";
                } ?>
            </tr>
            <?php foreach ($autoren as $autor) {
                echo "<tr>";
                foreach ($keys as $key) {
                    echo "<td>$autor[$key]</td>";
                }
                echo "</tr>";
            } ?>
        </table>
    </main>
</body>
</html>
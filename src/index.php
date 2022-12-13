<?php
require_once("./components/head.php");
require_once("./components/header.php");

require("./utils/BuchladenService.php");
$service = new BuchladenService();

$table = "Home";
$data = null;
$keys = null;

// Falls GET Methode Data geändert wird
if (isset($_GET["data"])) {
    $table = $_GET["data"];
    if ($table != "Home") {
        getData(strtolower($table));
    } else {
        $data = null;
        $keys = null;
    }
}

function getData($table) {
    global $service;
    global $data;
    global $keys;

    // GET Autoren
    $data = $service->get($table);
    // Keys raus schnappen (Tabellenkopf)
    $keys = array_keys($data[0]);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php compHead($table) ?>
<body>
    <?php compHeader($table) ?>
    <?php if($table == "Home") { ?>
    <section>
        <h2>Wähle oben in der Navigationsbar eine Tabelle aus.</h2>
    </section>
    <?php } ?>
    <?php if($data != null && $keys != null) { ?>
    <section>
        <table>
            <tr>
                <?php foreach ($keys as $key) {
                    echo "<th>$key</th>";
                } ?>
            </tr>
            <?php foreach ($data as $d) {
                echo "<tr>";
                foreach ($keys as $key) {
                    echo "<td>$d[$key]</td>";
                }
                echo "</tr>";
            } ?>
        </table>
    </section>
    <?php } ?>
</body>
</html>
<?php
require_once("./components/head.php");
require_once("./components/header.php");

require("./utils/UtilClass.php");
require("./utils/BuchladenService.php");
$service = new BuchladenService();

$table = "Home";
$data = null;
$keys = null;

// Falls GET Methode Data geändert wird
if (isset($_GET["data"])) {
    $table = $_GET["data"];
    if ($table != "Home") {
        $data = getData(strtolower($table));
        $keys = getKeys($data);
    } else {
        $data = null;
        $keys = null;
    }
}

if (isset($_POST["statement"])) {
    $statement = $_POST["statement"];
    $data = $service->getCustomStatement($statement);
    if ($data == "Invalid Statement") {
        $_POST["error"] = "Invalid Statement";
    } else {
        $keys = getKeys($data);
    }
}

function getData($table) {
    global $service;

    // GET
    return $service->get($table);
}

function getKeys($data) {
    // Keys raus schnappen (Tabellenkopf)
    return array_keys($data[0]);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php compHead($table) ?>
<body>
    <?php compHeader($table) ?>
    <?php if(isset($_POST["error"])) { ?>
    <section class="error">
        <h2>Error<br><?php echo $_POST["error"] ?></h2>
    </section>
    <?php } ?>
    <?php if($table == "Home" && !isset($_POST["error"]) && $data == null && $keys == null) { ?>
    <section>
        <h2>Wähle oben in der Navigationsbar eine Tabelle aus<br>oder wähle ein eigenes SELECT-Statement</h2>
    </section>
    <?php } ?>
    <?php if($data != null && $keys != null) { ?>
    <section>
        <table>
            <tr>
                <?php foreach ($keys as $key) {
                    if ($key == "verlage_verlage_id") {
                        echo "<th>Verlag</th>";
                    } elseif ($key == "orte_orte_id") {
                        echo "<th>Ort</th>";
                    } else {
                        echo "<th>" . ucfirst($key) . "</th>";
                    }
                } ?>
            </tr>
            <?php foreach ($data as $d) {
                echo "<tr>";
                foreach ($keys as $key) {
                    if ($key == "verlage_verlage_id") {
                        $verlage = getData("verlage");
                        $verlage_filtered = array_filter($verlage, function ($val) {
                            global $d;
                            global $key;

                        return $val["verlage_id"] == $d[$key];
                        });
                        $name = reset($verlage_filtered)["name"];

                        echo "<td>$name</td>";
                    } elseif ($key == "orte_orte_id") {
                        $orte = getData("orte");
                        $orte_fitlered = array_filter($orte, function ($val) {
                            global $d;
                            global $key;

                        return $val["orte_id"] == $d[$key];
                        });
                        $name = reset($orte_fitlered)["name"];

                        echo "<td>$name</td>";
                    } else {
                        echo "<td>$d[$key]</td>";
                    }
                }
                echo "</tr>";
            } ?>
        </table>
    </section>
    <?php } ?>
</body>
</html>
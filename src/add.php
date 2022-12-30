<?php
require_once("./components/head.php");
require_once("./components/header.php");
require_once("./components/footer.php");

require("./utils/BuchladenService.php");
$service = new BuchladenService();

function backToPage() {
    global $table;

    echo "<script>window.location.replace('index.php?data=" . $table . "')</script>";
}

$table = $_GET["data"];
?>
<!DOCTYPE html>
<html lang="en">
<?php compHead($table) ?>
<body>
    <?php compHeader($table);
    switch ($table) {
        case 'Buecher':
            ?>
            <form method="POST" class="form">
                <div class="full-form">
                    <label>Titel:</label><br>
                    <input class="form-field" type="text" name="buecher_titel" required>
                </div>
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Verkaufspreis:</label><br>
                        <input class="form-field" type="number" name="buecher_verkaufspreis" required>
                    </div>
                    <div class="half-form">
                        <label>Einkaufspreis:</label><br>
                        <input class="form-field" type="number" name="buecher_einkaufspreis" required> 
                    </div>
                </div>
                <div class="full-form">
                    <label>Erscheinungsjahr:</label><br>
                    <input class="form-field" type="number" name="buecher_erscheinungsjahr" required>
                </div>
                <div class="full-form">
                    <label>Verlag:</label><br>
                        <select class="form-field" name="buecher_verlag" required>
                            <?php 
                                $verlage = $service->get("verlage");
                                foreach ($verlage as $v) {
                                    echo "<option value='" . $v["verlage_id"] . "'>" . $v["name"] . "</option>";
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="buecher" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Autoren':
            ?>
        <form method="POST" class="form">
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Vorname:</label><br>
                        <input class="form-field" type="text" name="autoren_vorname" required>
                    </div>
                    <div class="half-form">
                        <label>Nachname:</label><br>
                        <input class="form-field" type="text" name="autoren_nachname" required> 
                    </div>
                </div>
                <div class="full-form">
                    <label>Geburtsdatum:</label><br>
                    <input class="form-field" type="text" name="autoren_geburtsdatum" required>
                </div>
                <button type="submit" name="autoren" value="true">Hinzufügen</button>
            </form>
        <?php
            break;
        
        case 'Verlage':
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Name:</label><br>
                    <input class="form-field" type="text" name="verlage_name" required>
                </div>
                <div class="full-form">
                    <label>Ort:</label><br>
                        <select class="form-field" name="verlage_orte" required>
                            <?php 
                                $orte = $service->get("orte");
                                foreach ($orte as $o) {
                                    echo "<option value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="verlage" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Sparten':
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Bezeichnung:</label><br>
                    <input class="form-field" type="text" name="sparten_bezeichnung" required>
                </div>
                <button type="submit" name="sparten" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Lieferanten':
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Name:</label><br>
                    <input class="form-field" type="text" name="lieferanten_name" required>
                </div>
                <div class="full-form">
                    <label>Ort:</label><br>
                        <select class="form-field" name="lieferanten_orte" required>
                            <?php 
                                $orte = $service->get("orte");
                                foreach ($orte as $o) {
                                    echo "<option value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="lieferanten" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Orte':
            ?>
        <form method="POST" class="form">
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Name:</label><br>
                        <input class="form-field" type="text" name="orte_name" required>
                    </div>
                    <div class="half-form">
                        <label>Postleitzahl:</label><br>
                        <input class="form-field" type="number" name="orte_postleitzahl" required> 
                    </div>
                </div>
                <button type="submit" name="orte" value="true">Hinzufügen</button>
            </form>
            <?php
        default:
            # code...
            break;
    }
    compFooter(); ?>
</body>
</html>

<?php 
if (isset($_POST["buecher"])) {
    $b_titel = "'" . $_POST["buecher_titel"] . "'";
    $b_verkaufspreis = $_POST["buecher_verkaufspreis"];
    $b_einkaufspreis = $_POST["buecher_einkaufspreis"];
    $b_erscheinungsjahr = $_POST["buecher_erscheinungsjahr"];
    $b_verlag = $_POST["buecher_verlag"];

    $service->add(
        "buecher", 
        array("titel", "verkaufspreis", "einkaufspreis", "erscheinungsjahr", "verlage_verlage_id"),
        array($b_titel, $b_verkaufspreis, $b_einkaufspreis, $b_erscheinungsjahr, $b_verlag));

    backToPage();
}

if (isset($_POST["autoren"])) {
    $a_vorname = "'" . $_POST["autoren_vorname"] . "'";
    $a_nachname = $_POST["autoren_nachname"];
    $a_geburtsdatum = $_POST["autoren_geburtsdatum"];

    $service->add(
        "autoren", 
        array("vorname", "nachname", "geburtsdatum"),
        array($a_vorname, $a_nachname, $a_geburtsdatum));
        
    backToPage();
}

if (isset($_POST["verlage"])) {
    $v_name = "'" . $_POST["verlage_name"] . "'";
    $v_ort = $_POST["verlage_orte"];

    $service->add(
        "verlage", 
        array("name", "orte_orte_id"),
        array($v_name, $v_ort));
        
    backToPage();
}

if (isset($_POST["sparten"])) {
    $s_bezeichnung = "'" . $_POST["sparten_bezeichnung"] . "'";

    $service->add(
        "sparten", 
        array("bezeichnung"),
        array($s_bezeichnung));
        
    backToPage();
}

if (isset($_POST["lieferanten"])) {
    $l_name = "'" . $_POST["lieferanten_name"] . "'";
    $l_ort = $_POST["lieferanten_orte"];

    $service->add(
        "lieferanten", 
        array("name", "orte_orte_id"),
        array($l_name, $l_ort));
        
    backToPage();
}

if (isset($_POST["orte"])) {
    $o_name = "'" . $_POST["orte_name"] . "'";
    $o_postleitzahl = "'" . $_POST["orte_postleitzahl"] . "'";

    $service->add(
        "orte", 
        array("name", "postleitzahl"),
        array($o_name, $o_postleitzahl));
        
    backToPage();
}
?>
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
$id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<?php compHead($table) ?>
<body>
    <?php compHeader($table);
    switch ($table) {
        case 'Buecher':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.buecher WHERE buecher_id = " . $id)[0];
            ?>
            <form method="POST" class="form">
                <div class="full-form">
                    <label>Titel:</label><br>
                    <input class="form-field" type="text" name="buecher_titel" value="<?php echo $data["titel"] ?>" required>
                </div>
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Verkaufspreis:</label><br>
                        <input class="form-field" step=".01" type="number" name="buecher_verkaufspreis" value="<?php echo $data["verkaufspreis"] ?>" required>
                    </div>
                    <div class="half-form">
                        <label>Einkaufspreis:</label><br>
                        <input class="form-field" step=".01" type="number" name="buecher_einkaufspreis" value="<?php echo $data["einkaufspreis"] ?>" required> 
                    </div>
                </div>
                <div class="full-form">
                    <label>Erscheinungsjahr:</label><br>
                    <input class="form-field" type="number" name="buecher_erscheinungsjahr" value="<?php echo $data["erscheinungsjahr"] ?>" required>
                </div>
                <div class="full-form">
                    <label>Verlag:</label><br>
                        <select class="form-field" name="buecher_verlag" value="<?php echo $data["verlage_verlage_id"] ?>" required>
                            <?php 
                                $verlage = $service->get("verlage");
                                foreach ($verlage as $v) {
                                    if ($v["verlage_id"] == $data["verlage_verlage_id"]) {
                                        echo "<option selected value='" . $v["verlage_id"] . "'>" . $v["name"] . "</option>";
                                    } else {
                                        echo "<option value='" . $v["verlage_id"] . "'>" . $v["name"] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="buecher_edit" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Autoren':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.autoren WHERE autoren_id = " . $id)[0];
            ?>
        <form method="POST" class="form">
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Vorname:</label><br>
                        <input class="form-field" type="text" name="autoren_vorname" value="<?php echo $data["vorname"] ?>" required>
                    </div>
                    <div class="half-form">
                        <label>Nachname:</label><br>
                        <input class="form-field" type="text" name="autoren_nachname" value="<?php echo $data["nachname"] ?>" required> 
                    </div>
                </div>
                <div class="full-form">
                    <label>Geburtsdatum:</label><br>
                    <input class="form-field" type="text" name="autoren_geburtsdatum" value="<?php echo $data["geburtsdatum"] ?>" required>
                </div>
                <button type="submit" name="autoren_edit" value="true">Hinzufügen</button>
            </form>
        <?php
            break;
        
        case 'Verlage':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.verlage WHERE verlage_id = " . $id)[0];
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Name:</label><br>
                    <input class="form-field" type="text" name="verlage_name" value="<?php echo $data["name"] ?>" required>
                </div>
                <div class="full-form">
                    <label>Ort:</label><br>
                        <select class="form-field" name="verlage_orte" required>
                            <?php 
                                $orte = $service->get("orte");
                                foreach ($orte as $o) {
                                    if ($o["orte_id"] == $data["orte_orte_id"]) {
                                        echo "<option selected value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                    } else {
                                        echo "<option value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="verlage_edit" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Sparten':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.sparten WHERE sparten_id = " . $id)[0];
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Bezeichnung:</label><br>
                    <input class="form-field" type="text" value="<?php echo $data["bezeichnung"] ?>" name="sparten_bezeichnung" required>
                </div>
                <button type="submit" name="sparten_edit" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Lieferanten':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.lieferanten WHERE lieferanten_id = " . $id)[0];
            ?>
        <form method="POST" class="form">
                <div class="full-form">
                    <label>Name:</label><br>
                    <input class="form-field" type="text" name="lieferanten_name" value="<?php echo $data["name"] ?>" required>
                </div>
                <div class="full-form">
                    <label>Ort:</label><br>
                        <select class="form-field" name="lieferanten_orte" required>
                            <?php 
                                $orte = $service->get("orte");
                                foreach ($orte as $o) {
                                    if ($o["orte_id"] == $data["orte_orte_id"]) {
                                        echo "<option selected value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                    } else {
                                        echo "<option value='" . $o["orte_id"] . "'>" . $o["name"] . " | " . $o["postleitzahl"] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                <button type="submit" name="lieferanten_edit" value="true">Hinzufügen</button>
            </form>
            <?php
            break;
        
        case 'Orte':
            $data = $service->getCustomStatement("SELECT * FROM buchladen.orte WHERE orte_id = " . $id)[0];
            ?>
        <form method="POST" class="form">
                <div class="full-form flex">
                    <div class="half-form">
                        <label>Name:</label><br>
                        <input class="form-field" type="text" value="<?php echo $data["name"] ?>" name="orte_name" required>
                    </div>
                    <div class="half-form">
                        <label>Postleitzahl:</label><br>
                        <input class="form-field" type="number" value="<?php echo $data["postleitzahl"] ?>" name="orte_postleitzahl" required> 
                    </div>
                </div>
                <button type="submit" name="orte_edit" value="true">Hinzufügen</button>
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
if (isset($_POST["buecher_edit"])) {
    $b_titel = "'" . $_POST["buecher_titel"] . "'";
    $b_verkaufspreis = $_POST["buecher_verkaufspreis"];
    $b_einkaufspreis = $_POST["buecher_einkaufspreis"];
    $b_erscheinungsjahr = $_POST["buecher_erscheinungsjahr"];
    $b_verlag = $_POST["buecher_verlag"];

    $service->update("buecher", "titel", $b_titel, "buecher_id", $id);
    $service->update("buecher", "verkaufspreis", $b_verkaufspreis, "buecher_id", $id);
    $service->update("buecher", "einkaufspreis", $b_einkaufspreis, "buecher_id", $id);
    $service->update("buecher", "erscheinungsjahr", $b_erscheinungsjahr, "buecher_id", $id);
    $service->update("buecher", "verlage_verlage_id", $b_verlag, "buecher_id", $id);
        
    backToPage();
}

if (isset($_POST["autoren_edit"])) {
    $a_vorname = "'" . $_POST["autoren_vorname"] . "'";
    $a_nachname = "'" . $_POST["autoren_nachname"] . "'";
    $a_geburtsdatum = "'" . $_POST["autoren_geburtsdatum"] . "'";

    $service->update("autoren", "vorname", $a_vorname, "autoren_id", $id);
    $service->update("autoren", "nachname", $a_nachname, "autoren_id", $id);
    $service->update("autoren", "geburtsdatum", $a_geburtsdatum, "autoren_id", $id);
        
    backToPage();
}

if (isset($_POST["verlage_edit"])) {
    $v_name = "'" . $_POST["verlage_name"] . "'";
    $v_ort = $_POST["verlage_orte"];

    $service->update("verlage", "name", $v_name, "verlage_id", $id);
    $service->update("verlage", "orte_orte_id", $v_ort, "verlage_id", $id);
        
    backToPage();
}

if (isset($_POST["sparten_edit"])) {
    $s_bezeichnung = "'" . $_POST["sparten_bezeichnung"] . "'";

    $service->update("sparten", "bezeichnung", $s_bezeichnung, "sparten_id", $id);

    backToPage();
}

if (isset($_POST["lieferanten_edit"])) {
    $l_name = "'" . $_POST["lieferanten_name"] . "'";
    $l_ort = $_POST["lieferanten_orte"];

    $service->update("lieferanten", "name", $l_name, "lieferanten_id", $id);
    $service->update("lieferanten", "orte_orte_id", $l_ort, "lieferanten_id", $id);

    backToPage();
}

if (isset($_POST["orte_edit"])) {
    $o_name = "'" . $_POST["orte_name"] . "'";
    $o_postleitzahl = "'" . $_POST["orte_postleitzahl"] . "'";

    $service->update("orte", "name", $o_name, "orte_id", $id);
    $service->update("orte", "postleitzahl", $o_postleitzahl, "orte_id", $id);

    backToPage();
}
?>
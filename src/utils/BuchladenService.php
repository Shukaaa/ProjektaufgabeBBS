<?php
require_once("./db/mysqli_connection.php");

// Service für jegliche Methoden (GET, POST, DELETE, PATCH)
class BuchladenService {
    public function get($table) {
        // Erstellt Datenbankverbindung
        $mysqli = new MysqliConnection();
        $conn = $mysqli->getConnection();
        $database = $mysqli->getDatabase();

        // SQL-Statement für query
        $SQL = "SELECT * FROM $database.$table";

        // Ergebnisse werden im data Array abgelegt
        $result = $conn->query($SQL);
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }
}

?>
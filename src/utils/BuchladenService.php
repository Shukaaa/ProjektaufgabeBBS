<?php
require_once("./db/mysqli_connection.php");

// Service für jegliche Methoden (GET, POST, DELETE, PATCH)
class BuchladenService {
    private $conn;
    private $database;

    function __construct() {
        // Erstellt Datenbankverbindung
        $mysqli = new MysqliConnection();
        $this->conn = $mysqli->getConnection();
        $this->database = $mysqli->getDatabase();
    }
    public function get($table) {
        // SQL-Statement für query
        $SQL = "SELECT * FROM $this->database.$table";

        // Ergebnisse werden im data Array abgelegt
        $result = $this->conn->query($SQL);
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function getCustomStatement($SQL) {
        if (str_contains(strtolower($SQL), "select") && str_contains(strtolower($SQL), "from")) {
            try {
                // Ergebnisse werden im data Array abgelegt
                $result = $this->conn->query($SQL);
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }

                return $data;
            } catch (mysqli_sql_exception) {
                return "Invalid Statement";
            }
        }
        return "Invalid Statement";
    }
}

?>
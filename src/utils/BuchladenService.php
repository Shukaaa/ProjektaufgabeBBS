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

    public function delete($table, $key, $value) {
        // SQL-Statement für query
        $SQL = "DELETE FROM $this->database.$table WHERE $key=$value";

        $this->conn->query($SQL);
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

    public function resetDB() {
        if(file_exists('../db/buchladen.sql') == true){
            $filename = '../db/buchladen.sql';
        }
        else if (file_exists('./db/buchladen.sql') == true){
            $filename = './db/buchladen.sql';
        }
        else{
            print("Error: Keine Datenbankdatei gefunden");
            return 0;
        }
    
        $tempLine = '';
        $lines = file($filename);
        foreach ($lines as $line) {
    
            if (substr($line, 0, 2) == '--' || $line == '')
                    continue;
    
            $tempLine .= $line;
            if (substr(trim($line), -1, 1) == ';')  {
                mysqli_query($this->conn, $tempLine) or print("Error in " . $tempLine .":". mysqli_error($this->conn));
                $tempLine = '';
            }
        }
    }
}

?>
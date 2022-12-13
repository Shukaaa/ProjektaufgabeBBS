<?php 

class MysqliConnection {
    // Datenbank-Einstellungs-Variablen
    private $servername = "localhost";																		//Lösung Aufgabe 4
    private $username = "root";
    private $password = "";
    private $database = "buchladen";																		//Lösung Aufgabe 5

    // Erstellt eine mysqli connection und returnt diese
    public function getConnection() {
        $conn = new mysqli($this->servername, $this->username, $this->password);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    // Simpler Getter um die Datenbank-Variable zu bekommen
    public function getDatabase() {
        return $this->database;
    }
}

?>
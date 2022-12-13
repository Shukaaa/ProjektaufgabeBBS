<?php
require_once("./db/mysqli_connection.php");

class BuchladenService {
    public function get($table) {
        $mysqli = new MysqliConnection();
        $conn = $mysqli->getConnection();
        $database = $mysqli->getDatabase();

        $SQL = "SELECT * FROM $database.$table";

        $result = $conn->query($SQL);
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        
        return $data;
    }
}

?>
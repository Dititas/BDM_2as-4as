<?php
    class dbConnection {
        static public function connect() {
            $host = "localhost";
            $db = "bytesandbits";
            $user = "root";
            $pass = "#Orjamoon29";
            try {
                $mysqli = new mysqli($host,$user,$pass,$db);
                if ($mysqli->connect_errno) {
                    $response = (object)array("status"=>500,"message"=>$mysqli->connect_error);
                    echo json_encode($response);
                    die("Error de conexión: " . $mysqli->connect_error);
                }

            } catch(Exception $e) {
                $response = (object)array("status"=>500,"message"=>$e->getMessage());
                echo json_encode($response);
                exit;
            }
            return $mysqli;
        }
      
    }
?>
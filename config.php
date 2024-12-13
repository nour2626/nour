<?php
// Avoid declaring the class if it's already defined
if (!class_exists('config')) {
    class config {
        // Configuration logic here
        public static function getConnexion() {
            try {
                $dsn = "mysql:host=127.0.0.1;dbname=projet20242025"; // Update your database credentials
                $username = "root";  // Change to your DB username
                $password = "";  // Change to your DB password
                $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                );
                $pdo = new PDO($dsn, $username, $password, $options);
                return $pdo;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }
}
?>

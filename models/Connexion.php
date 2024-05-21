<?php

class Connexion {
    private static $instance = null;

    public static function getConnexion() {
        if (self::$instance === null) {
            $host = 'localhost';
            $db = 'ihebbase';
            $login = 'root';
            $mdp = '';
            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$db", $login, $mdp);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$instance;
    }
}
?>

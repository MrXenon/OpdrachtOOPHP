<?php
/**
 * Create database connection
 * Include in klasse files
 */

// Definieer de database waarden
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'norcom_2');
/**
 * Class Database
 * singleton class - zelfde principe als wordpress (kan de database globaal door de gehele website oproepen).
 */

class Database {

    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}

/**
 * Class DB_con
 * Enkele database connectie
 */
class DB_con {
    public $connection;
    function __construct(){
        $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

        if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);

    }

    function ret_obj(){
        return $this->connection;
    }

}
?>
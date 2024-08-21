<?php
class Config
{
    private static $dpName = 'perpustakaan_ntan';
    private static $dpHost = 'localhost';
    private static $dpUsername = 'root';
    private static $dpPass = '';
    private static $connection = null;

    // Prevent direct creation of object
    private function __construct() {
        // Prevent instantiation
        throw new Exception('Cannot instantiate Config class');
    }

    // Create and return the database connection
    public static function connect()
    {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . self::$dpHost . ";dbname=" . self::$dpName;
                self::$connection = new PDO($dsn, self::$dpUsername, self::$dpPass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Log the exception message or handle it as needed
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }

    // Disconnect from the database
    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>

<?php
class config
{
    private static $dpName = 'perpustakaan_ntan';
    private static $dpHost = 'localhost';
    private static $dpUsername = 'root';
    private static $dpPass = '';
    private static $connection = null;
    public function __construct() {
        die('Init function is not allowet');
    }
    public static function connect()
    {
        if (null == self ::$connection)
        {
            try
            {
                self::$connection = new PDO("mysql:host=" . selft::$dpHost . ";dpname=" . self::$dpName, self::$dpUsername, self::$dpPass);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>
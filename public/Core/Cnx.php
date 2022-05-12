<?php
namespace App\Core;

// on importe PDO
use PDO;
use PDOException;

class Cnx extends PDO 
{
    // Instance unique de la class
    private static $instance;

    // information de cnx à la bdd
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'password';
    private const DBNAME = 'PHPBlog';

    public function __construct()
    {
        // dsn de cnx
        $_dsn = "mysql:host=" . self::DBHOST . ';dbname=' .self::DBNAME;

        // on appelle le constructeur de PDO
        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            return $e->getMessage();
        }


    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        } 
        return self::$instance;
    }
}

<?php

    //based on p439
    class Database{
        private static $dsn = 'mysql:host=localhost;dbname=quotesdb';
        private static $username = 'root';
        private static $db;

        private function __construct(){}

        public static function getDB(){
            if(!isset(self::$db)){

                //Heorku
                $url = getenv('JAWSDB_URL');
                if(!empty($url)){
                    try {
                        $dbparts = parse_url($url);

                        $hostname = $dbparts['host'];
                        self::$username = $dbparts['user'];
                        $password = $dbparts['pass'];
                        $database = ltrim($dbparts['path'],'/');
                        self::$db = new PDO("mysql:host=$hostname;dbname=$database", self::$username, $password);
                        // set the PDO error mode to exception
                        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "ERROR" . $e->getMessage();
                        $error = "Database Error: ";
                        $error .= $e->getMessage();
                        include('../view/error.php');
                        exit();
                    }
                }
                else {
                    try {
                        self::$db = new PDO(self::$dsn,
                            self::$username);
                        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        $error = "Database Error: ";
                        $error .= $e->getMessage();
                        echo $error;
                        //include('../view/error.php');
                        exit();
                    }
                }
            }
            return self::$db;
        }

    }
?>
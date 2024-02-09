<?php
class Database
{
    // connessione diretta al database interno a SERVER MySQL
    // usa PDO per fetch delle righe ritornate dalla query
    public static function Connect()
    {
        $dsn = "mysql:dbname= emma_pilotto_ecommerce;host=192.168.2.200"    ;
        try {
            $pdo = new PDO($dsn, 'emma_pilotto', "tithed.consortiums.respect.");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $exception) {
            die("Connection Fail: " . $exception->getMessage());

        }
    }

}
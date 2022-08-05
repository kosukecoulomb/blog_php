<?php

class connect
{
    const DB_NAME = "blog";
    const HOST = "localhost";
    const USER = "user";
    const PASS = "pass";

    private $dbh;

    public function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
        try {
            $this->dbh = new PDO($dsn, self::USER, self::PASS);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public function query($sql, $param = null)
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($param);
        return $stmt;
    }
}

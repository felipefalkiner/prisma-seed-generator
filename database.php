<?php 
require_once("config.php");

class Database
{
    const HOST = MYSQL_HOST;
    const USER = MYSQL_USER;
    const PASSWORD = MYSQL_PASSWORD;
    const NAME = MYSQL_DATABASE;

    public static function createConnection()
    {
        $con = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::NAME);
        mysqli_set_charset($con, "utf8");

        return $con;
    }
}
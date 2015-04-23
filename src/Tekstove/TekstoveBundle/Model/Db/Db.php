<?php

namespace Tekstove\TekstoveBundle\Model\Db;

use PDO;

/**
 * Description of Db
 *
 * @author potaka
 */
class Db implements DbInterface
{

    private $pdo;

    function __construct($dbName, $user, $pass, $host = '127.0.0.1', $charset = 'utf8', $port = 3306)
    {
        $dsn = "mysql:dbname={$dbName};host={$host};port={$port}";
        $pdo = new \PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES {$charset}");
        $this->pdo = $pdo;
    }

    public function getDb()
    {
        return $this->pdo;
    }

}

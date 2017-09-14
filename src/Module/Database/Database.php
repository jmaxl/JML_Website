<?php

namespace Project\Module\Database;

use Project\Configuration;

class Database
{
    protected static $instance;

    protected $host;

    protected $user;

    protected $password;

    protected $database;

    /**
     * @var \PDO $connection
     */
    protected $connection;

    protected function __construct(Configuration $configuration)
    {
        $databaseConfiguration = $configuration->getEntryByName('database');

        $this->host = $databaseConfiguration['host'];
        $this->user = $databaseConfiguration['user'];
        $this->password = $databaseConfiguration['password'];
        $this->database = $databaseConfiguration['database'];

        $this->connect();
    }

    public function connect(): void
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database /*. ';charset=UTF-8'*/;
        $this->connection = new \PDO($dsn, $this->user, $this->password);
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self(new Configuration());
        }

        return self::$instance;
    }

    public function fetchAll(string $table): array
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table);

        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchAllOrderBy(string $table, string $orderBy, string $orderKind = 'ASC'): array
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' ORDER BY ' . $orderBy . ' ' . $orderKind);

        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchLimitedOrderBy(string $table, string $orderBy, string $orderKind = 'ASC', int $limit = 1): array
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' ORDER BY ' . $orderBy . ' ' . $orderKind . ' LIMIT ' . $limit);

        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchByDateParameterFuture(string $table, string $dateName, string $dateValue, string $orderBy, string $orderKind = 'ASC', int $limit = 1)
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' WHERE ' . $dateName . ' > "' . $dateValue . '" ORDER BY ' . $orderBy . ' ' . $orderKind . ' LIMIT ' . $limit);

        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


    public function fetchById(string $table, string $idName, string $idValue)
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' WHERE ' . $idName . ' = "' . $idValue . '"');

        return $sql->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchByStringParameter(string $table, $parameter, $value)
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' WHERE ' . $parameter. ' = "' . $value . '"');

        $result = $sql->fetchAll(\PDO::FETCH_OBJ);

        return $result;
    }
}
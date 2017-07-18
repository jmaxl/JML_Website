<?php
declare(strict_types=1);

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

            # make connection

            # set is connected variable
            $this->bIsConnected = true;
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

    public function fetchById(string $table, array $parameter)
    {
        $sql = $this->connection->query('SELECT * FROM ' . $table . ' WHERE ' . $parameter['idName'] . ' = ' . $parameter['idValue']);

        return $sql->fetch(\PDO::FETCH_OBJ);
    }
}
<?php

namespace Model;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
	private $host;
	private $dbname;
	private $username;
	private $password;
	private $charset;
	private $pdo;

	public function __construct()
	{
		$this->loadEnv();
		$this->connect();
	}

	private function loadEnv()
	{
		try {
			$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
			$dotenv->load();
			$this->host = $_ENV['DB_HOST'] ?? null;
			$this->dbname = $_ENV['DB_NAME'] ?? null;
			$this->username = $_ENV['DB_USER'] ?? null;
			$this->password = $_ENV['DB_PASSWORD'] ?? null;
			$this->charset = $_ENV['DB_CHARSET'] ?? 'utf8';
		} catch (\Exception $e) {
			exit("Failed to load environment variables: " . $e->getMessage());
		}
	}

	private function connect()
	{
		if ($this->pdo === null) try {
			$dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false,
			];

			$this->pdo = new PDO($dsn, $this->username, $this->password, $options);
		} catch (PDOException $e) {
			exit("Connection failed: " . $e->getMessage());
		}
	}

	public function getConnection()
	{
		return $this->pdo;
	}
}

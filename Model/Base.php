<?php

namespace Model;

use PDO;

class Base
{
	private $db;
	protected $table;

	public function __construct()
	{
		$this->db = (new Database())->getConnection();
	}

	public function select($columns = "*", $conditions = "", $params = [])
	{
		$sql = "SELECT {$columns} FROM {$this->table}";

		if (!empty($conditions)) $sql .= " WHERE {$conditions}";

		$stmt = $this->db->prepare($sql);
		foreach ($params as $key => $value)
			$stmt->bindValue($key, $value);

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data)
	{
		$columns = implode(", ", array_keys($data));
		$placeholders = implode(", ", array_fill(0, count($data), '?'));

		$sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
		$stmt = $this->db->prepare($sql);

		foreach ($data as $key => $value) $stmt->bindValue(":$key", $value);

		return $stmt->execute();
	}

	public function update($data, $conditions, $params)
	{
		$set = "";
		foreach ($data as $column => $value)
			$set .= "{$column} = :{$column}, ";
		$set = rtrim($set, ", ");

		$sql = "UPDATE {$this->table} SET {$set} WHERE {$conditions}";
		$stmt = $this->db->prepare($sql);

		foreach ($data as $key => $value)
			$stmt->bindValue(":{$key}", $value);

		foreach ($params as $key => $value)
			$stmt->bindValue(":{$key}", $value);

		return $stmt->execute();
	}

	public function delete($conditions, $params)
	{
		$sql = "DELETE FROM {$this->table} WHERE $conditions";
		$stmt = $this->db->prepare($sql);

		foreach ($params as $key => $value)
			$stmt->bindValue(":{$key}", $value);

		return $stmt->execute();
	}
}

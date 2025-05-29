<?php

namespace Model\Table;

use Model\Base;

class CidadãoNIS extends Base
{
	protected $table = 'citizen_nis';

	public function getAll()
	{
		return $this->select("*", "", [], 5);
	}

	public function countCitizens($conditions = "")
	{
		return $this->count($conditions, []);
	}

	public function getByNIS($NIS)
	{
		return $this->select("*", "nis = :nis", [':nis' => $NIS]);
	}

	public function getByName($name)
	{
		return $this->select("*", "name = :name", [':name' => $name]);
	}
}

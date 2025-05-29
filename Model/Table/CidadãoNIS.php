<?php

namespace Model\Table;

use Model\Base;

class CidadãoNIS extends Base
{
	protected $table = 'citizen_nis';

	public function getAll()
	{
		return $this->select("*");
	}

	public function getByID($NIS)
	{
		return $this->select("*", "nis = :nis", [':nis' => $NIS]);
	}
}

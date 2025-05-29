<?php

namespace Model;

use Model\Base;

class Citizen extends Base
{
	protected $table = 'citizen_nis';

	public function getByID($NIS)
	{
		return $this->select("*", "nis = :nis", [':nis' => $NIS]);
	}
}

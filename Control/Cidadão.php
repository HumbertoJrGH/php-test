<?php

namespace Control;

use Model\Table\CidadãoNIS;

class Cidadão
{
	public function __construct() {}

	public function getAll()
	{
		$Model = new CidadãoNIS();
		return $Model->getAll();
	}
}

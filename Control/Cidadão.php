<?php

namespace Control;

use Model\Table\CidadãoNIS;

class Cidadão
{
	public function __construct() {}

	public function count()
	{
		return (new CidadãoNIS())->countCitizens();
	}
	public function getAll()
	{
		$Model = new CidadãoNIS();
		return $Model->getAll();
	}

	public function getByNIS($nis)
	{
		$Model = new CidadãoNIS();
		return $Model->getByNIS($nis);
	}

	public function save($name)
	{
		$Model = new CidadãoNIS();
		if (empty($name) || !is_string($name)) return [
			'status' => false,
			'message' => 'Nome inválido.'
		];

		$content = $Model->getByName($name);

		if (count($content) > 0)
			return [
				'status' => false,
				'message' => 'Cidadão já cadastrado.'
			];

		$NIS = rand(10000000000, 99999999999);
		$content = $Model->getByNIS($NIS);
		if (count($content) > 0)
			return [
				'status' => false,
				'message' => 'NIS gerado em duplicidade, tente novamente.'
			];

		if ($Model->insert(['name' => $name, 'nis' => $NIS]))
			return [
				'status' => true,
				'NIS' => $NIS
			];
		else return [
			'status' => false,
			'message' => 'Erro ao cadastrar cidadão.'
		];
	}
}

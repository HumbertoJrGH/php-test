<?php

namespace Control;

use Model\Table\CidadãoNIS;

class Cidadão
{
	private $Model;
	public function __construct()
	{
		$this->Model = new CidadãoNIS();
	}

	public function getPDO()
	{
		return $this->Model->getPDO();
	}

	public function count()
	{
		return $this->Model->countCitizens();
	}
	public function getAll()
	{
		return $this->Model->getAll();
	}

	public function getByName($name)
	{
		return $this->Model->getByName($name);
	}

	public function getByNIS($nis)
	{
		return $this->Model->getByNIS($nis);
	}

	public function save($name)
	{
		if (empty($name) || !is_string($name)) return [
			'status' => false,
			'message' => 'Nome inválido.'
		];

		$content = $this->Model->getByName($name);

		if (count($content) > 0)
			return [
				'status' => false,
				'message' => 'Cidadão já cadastrado.'
			];

		// GERANDO NIS ALEATÓRIO
		$NIS = rand(10000000000, 99999999999);
		$content = $this->Model->getByNIS($NIS);
		if (count($content) > 0)
			return [
				'status' => false,
				'message' => 'NIS gerado em duplicidade, tente novamente.'
			];

		if ($this->Model->insert(['name' => $name, 'nis' => $NIS]))
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

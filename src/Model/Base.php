<?php

namespace System\Model;

class Base
{
	public function __construct()
	{
		echo "chamou o construtor Model";
	}

	public function getModelName()
	{
		return "Model";
	}

	public function getModelVersion()
	{
		return "1.0.0";
	}
}

<?php

namespace View\Pages;

use View\View;

class Form extends View
{
	public function __construct()
	{
		parent::__construct();
		echo "chamou o construtor Form";
	}

	public function render()
	{
		echo "<h1>Formulário</h1>";
		echo "<form method='post' action=''>";
		echo "<label for='name'>Nome:</label>";
		echo "<input type='text' id='name' name='name' required>";
		echo "<button type='submit'>Enviar</button>";
		echo "</form>";
	}
}

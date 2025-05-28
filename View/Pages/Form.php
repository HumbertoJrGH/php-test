<?php

namespace View\Pages;

use View\View;

class Form extends View
{
	public function __construct()
	{
		parent::__construct();
	}

	public function render()
	{
?>
		<h1>Formulário</h1>
		<form method='post' action='/View/Pages/Save.php'>
			<label for='name'>Nome:</label>
			<input type='text' id='name' name='name' required>
			<button type='submit'>Enviar</button>
		</form>
<?php
	}
}

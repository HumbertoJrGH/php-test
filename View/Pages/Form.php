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
		<div class="">
			<h1 class="text-2xl font-semibold text-center mb-6">Formulário Cidadão</h1>
			<div class="space-y-3">
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700">Nome:</label>
					<input
						type="text"
						id="name"
						name="name"
						required
						class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
				</div>
				<button
					id="submit"
					onclick="enviar()"
					class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
					Cadastrar
				</button>
				<div id="ret-cad"></div>
			</div>
		</div>
<?php
	}
}
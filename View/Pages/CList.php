<?php

namespace View\Pages;

use View\View;

class CList extends View
{
	public function __construct()
	{
		parent::__construct();
	}

	public function render()
	{
?>
		<div class="mx-auto">
			<h1 class="text-2xl font-semibold text-center mb-6">Buscar por NIS</h1>

			<div class="space-y-3">
				<div>
					<label for="nis" class="block text-sm font-medium text-gray-700">NIS:</label>
					<input
						type="text"
						id="nis"
						name="nis"
						placeholder="Digite o NIS"
						onkeypress="validarNIS()"
						onkeyup="validarNIS()"
						class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
					<button
						class="w-full mt-3 bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
						onclick="buscarNIS()">
						Buscar
					</button>
				</div>

				<div id="resultados" class="mt-4"></div>
			</div>
		</div>
<?php
	}
}

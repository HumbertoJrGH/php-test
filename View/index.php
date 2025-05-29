<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Control\Cidadão;
use View\Pages\Form;

$form = new Form();
$Cidadão = new Cidadão();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastro NIS</title>
	<link rel="stylesheet" href="./Assets/style.css">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
	<div class="w-full max-w-7xl mx-auto h-50 p-5">
		<div class="flex p-5 gap-15 bg-white rounded-lg shadow-md">
			<div class="w-1/2">
				<?php
				$form->render();
				$cidadãos = $Cidadão->getAll();
				?>
			</div>
			<div class="w-1/2">
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
				//
				?>
			</div>
		</div>
	</div>

	<script src="./Assets/script.js">	</script>
</body>

</html>
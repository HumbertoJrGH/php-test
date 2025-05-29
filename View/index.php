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

	<script>
		function enviar() {
			$("#ret-cad").html('<div role="status"><svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg><span class="sr-only">Loading...</span></div>')
			$('#submit').prop('disabled', true).text('Enviando...')
			$.ajax({
				url: '/View/Ajax/Save.php',
				type: 'POST',
				data: {
					name: $('#name').val()
				},
				success: res => {
					$("#ret-cad").html(res)
					$('#submit').prop('disabled', false).text('Enviar')
					buscarTodos()
				},
				error: err => {
					console.error(err)
					$("#ret-cad").html(res ?? "ERRO")
					$('#submit').prop('disabled', false).text('Enviar')
				}
			})
		}

		function validarNIS() {
			let nis = $('#nis').val()
			if (nis.length === 0) {
				document.getElementById('resultados').innerHTML = '';
				return;
			} else if (nis.length > 11) {
				nis = nis.substring(0, 11)
				$("#nis").val(nis)
				return
			}
		}

		function buscarNIS() {
			let nis = $('#nis').val()
			if (nis.length > 11) {
				nis = nis.substring(0, 11)
				$("#nis").val(nis)
				return
			}

			$.ajax({
				url: "/View/Ajax/Search.php",
				type: "GET",
				data: {
					nis: nis
				},
				success: data => {
					$('#resultados').html(data)
				},
			})
		}

		function buscarTodos() {
			$("#resultados").html('<div role="status"><svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg><span class="sr-only">Loading...</span></div>')
			$.ajax({
				url: "/View/Ajax/Search.php",
				type: "GET",
				data: {
					nis: ""
				},
				success: data => {
					$('#resultados').html(data)
				},
			})
		}

		$(document).ready(function() {
			$('#nis').focus()
			buscarTodos()
		})
	</script>
</body>

</html>
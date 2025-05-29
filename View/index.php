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

					<div class="space-y-4">
						<div>
							<label for="nis" class="block text-sm font-medium text-gray-700">NIS:</label>
							<input
								type="text"
								id="nis"
								name="nis"
								placeholder="Digite o NIS"
								class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								onkeyup="buscarNIS()" <!-- Chamando a função de busca ao digitar -->
							>
						</div>

						<div id="resultados" class="mt-4">
							<!-- Os resultados da busca serão exibidos aqui -->
						</div>
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
				},
				error: err => {
					console.error(err)
					$('#submit').prop('disabled', false).text('Erro')
				}
			})
		}


		function buscarNIS() {
			let nis = document.getElementById('nis').value;

			// Verifica se o NIS não está vazio
			if (nis.length === 0) {
				document.getElementById('resultados').innerHTML = '';
				return;
			} else if (nis.length > 11) {
				nis = nis.substring(0, 11)
				$("#nis").val(nis)
				return
			}

			fetch(`/api/buscar_nis?nis=${nis}`)
				.then(response => response.json())
				.then(data => {
					let resultadosHTML = '';

					if (data.length > 0) {
						// Se houver resultados, mostramos a lista
						resultadosHTML = '<ul class="space-y-2">';
						data.forEach(item => {
							resultadosHTML += `
                            <li class="bg-gray-100 p-4 rounded-md shadow-md">
                                <p><strong>NIS:</strong> ${item.nis}</p>
                                <p><strong>Nome:</strong> ${item.name}</p>
                            </li>
                        `;
						});
						resultadosHTML += '</ul>';
					} else {
						resultadosHTML = '<p class="text-red-500">Nenhum NIS encontrado.</p>';
					}

					document.getElementById('resultados').innerHTML = resultadosHTML;
				})
				.catch(error => {
					console.error('Erro ao buscar NIS:', error);
					document.getElementById('resultados').innerHTML = '<p class="text-red-500">Erro ao buscar os resultados. Tente novamente.</p>';
				});
		}
	</script>
</body>

</html>
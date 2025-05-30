<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Control\Cidadão;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$nis = $_GET['nis'] ?? '';
	if (!is_numeric($nis) && $nis !== "") {
?>
		<div class='bg-red-100 p-3 rounded shadow-md'>O NIS deve conter apenas números.</div>
		<?php
		exit;
	}


	$cidadão = new Cidadão();
	if (!empty($nis)) {
		$content = $cidadão->getByNIS($nis);

		$resultados = array_filter($content, function ($item) use ($nis) {
			return strpos($item['nis'], $nis) !== false;
		});

		if (count($resultados) > 0) {
			foreach ($resultados as $item) {
		?>
				<div class='bg-blue-100 p-3 flex justify-between gap-3 rounded mb-2 shadow-md'>
					<div class="flex flex-col">
						<div><b>NIS:</b> <?= htmlspecialchars($item['nis']) ?></div>
						<div><b>Nome:</b> <?= htmlspecialchars($item['name']) ?></div>
					</div>
				</div>
			<?php
			}
		} else {
			?>
			<div>
				<div class='bg-red-100 p-3 rounded shadow-md'>
					Nenhum cidadão encontrado com o NIS: <b><?= htmlspecialchars($nis) ?></b>.
				</div>
				<button class='bg-blue-500 text-white py-2 w-full mt-3 px-4 rounded shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50' onclick="voltar()">Voltar</button>
			</div>
		<?php
		}
	} else {
		$quantidade = $cidadão->count();
		$lista = $cidadão->getAll();

		?>
		<div class="bg-cyan-200 p-3 rounded mb-4 shadow-md">
			Total de cidadãos cadastrados: <?= $quantidade ?>
		</div>
		<?php
		if (count($lista) > 0) {
			foreach ($lista as $item) {
		?>
				<div class='bg-blue-100 p-3 flex justify-between gap-3 rounded mb-2 shadow-md'>
					<div class="flex flex-col">
						<div><b>NIS:</b> <?= htmlspecialchars($item['nis']) ?></div>
						<div><b>Nome:</b> <?= htmlspecialchars($item['name']) ?></div>
					</div>
				</div>
<?php
			}
		} else {
			echo "<div class='bg-red-100 p-3 rounded shadow-md'>Nenhum cidadão cadastrado.</div>";
		}
	}
} else header('HTTP/1.0 405 Method Not Allowed');

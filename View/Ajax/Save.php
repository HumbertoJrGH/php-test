<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Control\Cidadão;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome = $_POST['name'] ?? '';

	$cidadão = new Cidadão();

	if (!empty($nome)) {
		$ret = $cidadão->save($nome);
		if ($ret["status"]) { ?>
			<div class="bg-green-600 p-3 rounded text-center text-white shadow-md">
				Sucesso! <?= $nome ?> cadastrado com sucesso! <br />
				Nº NIS: <b><?= $ret['NIS'] ?></b>.
			</div>
		<?php } else { ?>
			<div class="bg-yellow-600 p-3 rounded text-center text-white shadow-md">
				<?= $ret['message'] ?>
			</div>
		<?php }
	} else {
		?>
		<div class="bg-red-600 p-3 rounded text-center text-white shadow-md">
			<b>Erro:</b> Nome não pode ser vazio!
		</div>
<?php }
}

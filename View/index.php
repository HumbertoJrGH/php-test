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
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
	<div class="w-full h-50 bg-red-500"></div>
	<?php
	$form->render();
	$cidadãos = $Cidadão->getAll();


	if (count($cidadãos) > 0) {
		echo "Temos " . count($cidadãos) . " cidadãos cadastrados:\n";
	} else {
		echo "Cidadão não encontrado\n";
	}
	?>
</body>

</html>
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Control\Cidadão;
use View\Pages\CList;
use View\Pages\Form;

$form = new Form();
$list = new CList();
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
		<div class="md:flex p-5 gap-15 bg-white rounded-lg shadow-md">
			<div class="md:w-1/2">
				<?php
				$form->render();
				?>
			</div>
			<div class="md:w-1/2">
				<?php
				$list->render();
				?>
			</div>
		</div>
	</div>

	<script src="./Assets/script.js"> </script>
</body>

</html>
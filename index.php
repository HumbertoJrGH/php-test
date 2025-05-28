<?php

function redirect()
{
	header("Location: /View/index.php");
	exit();
}

try {
	$version = explode('.', phpversion());
	if (count($version) == 3) {
		if ($version[0] >= 8)
			redirect();
		else echo "deu ruim";
	}
} catch (Exception $e) {
	echo "Erro: " . $e->getMessage();
}
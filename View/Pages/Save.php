<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome = $_POST['name'] ?? '';

	// Aqui você pode processar o dado, salvar no banco, etc.
	// Exemplo: apenas exibir uma mensagem de sucesso

	echo "<h2>Olá, $nome! Seu formulário foi enviado com sucesso.</h2>";
	echo "<a href='/View/'>Voltar</a>";
} else {
	// Redireciona para o formulário se acessar diretamente
	header('Location: /../index.php');
	exit;
}

 # Configuração
 Este projeto foi criado utilizando o PHP 8.2, garanta que o ambiente esteja corretamente configurado para a instalação das dependências e execute o comando `composer install`.
 ## Banco de Dados
 Faça a configuração do banco de dados num arquivo `.env` na raiz do projeto com as seguintes chaves:
 ```ini
DB_HOST=localhost
DB_NAME=nis
DB_USER=root
DB_PASSWORD=123456
DB_CHARSET=utf8
 ```
 Os valores das configurações devem estar de acordo com a sua configuração do banco de dados.
 SQL para criação do banco de dados (utilizando MySQL 8.4):
 ```sql
CREATE DATABASE nis;
USE nis;

CREATE TABLE citizen_nis (
	nis VARCHAR(11) NOT NULL UNIQUE PRIMARY KEY,
   name VARCHAR(255) NOT NULL
);
 ```

 # Execução
 Execute o código com o comando:
 ```bash
php -S localhost:{porta}
 ```

 # Testes
 Os testes do backend foram estruturados com PHPUnit e podem ser executados diretamente com o comando:
 ```bash
composer test
 ```

 # Recursos
 Utilizando a porta de sua preferência (exemplo: `php -S localhost:8008`).
 Tecnologias utilizadas:
 * JQuery
 * Tailwind
 * MySQL
 * DotENV
 * PHPUnit
 O sistema utiliza o PHP Data Objects (PDO) que faz tratativas de segurança para os dados e previne SQL Injection.
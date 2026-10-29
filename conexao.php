<?php
// conexao.php
// Abre a conexão com o banco SQLite usando PDO.
// Toda página que usa o banco começa com: include 'conexao.php';

$arquivo_banco = getenv('DB_PATH') ?: 'banco/loja.db';

// Se o arquivo não existir, o SQLite cria um banco VAZIO sem avisar.
// Por isso conferimos antes de conectar.
if (!file_exists($arquivo_banco)) {
    die('Banco não encontrado em ' . $arquivo_banco . '. Confira o nome do arquivo e a pasta.');
}

try {
    $pdo = new PDO('sqlite:' . $arquivo_banco);

    // Qualquer erro do banco vira uma exceção (cai no catch)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // fetch() e fetchAll() devolvem arrays usando o nome das colunas
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    die('Erro ao conectar com o banco: ' . $erro->getMessage());
}
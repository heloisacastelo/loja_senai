<?php
include 'conexao.php';

// Pega o que foi digitado no formulário (method="post")
$id       = $_POST['id'];
$nome     = $_POST['nome'];
$email    = $_POST['email'];
$telefone = $_POST['telefone'];
$cidade   = $_POST['cidade'];

if ($id == '') {
    // id vazio: é um cliente NOVO
    $sql = $pdo->prepare('INSERT INTO cliente (nome, email, telefone, cidade) VALUES (?, ?, ?, ?)');
    $sql->execute([$nome, $email, $telefone, $cidade]);
} else {
    // id preenchido: ATUALIZA o cliente que já existe
    $sql = $pdo->prepare('UPDATE cliente SET nome = ?, email = ?, telefone = ?, cidade = ? WHERE id = ?');
    $sql->execute([$nome, $email, $telefone, $cidade, $id]);
}

// Volta para a lista com um aviso de sucesso
header('Location: clientes.php?msg=salvo');
exit;
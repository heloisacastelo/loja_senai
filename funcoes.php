<?php
// funcoes.php
// Funções que usamos em várias páginas.

// Fuso horário de Brasília. Sem esta linha, date() pode usar o fuso
// configurado no php.ini e mostrar a data de amanhã à noite.
date_default_timezone_set('America/Sao_Paulo');

// Mostra um texto no HTML com segurança.
// Se alguém digitar <b> no nome, aparece o texto, e não uma tag.
function e($texto) {
    // Campo vazio no banco (NULL) vira texto vazio
    if (is_null($texto)) {
        return '';
    }
    return htmlspecialchars($texto);
}

// Formata um número como dinheiro: 1899.9 vira R$ 1.899,90
// number_format(valor, casas decimais, separador decimal, separador de milhar)
function dinheiro($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// Troca a data do banco (2026-10-22) pelo formato brasileiro (22/10/2026)
// explode corta o texto em cada "-": [0] => 2026, [1] => 10, [2] => 22
function data_br($data) {
    $partes = explode('-', $data);
    return $partes[2] . '/' . $partes[1] . '/' . $partes[0];
}
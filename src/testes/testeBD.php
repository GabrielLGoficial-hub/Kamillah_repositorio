<?php
require_once __DIR__ . "/../classes/BD.php";
$bd = BD::getInstancia();

//Testando o metodo de conexao
$bd->conectar();
if (!$bd->getBanco()) {
    $banco = "geral";
} else {
    $banco = $bd->getBanco();
}
echo "<pre>Conexao realizada com sucesso no banco " . $banco . "\n";
echo "<pre>Codificação: " . $bd->getCodificacao()."\n";
$bd->setCodificacao("latin1");
echo "<pre>Codificação atualizada: " . $bd->getCodificacao();

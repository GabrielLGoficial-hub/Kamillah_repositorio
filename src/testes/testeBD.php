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
echo "<pre>Codificação: " . $bd->getCodificacao() . "\n";
$bd->setCodificacao("latin1");
echo "<pre>Codificação atualizada: " . $bd->getCodificacao();
echo "<pre>" . $bd->getBanco();
if (empty($bd->getBanco())) {
    $bd->query("CREATE DATABASE IF NOT EXISTS bancoTeste;");
    $bd->setBanco("bancoTeste");
    echo "<pre>bancao criado e acessado com sucesso\nbanco:" . $bd->getBanco();
}

$bd->query("CREATE TABLE tbl_teste(
id int primary key AUTO_INCREMENT,
teste varchar(1)
);");

$dadoMock = "A";
$dadosMock2 = "B";

echo "<pre>Linhas afetadas: " . $bd->query("INSERT INTO tbl_teste(teste)VALUES(?);", [$dadoMock]);
echo "<pre>Linhas afetadas: " . $bd->query("INSERT INTO tbl_teste(teste)VALUES(?);", [$dadosMock2]);

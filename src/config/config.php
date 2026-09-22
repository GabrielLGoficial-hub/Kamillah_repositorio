<?php
//Este módulo define algumas configuraçõeS globais do sistemas como constantes

//configuracoes do dot env
$conteudoEnv = file_get_contents(__DIR__ . "/../../.env");

if (!$conteudoEnv) {
    die("não foi possivel obter o conteudo do arquivo env");
}

$partsEnv = explode("\n", $conteudoEnv);
$arrayParts = [];
foreach ($partsEnv as $parts) {
    $arrayParts[] = explode("=", $parts)[1];
}

$arrayParts = array_map(fn($item) => str_replace('"', "", $item), $arrayParts);
define("USUARIO_BANCO", trim($arrayParts[0]));
define("HOST", trim($arrayParts[2]));
define("SENHA", trim($arrayParts[1]));

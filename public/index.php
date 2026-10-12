<?php

//inclui dependencias de sessao e banco
require_once __DIR__ . "/../src/classes/SessionMestre.php";
require_once __DIR__ . "/../src/classes/BD.php";
require_once __DIR__ . "/../src/utils/utils.php";

//entancia a varivel do banco e inicializa as demais funcoes
$bd = BD::getInstancia("administracao");
$metodo = $_SERVER["REQUEST_METHOD"];
$url = trim(strtok($_SERVER["REQUEST_URI"], "?"));
$ip = $_SERVER["REMOTE_ADDR"] ?? "";

$arrayRotas = [
    "/" => [
        "script" => "paginaRegistro.php",
        "status" => "publica"
    ],
    "/api/cadastro" => [
        "script" => "controllerRegistro.php",
        "status" => "publica"
    ]

];

if (isset($metodo) and isset($url)) {
    foreach ($arrayRotas as $rota => $script) {
        if ($rota === $url && $script["status"] === "publica" && $metodo === "GET") {
            require_once __DIR__ . "/../pages/" . $script['script'];
            break;
        } else if ($rota === $url && $script["status"] === "publica" && $metodo === "POST") {
            require_once __DIR__ . "/../controllers/" . $script["script"];
            break;
        } else {
            http_response_code(404);
            die("Não existe essa rota no sistema...");
        }
    }
}

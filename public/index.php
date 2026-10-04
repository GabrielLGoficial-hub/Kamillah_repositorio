<?php

require_once __DIR__."/../src/classes/SessionMestre.php";

$metodo = $_SERVER["REQUEST_METHOD"];
$url = trim(strtok("?", $_SERVER["REQUEST_URI"]));
$sessao = SessionMestre::getInstancia();

$arrayRotas = [
    "/" => [
        "script" => "paginaRegistro.php",
        "status" => "segura"
    ]

];

if (isset($metodo) and isset($url)) {
    foreach ($arrayRotas as $rota => $script) {
        if ($rota === $url && $script["status"] === "segura") {
            require_once $script;
        } else {
            http_response_code(404);
            die("Não existe essa rota no sistema...");
        }
    }
}

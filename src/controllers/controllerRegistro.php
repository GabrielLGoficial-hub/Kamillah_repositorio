<?php
require_once __DIR__ . "/../services/RegistroService.php";
require_once __DIR__ . "/../classes/SessionMestre.php";
require_once __DIR__ . "/../utils/Utils.php";

$metodo = $_SERVER['REQUEST_METHOD'] ?? NULL;

if ($metodo !== "POST" || $metodo === null) {
    Utils::enviarRespostaJson(['mensage' => "metodo de requisicao não suportado"]);
}

try {
    $service = new RegistroService();
    $ip = $_SERVER['REMOTE_ADDR'] ?? null;

    ($ip === null){
        throw new Exception("ip invalido");
    }

    $service->verificarLimiteDeAcessosPorIp();
} catch (Exception $e) {
    Utils::enviarRespostaJson([$e->getMessage(),$e->getCode()]);
}

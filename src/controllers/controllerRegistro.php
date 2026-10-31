<?php
require_once __DIR__ . "/../src/classes/BD.php";
require_once __DIR__ . "/../src/classes/GeradorLogs.php";
require_once __DIR__ . "/../src/utils/Utils.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(404);
    die("Página não encontrada");
}

//variaveis
$bd = BD::getInstancia("administracao");
$cnpj = $_POST["cnpj"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$razaoSocial = $_POST["razaoSocial"] ?? "";
$nomeFantasia = $_POST["nomeFantasia"] ?? "";
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";
$ip = $_SERVER["REMOTE_ADDR"];

if ($cnpj !== "") {
    $cnpj = trim(Utils::sanitizarIdentificadores($cnpj));
}

if ($cpf !== "") {
    $cpf = trim(Utils::sanitizarIdentificadores($cpf));
}

if (!Utils::validarEmail($email)) {
    http_response_code(400);
    die("Email inválido");
}

if ($senha !== "") {
    $senha = password_hash($senha, "sha512");
}

$numeroTentativas = Utils::consultarTentativasAcessoPorIp($ip);
if ($numeroTentativas > 0) {
}

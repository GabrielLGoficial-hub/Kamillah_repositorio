<?php
require_once __DIR__ . "/../classes/SessionMestre.php";

function resetarSessao(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }

    $_SESSION = [];
    session_start();

    $ref = new ReflectionProperty(SessionMestre::class, 'instancia');
    $ref->setValue(null, null);
}

function assertTrue(bool $condicao, string $mensagem): void
{
    if (!$condicao) {
        throw new Exception($mensagem);
    }
}

function assertFalse(bool $condicao, string $mensagem): void
{
    if ($condicao) {
        throw new Exception($mensagem);
    }
}

try {
    // Caso 1: sessão válida
    resetarSessao();
    $session = SessionMestre::getInstancia(1);
    $session->criarChaveSessao();

    assertTrue($session->validarSessao(), "Sessão válida deveria retornar true.");

    // Caso 2: identidade alterada
    resetarSessao();
    $session = SessionMestre::getInstancia(2);
    $session->criarChaveSessao();
    $_SESSION['identidade'] = '';

    assertFalse($session->validarSessao(), "Sessão inválida por identidade alterada.");

    // Caso 3: idUsuario vazio
    resetarSessao();
    $session = SessionMestre::getInstancia(3);
    $session->criarChaveSessao();
    $_SESSION['idUsuario'] = '';

    assertFalse($session->validarSessao(), "Sessão inválida por idUsuario vazio.");

    echo "Todos os testes passaram.";
} catch (Throwable $e) {
    echo "Teste falhou: " . $e->getMessage();
}
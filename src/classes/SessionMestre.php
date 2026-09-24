<?php
class SessionMestre
{
    private const TEMPO_MAXIMO_SESSAO = 7200000; //2 horas em milisegundos
    private int $tempoInicioSessao = 0;
    private string $identidade = "";
    private int $idUsuario = 0;
    private static mixed $instancia = null;

    private function __construct(int $idUsuario)
    {
        $this->iniciarSessao();
        $this->idUsuario = $idUsuario;
        $this->tempoInicioSessao = time();
        $this->identidade = $this->gerarIdentidade();
    }

    public static function getInstancia(int $idUsuario)
    {

        if (self::$instancia === null) {
            self::$instancia = new SessionMestre($idUsuario);
        }
    }

    public function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_DISABLED) {
            session_start();
        }
    }

    public function getSessaoStatus()
    {
        if (session_status() === PHP_SESSION_NONE) {
            return "A sessão não existe...";
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            return "A sessão está ativa...";
        }

        if (session_status() === PHP_SESSION_DISABLED) {
            return "A sessão não está ativa...";
        }
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getIdentidade()
    {
        return $this->identidade;
    }

    public function getInicioSessao()
    {
        return $this->tempoInicioSessao;
    }

    public function getTempoMaximo()
    {
        return self::TEMPO_MAXIMO_SESSAO;
    }

    public function criarChaveSessao()
    {
        $_SESSION['identidade'] = $this->identidade;
        $_SESSION['tempoInicioSessao'] = $this->tempoInicioSessao;
        $_SESSION['idUsuario'] = $this->idUsuario;
    }

    private function gerarIdentidade()
    {
        $hash = hash("sha512", $_SERVER["HTTP_USER_AGENT"] . "|" . $_SERVER["REMOTE_ADDR"]);
        return $hash;
    }

    private function verificarRouboDeIdentidade()
    {
        if (hash_equals($this->gerarIdentidade(), $_SESSION['identidade'])) {
            return true;
        }
        return false;
    }

    private function verificarIdVazio()
    {
        if (empty($_SESSION['idUsuario'])) {
            return true;
        }
        return false;
    }

    private function verificarTempoLimite()
    {
        if ((time() - $_SESSION['tempoInicioSessao']) === self::TEMPO_MAXIMO_SESSAO) {
            return true;
        }
        return false;
    }

    public function validarSessao()
    {
        if (
            $this->verificarIdVazio()
            || $this->verificarRouboDeIdentidade()
            || $this->verificarTempoLimite()

        ) {
            return false;
        }
        return true;
    }
}

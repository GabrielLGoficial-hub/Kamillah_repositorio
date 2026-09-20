<?php
require_once __DIR__ . "/../config/config.php";

class BD
{
    private string $usuario;
    private string $senha;
    private string $host;
    private string $banco;
    private string $codificacao;
    private static mixed $instacia = null;

    private function __construct(string $banco = "", string $codificacao = "UTF-8")
    {
        $this->usuario = USUARIO_BANCO;
        $this->senha = SENHA;
        $this->host = HOST;
    }

    public static function getInstacia(string $banco = "", string $codificacao = "UTF-8")
    {
        if (self::$instacia === null) {
            self::$instacia = new BD($banco, $codificacao);
        }
    }

    public function conectar()
    {
        try {
            $mysql = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);
            if (!$mysql) {
                throw new Exception("falha ao tentar conectar com o mysql", mysqli_errno($mysql));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

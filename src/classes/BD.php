<?php
require_once __DIR__ . "/../config/config.php";

class BD
{
    private string $usuario;
    private string $senha;
    private string $host;
    private string $banco;
    private string $codificacao;
    private mysqli $mysqli;
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
            $this->mysqli = $mysql;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function setCodificacao(string $codificacao)
    {
        try {
            $this->mysqli->query("DO 1");
            $this->mysqli->set_charset($codificacao);
        } catch (mysqli_sql_exception $e) {
            echo "Não é possivel modificar o charset do banco" . $this->mysqli->error;
        }
    }

    public function getCodificacao()
    {
        return $this->codificacao;
    }

    public function getBanco()
    {
        return $this->banco;
    }

    public function setBanco(string $banco)
    {
        $this->banco = $banco;
        $this->mysqli->close();
        $this->conectar();
    }

    public function query(string $sql, array $parametros = [])
    {
        try {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute($parametros);

            if (strpos($sql, "SELECT") === 0 or strpos($sql, "SHOW") === 0 or strpos($sql, "DESCRIBE") === 0) {
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            } else {
                return $stmt->affected_rows;
            }
        } catch (mysqli_sql_exception $e) {
            if (!$this->tratarTimeOut($e->getCode())) {
                echo $e->getMessage();
            }
        }
    }

    private function tratarTimeOut(string $codigoException)
    {
        $arrayCodigo = [
            2002,
            2003,
            2006,
            2013,
            3024
        ];

        if (in_array($codigoException, $arrayCodigo)) {
            $this->mysqli->close();
            $this->conectar();
        } else {
            return false;
        }
    }
}

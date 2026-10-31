<?php
require_once __DIR__ . "/../classes/BD.php";

class RegistroRepository
{

    private BD $db;
    private string $banco;

    public function __construct()
    {
        $this->banco = "administracao";
        $this->db = BD::getInstancia($this->banco);
    }

    public function getTentativaPorIp(string $ip)
    {
        if (isset($ip)) {
            $sql = "SELECT quantidadeAcesso, dataAcessoControle FROM tbl_usuarios_adm WHERE ip = ?";
            $result = $this->db->query($sql, [$ip]);
            $arrayQuantidadeDataAcessos = [];
            foreach ($result as $dados) {
                $arrayQuantidadeDataAcessos[$dados['quantidadeAcesso']] = $dados['dataAcessoControle'];
            }
            return $arrayQuantidadeDataAcessos;
        }
        return false;
    }
}

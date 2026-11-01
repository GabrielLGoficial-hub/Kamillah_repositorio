<?php
require_once __DIR__ . "/../RegistroRepository.php";
require_once __DIR__ . "/../utils/Utils.php";

class RegistroService
{
    private RegistroRepository $repository;
    const QUANTIDADE_MAXIMA_ACESSO = 4;

    public function __construct()
    {
        $this->repository = new RegistroRepository();
    }

    public function verificarLimiteDeAcessosPorIp(string $ip)
    {
        if (empty($ip)) {
            return false;
        }
        $colunas = ['quantidadeAcesso', 'dataAcessoControle'];
        $where = "ip = ?";

        $result = $this->repository->listarTentativasRegistro($colunas, $where, [$ip]);
        $arrayTentativas = [];
        $arrayDataAcessoControle = [];
        foreach ($result['result'] as $dados) {
            $arrayDataAcessoControle[] = $dados['dataAcessoControle'] ?? "";
            $arrayTentativas[] = $dados['quantidadeAcesso'] ?? "";
        }

        if (empty($arrayDataAcessoControle) && empty($arrayTentativas)) {
            return false;
        }

        $dataMaxima = max($arrayDataAcessoControle);
        $dataMin = min($arrayDataAcessoControle);
        $calculoDeIntervalo = (int)$dataMaxima - (int)$dataMin;

        if (count($arrayTentativas) > 3 && $calculoDeIntervalo < 30) {
            return true;
        }
        return false;
    }

    public function capturarTentativasRegistro(array $valores,){
        
    }

}

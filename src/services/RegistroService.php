<?php
require_once __DIR__ . "/../RegistroRepository.php";

class RegistroService
{
    private RegistroRepository $repository;
    const QUANTIDADE_MAXIMA_ACESSO = 4;


    public function verificarLimiteDeAcessosPorIp(string $ip)
    {
        $tentativasPorIp = $this->repository->getTentativaPorIp($ip);

        $data = array_column($tentativasPorIp, 1);
        $tentativasIp = array_column($tentativasPorIp, 0);
        $maxTentativa = max($tentativasIp, self::QUANTIDADE_MAXIMA_ACESSO);
    }
}

<?php
function registrarAcessoPorIp(string $ip)
{
    global $bd;

    $dataAtual = date("Y-m-d");
    $quantidadeAcessos = 0;
    if ($ip !== "") {
        $tentativas = consultarTentativasAcessoPorIp($ip);
        if (!empty($tentativas)) {
            $quantidadeAcessos++;
        }

        $sql = "INSERT INTO tbl_controle_acessos_adm(ip,quantidadeAcesso,dataAcessoControle)
        VALUES(?,?,?)";
        $bd->query($sql, [$ip, $quantidadeAcessos, $dataAtual]);
    }
}

function consultarTentativasAcessoPorIp(string $ip)
{
    global $bd;

    if ($ip !== "") {
        $sql = "SELECT quantidadeAcesso FROM tbl_controle_acessos_adm WHERE ip = ?";
        return $bd->query($sql, [$ip])['quantidadeAcesso'];
    }
}

<?php
require_once __DIR__ . "/../classes/BD.php";
require_once __DIR__ . "/../classes/QueryBuilder.php";

class RegistroRepository
{

    private BD $db;
    private QueryBuilder $builder;
    private string $banco;

    public function __construct()
    {
        $this->db = BD::getInstancia();
        $this->builder = new QueryBuilder();
    }

    public function listarTentativasRegistro(array $colunas, string $tabela, string $where, array $values,) 
    {

    }
}

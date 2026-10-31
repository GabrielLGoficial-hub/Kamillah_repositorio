<?php
require_once __DIR__ . "/../classes/BD.php";
require_once __DIR__ . "/../classes/QueryBuilder.php";

class RegistroRepository
{

    private BD $db;
    private QueryBuilder $builder;
    

    public function __construct()
    {
        $this->db = BD::getInstancia();
        $this->builder = new QueryBuilder();
    }

    public function listarTentativasRegistro(array $colunas, string $tabela, string $where, array $values)
    {
        $db = $this->db;
        $builder = $this->builder;
        $builder->select($colunas);
        $builder->from($tabela);
        $builder->where($where, $values);
        $result = $db->query($builder->getSql(), $builder->getValores());

        return ['sql' => $builder->getSql(), "result" => $result];
    }
}

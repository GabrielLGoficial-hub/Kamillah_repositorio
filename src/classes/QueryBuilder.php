<?php
class QueryBuilder
{
    private string $strSql;
    private array $valores;
    private string $tabela;

    public function select(array $colunas): void
    {
        if (count($colunas) > 0) {
            $colunas = implode(",", $colunas);
            $strSql = "SELECT $colunas ";
            $this->strSql = $strSql;
        }
    }

    public function from(string $tabela = ""): void
    {
        $strSql = $tabela !== "" ? "FROM $tabela" : "FROM " . $this->strSql;
        $this->strSql .= $strSql;
    }

    public function where(string $where, array $parametros): void
    {
        if ($where !== "" && count($parametros) > 0) {
            $strSql = "WHERE $where ";
            $this->strSql .= $strSql;
            $this->valores = $parametros;
        }
    }

    public function innerJoin(string $innerJoin, string $on): void
    {
        if ($innerJoin !== "" && $on !== "") {
            $strSql = "INNER JOIN $innerJoin ON $on ";
            $this->strSql .= $strSql;
        }
    }

    public function leftJoin(string $leftJoin, string $on): void
    {
        if ($leftJoin !== "" && $on !== "") {
            $strSql = "LEFT JOIN $leftJoin ON $on ";
            $this->strSql .= $strSql;
        }
    }

    public function setTabela(string $tabela)
    {
        if ($tabela !== "") {
            $this->tabela = $tabela;
        }
    }

    public function insert(array $colunas, string $value, array $data, bool $ignore = false): void
    {
        if ($colunas !== "" && $value !== "" && count($data) > 0) {
            $colunas = implode(",", $colunas);
            $ignore = $ignore ? "IGNORE" : "";
            $strSql = "INSERT $ignore INTO " . $this->tabela . "($colunas)VALUES($value)";
            $this->strSql = $strSql;
            $this->valores = $data;
        }
    }

    public function delete(string $tabela = ""): void
    {
        $strSql = $tabela !== "" ? "DELETE FROM $tabela " : "DELETE FROM " . $this->tabela;
        $this->strSql = $strSql;
    }

    public function update(string $tabela = "", string $set, array $parametros): void
    {
        $strSql = $tabela !== "" ? "UPDATE $tabela SET $set " : "UPDATE " . $this->tabela . " SET $set";
        $this->strSql = $strSql;
        $this->valores = $parametros;
    }

    public function getSql()
    {
        return $this->strSql;
    }

    public function getValores()
    {
        return $this->valores;
    }
}

<?php
class GeradorExcel implements ArquivosInteface
{
    private string $diretorioBase;
    private string $nomeArquivo;

    public function __construct(string $diretorioBase, string $nomeArquivo)
    {
        $this->diretorioBase = $diretorioBase;
        $this->nomeArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION) == "csv" ? $diretorioBase : $nomeArquivo . ".csv";
    }

    #[Override]
    public function criarDiretorioBase(string $caminho)
    {
        if (!is_dir($caminho)) {
            $result = mkdir($caminho);
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function criarArquivo(string $caminho)
    {
        $diretorioCompleto = $this->diretorioBase . DIRECTORY_SEPARATOR . $this->nomeArquivo;
        if (!file_exists($diretorioCompleto)) {
            $result = fopen($diretorioCompleto, "w");
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function escreverConteudoArquivo(array $dados)
    {

        $caminhoCompleto = $this->diretorioBase . DIRECTORY_SEPARATOR . $this->nomeArquivo;
        if (file_exists($caminhoCompleto) && is_dir($this->diretorioBase)) {
            $result = fputcsv($caminhoCompleto, $dados);
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function getConteudo()
    {
        $conteudoArquivo = $this->diretorioBase . DIRECTORY_SEPARATOR . $this->nomeArquivo;
        if (file_exists($conteudoArquivo) && is_dir($this->diretorioBase)) {
            $result = file_get_contents($conteudoArquivo);
            if (!$result) {
                return false;
            }
        }
    }
}

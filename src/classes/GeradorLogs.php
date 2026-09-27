<?php
class GeradorLogs implements ArquivosInteface
{
    private string $caminhoLog;
    private string $nomeArquivoLog;
    private const TAMANHAO_MAXIMO_LOG = 52428800;
    private static mixed $instancia = null;
    private int $part = 1;

    public static function getInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new GeradorLogs();
        }
    }

    #[Override]
    public function criarDiretorioBase(string $caminho)
    {

        $caminhoArquivo = pathinfo($caminho, PATHINFO_DIRNAME);
        if (!is_dir($caminhoArquivo)) {
            $result = mkdir($caminhoArquivo);
            $this->caminhoLog = $caminho;
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function criarArquivo(string $caminho)
    {
        if (!file_exists($this->caminhoLog . DIRECTORY_SEPARATOR . $caminho)) {
            $this->nomeArquivoLog = pathinfo($caminho, PATHINFO_EXTENSION) == "log" ? $caminho : $caminho . ".log";
            $result = fopen($this->caminhoLog . DIRECTORY_SEPARATOR . $caminho, "a");
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function escreverConteudoArquivo(array $dados)
    {
        foreach ($dados as $dado) {
            if ($this->verificarTamanhoArquivo()) {
                $result = $this->criarArquivo(pathinfo($this->nomeArquivoLog, PATHINFO_FILENAME) . "_part_" . $this->part . ".log");
                if (!$result) {
                    return false;
                }
                $this->part = $this->part++;
            }
            $result = fwrite($this->caminhoLog . DIRECTORY_SEPARATOR . $this->nomeArquivoLog, $dado);
            if (!$result) {
                return false;
            }
        }
    }

    #[Override]
    public function getConteudo()
    {
        if (is_dir($this->caminhoLog) && file_exists($this->caminhoLog . DIRECTORY_SEPARATOR . $this->nomeArquivoLog)) {
            $result = file_get_contents($this->caminhoLog . DIRECTORY_SEPARATOR . $this->nomeArquivoLog);
            if (!$result) {
                return false;
            }
            return $result;
        }
    }

    private function verificarTamanhoArquivo()
    {
        if (filesize($this->caminhoLog . DIRECTORY_SEPARATOR . $this->nomeArquivoLog) >= self::TAMANHAO_MAXIMO_LOG) {
            return true;
        }
        return false;
    }
}

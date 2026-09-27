<?php
interface ArquivosInteface
{
    public function criarDiretorioBase(string $caminho);
    public function criarArquivo(string $caminho);
    public function escreverConteudoArquivo(array $dados);
    public function getConteudo();
}

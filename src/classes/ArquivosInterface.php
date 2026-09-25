<?php
interface ArquivosInteface
{
    public function criarDiretorioBase(string $caminho);
    public function criarArquivo(string $caminho);
    public function escreverConteudoArquivo($dados);
    public function getConteudo();
}

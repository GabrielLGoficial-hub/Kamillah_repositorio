<?php
class Utils
{
    public static function validarEmail(string $email): bool
    {
        return preg_match('/\A[^@\s]+@[^@\s.]+(?:\.[^@\s.]+)+\z/', $email) === 1;
    }

    public static function sanitizarIdentificadores(string $identificador)
    {
        $identificadorSanitizado = str_replace(["/", "-"], "", $identificador);
        return $identificadorSanitizado;
    }

    public static function enviarRespostaJson(array $resposta)
    {
        if (empty($resposta)) {
            return false;
        }

        echo json_encode($resposta, JSON_UNESCAPED_SLASHES . '|' . JSON_UNESCAPED_UNICODE);
    }

    public static function converterCodificacaoUtf8(mixed $termo)
    {
        if (empty($termo)) {
            return false;
        }

        $codificacaoAtual = mb_detect_encoding($termo);
        if (is_array($termo)) {
            return array_map(fn($v) => mb_convert_encoding($v, "UTF-8", $codificacaoAtual), $termo);
        }
        return mb_convert_encoding($termo, "UTF-8", $codificacaoAtual);
    }
}

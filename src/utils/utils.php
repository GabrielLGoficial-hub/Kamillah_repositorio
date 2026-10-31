<?php
class Utils
{
    public static function validarEmail(string $email): bool
    {
        return preg_match('/\A[^@\s]+@[^@\s.]+(?:\.[^@\s.]+)+\z/', $email) === 1;
    }
}

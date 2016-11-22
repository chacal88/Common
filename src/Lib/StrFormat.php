<?php
/**
 * Created by PhpStorm.
 * User: chacal
 * Date: 21/10/16
 * Time: 14:33
 */

namespace Common\Lib;


final class StrFormat
{

    public static function format($str)
    {

        if (strlen($str) > 11)
            return self::formatCnpj($str);
        else
            return self::formatCpf($str);

    }

    /**
     * CpfFormat constructor.
     */
    public static function formatCpf($cpf)
    {
        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        for ($i = strlen($cpf); $i < 11; $i++) {
            $cpf = '0' . $cpf;
        }
        return $cpf;
    }

    /**
     * cnpjFormat constructor.
     */
    public static function formatCnpj($cnpj)
    {
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

        for ($i = strlen($cnpj); $i < 14; $i++) {
            $cnpj = '0' . $cnpj;
        }
        return $cnpj;
    }
}
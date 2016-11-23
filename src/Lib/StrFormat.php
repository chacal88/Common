<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */

namespace Common\Lib;

/**
 * Class StrFormat
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Lib
 */
final class StrFormat
{

    /**
     * format
     *
     * @param $str
     * @return mixed|string
     */
    public static function format($str)
    {

        if (strlen($str) > 11)
            return self::formatCnpj($str);
        else
            return self::formatCpf($str);

    }

    /**
     * formatCpf
     *
     * @param $cpf
     * @return mixed|string
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
     * formatCnpj
     *
     * @param $cnpj
     * @return mixed|string
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
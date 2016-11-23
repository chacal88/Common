<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */

namespace Common\Lib;


/**
 * Class DataTime
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Lib
 */
abstract class DateCreate
{

    /**
     * Retorna data passada ou data atual em caso de erro.
     *
     * @param mixed $date
     * @return \DateTime
     */
    public static function created($date)
    {
        try {
            if ($date instanceof \DateTime)
                return $result = $date;
            else
                return $result = new \DateTime($date);
        } catch (\Exception $e) {
            return null;
        }
    }
}

?>